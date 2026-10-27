<?php

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Layout('layouts::admin')] class extends Component
{
    use WithFileUploads;

    public ?int $serviceId = null;

    public string $title = '';

    public string $slug = '';

    public ?int $serviceCategoryId = null;

    public string $shortDescription = '';

    public string $content = '';

    public string $imageLink = '';

    public mixed $imageUpload = null;

    public string $metaTitle = '';

    public string $metaDescription = '';

    public string $metaKeyword = '';

    public bool $isActive = true;

    public bool $slugManuallyEdited = false;

    public function mount(?int $service = null): void
    {
        if ($service === null) {
            return;
        }

        $service = Service::findOrFail($service);

        $this->serviceId = $service->id;
        $this->title = $service->title;
        $this->slug = $service->slug;
        $this->serviceCategoryId = $service->service_category_id;
        $this->shortDescription = $service->short_description ?? '';
        $this->content = $service->content;
        $this->imageLink = $service->image_link ?? '';
        $this->metaTitle = $service->meta_title ?? '';
        $this->metaDescription = $service->meta_description ?? '';
        $this->metaKeyword = $service->meta_keyword ?? '';
        $this->isActive = $service->is_active;
        $this->slugManuallyEdited = true;
    }

    /**
     * @return Collection<int, ServiceCategory>
     */
    #[Computed]
    public function categories(): Collection
    {
        return ServiceCategory::query()
            ->orderBy('title')
            ->get();
    }

    /**
     * @return array<string, string>
     */
    #[Computed]
    public function homeImages(): array
    {
        return [
            'images/general-diseases.jpg' => 'General Diseases',
            'images/gastro.jpg' => 'Gastrointestinal Diseases',
            'images/heart.jpg' => 'Heart Disease',
            'images/throid.jpg' => 'Thyroid Disorders',
            'images/respiratory.jpg' => 'Respiratory Diseases',
            'images/vaccination.jpg' => 'Vaccination',
            'dental/cosmetic-dental.jpg' => 'Cosmetic Dental',
            'dental/KIDSDENTISTRY.jpg' => 'Kids Dentistry',
            'dental/Dental-Implants.jpg' => 'Dental Implants',
            'dental/painless-extraction.jpg' => 'Painless Extraction',
            'dental/dental-filling.jpg' => 'Dental Filling',
            'dental/root-canal.jpg' => 'Root Canal Treatment',
        ];
    }

    public function updatedTitle(string $value): void
    {
        if (! $this->slugManuallyEdited) {
            $this->slug = Str::slug($value);
        }
    }

    public function updatedSlug(): void
    {
        $this->slugManuallyEdited = true;
    }

    public function selectHomeImage(string $path): void
    {
        abort_unless(auth()->check(), 403);

        if (! array_key_exists($path, $this->homeImages)) {
            return;
        }

        $this->imageLink = $path;
        $this->imageUpload = null;
        $this->resetValidation(['imageLink', 'imageUpload']);
    }

    public function clearImage(): void
    {
        abort_unless(auth()->check(), 403);

        $this->imageLink = '';
        $this->imageUpload = null;
        $this->resetValidation(['imageLink', 'imageUpload']);
    }

    public function imagePreviewUrl(): ?string
    {
        if ($this->imageUpload) {
            return $this->imageUpload->temporaryUrl();
        }

        if ($this->imageLink === '') {
            return null;
        }

        if (Str::startsWith($this->imageLink, ['http://', 'https://'])) {
            return $this->imageLink;
        }

        return asset($this->imageLink);
    }

    public function save(): mixed
    {
        abort_unless(auth()->check(), 403);

        $this->slug = Str::slug($this->slug !== '' ? $this->slug : $this->title);

        $validated = $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('services', 'slug')->ignore($this->serviceId),
            ],
            'serviceCategoryId' => ['required', 'integer', Rule::exists('service_categories', 'id')],
            'shortDescription' => ['required', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'imageLink' => ['nullable', 'string', 'max:2048'],
            'imageUpload' => ['nullable', 'image', 'max:5120'],
            'metaTitle' => ['nullable', 'string', 'max:255'],
            'metaDescription' => ['nullable', 'string', 'max:1000'],
            'metaKeyword' => ['nullable', 'string', 'max:255'],
            'isActive' => ['boolean'],
        ]);

        $imageLink = trim((string) ($validated['imageLink'] ?? ''));

        $data = [
            'service_category_id' => $validated['serviceCategoryId'],
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'short_description' => $validated['shortDescription'],
            'content' => $validated['content'],
            'image_link' => $imageLink !== '' ? $imageLink : null,
            'meta_title' => $validated['metaTitle'] ?: null,
            'meta_description' => $validated['metaDescription'] ?: null,
            'meta_keyword' => $validated['metaKeyword'] ?: null,
            'is_active' => $validated['isActive'],
        ];

        if ($this->imageUpload) {
            $data['image_link'] = 'storage/'.$this->imageUpload->store('services', 'public');
        }

        if ($this->serviceId) {
            $service = Service::findOrFail($this->serviceId);
            $previousImage = $service->image_link;

            $service->update($data);

            if ($previousImage !== $service->image_link) {
                $this->deleteStoredImage($previousImage);
            }

            session()->flash('status', 'Service updated successfully.');
        } else {
            Service::create($data);

            session()->flash('status', 'Service created successfully.');
        }

        return redirect()->route('admin.services');
    }

    public function render()
    {
        return $this->view()->title($this->serviceId ? 'Edit Service' : 'Create Service');
    }

    private function deleteStoredImage(?string $imageLink): void
    {
        if (! $imageLink || ! Str::startsWith($imageLink, 'storage/services/')) {
            return;
        }

        Storage::disk('public')->delete(Str::after($imageLink, 'storage/'));
    }
};
