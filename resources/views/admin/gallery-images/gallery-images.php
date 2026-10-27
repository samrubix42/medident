<?php

use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

new #[Layout('layouts::admin')] #[Title('Gallery Images')] class extends Component
{
    use WithFileUploads;
    use WithPagination;

    public string $search = '';

    public int $perPage = 10;

    public bool $showModal = false;

    public ?int $editingImageId = null;

    public string $categoryId = '';

    public mixed $image = null;

    public ?string $currentImageLink = null;

    public bool $isActive = true;

    public bool $showDeleteModal = false;

    public ?int $imageIdBeingDeleted = null;

    /**
     * @return LengthAwarePaginator<int, GalleryImage>
     */
    #[Computed]
    public function images(): LengthAwarePaginator
    {
        $search = trim($this->search);

        return GalleryImage::query()
            ->with('category')
            ->when($search !== '', function (Builder $query) use ($search): void {
                $query->where(function (Builder $query) use ($search): void {
                    $query->where('image_link', 'like', "%{$search}%")
                        ->orWhereHas('category', function (Builder $query) use ($search): void {
                            $query->where('title', 'like', "%{$search}%");
                        });
                });
            })
            ->latest()
            ->paginate($this->perPage);
    }

    /**
     * @return Collection<int, GalleryCategory>
     */
    #[Computed]
    public function categories(): Collection
    {
        return GalleryCategory::query()
            ->orderBy('title')
            ->get();
    }

    #[Computed]
    public function imageToDelete(): ?GalleryImage
    {
        if (! $this->imageIdBeingDeleted) {
            return null;
        }

        return GalleryImage::query()
            ->with('category')
            ->find($this->imageIdBeingDeleted);
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function openCreateModal(): void
    {
        abort_unless(auth()->check(), 403);

        $this->resetForm();
        $this->showModal = true;
    }

    public function openEditModal(int $imageId): void
    {
        abort_unless(auth()->check(), 403);

        $image = GalleryImage::findOrFail($imageId);

        $this->resetForm();
        $this->editingImageId = $image->id;
        $this->categoryId = (string) $image->category_id;
        $this->currentImageLink = $image->image_link;
        $this->isActive = $image->is_active;
        $this->showModal = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function save(): void
    {
        abort_unless(auth()->check(), 403);

        $isEditing = $this->editingImageId !== null;

        $validated = $this->validate([
            'categoryId' => ['required', 'integer', 'exists:gallery_categories,id'],
            'image' => [$isEditing ? 'nullable' : 'required', 'image', 'max:5120'],
            'isActive' => ['boolean'],
        ]);

        $data = [
            'category_id' => (int) $validated['categoryId'],
            'is_active' => $validated['isActive'],
        ];

        if ($this->image) {
            $path = $this->image->store('gallery', 'public');
            $data['image_link'] = 'storage/'.$path;
        }

        if ($isEditing) {
            $galleryImage = GalleryImage::findOrFail($this->editingImageId);
            $previousImageLink = $galleryImage->image_link;

            $galleryImage->update($data);

            if ($this->image) {
                $this->deleteStoredImage($previousImageLink);
            }
        } else {
            GalleryImage::create($data);
        }

        $this->closeModal();
        unset($this->images);

        $this->dispatch(
            'toast-show',
            message: $isEditing ? 'Gallery image updated successfully.' : 'Gallery image created successfully.',
            type: 'success',
        );
    }

    public function confirmDelete(int $imageId): void
    {
        abort_unless(auth()->check(), 403);

        $this->imageIdBeingDeleted = $imageId;
        $this->showDeleteModal = true;
    }

    public function cancelDelete(): void
    {
        $this->showDeleteModal = false;
        $this->imageIdBeingDeleted = null;
    }

    public function deleteImage(): void
    {
        abort_unless(auth()->check(), 403);

        if (! $this->imageIdBeingDeleted) {
            return;
        }

        $image = GalleryImage::find($this->imageIdBeingDeleted);

        if ($image) {
            $this->deleteStoredImage($image->image_link);
            $image->delete();
        }

        $this->cancelDelete();
        unset($this->images);

        $this->dispatch('toast-show', message: 'Gallery image deleted successfully.', type: 'success');
    }

    private function resetForm(): void
    {
        $this->resetValidation();
        $this->editingImageId = null;
        $this->categoryId = '';
        $this->image = null;
        $this->currentImageLink = null;
        $this->isActive = true;
    }

    private function deleteStoredImage(?string $imageLink): void
    {
        if (! $imageLink || ! Str::startsWith($imageLink, 'storage/gallery/')) {
            return;
        }

        Storage::disk('public')->delete(Str::after($imageLink, 'storage/'));
    }
};
