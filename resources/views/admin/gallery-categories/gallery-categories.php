<?php

use App\Models\GalleryCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts::admin')] #[Title('Gallery Categories')] class extends Component
{
    use WithPagination;

    public string $search = '';

    public int $perPage = 10;

    public bool $showModal = false;

    public ?int $editingCategoryId = null;

    public string $title = '';

    public string $slug = '';

    public bool $isActive = true;

    public bool $slugManuallyEdited = false;

    public bool $showDeleteModal = false;

    public ?int $categoryIdBeingDeleted = null;

    /**
     * @return LengthAwarePaginator<int, GalleryCategory>
     */
    #[Computed]
    public function categories(): LengthAwarePaginator
    {
        $search = trim($this->search);

        return GalleryCategory::query()
            ->when($search !== '', function (Builder $query) use ($search): void {
                $query->where(function (Builder $query) use ($search): void {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%");
                });
            })
            ->orderBy('title')
            ->paginate($this->perPage);
    }

    #[Computed]
    public function categoryToDelete(): ?GalleryCategory
    {
        if (! $this->categoryIdBeingDeleted) {
            return null;
        }

        return GalleryCategory::find($this->categoryIdBeingDeleted);
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedTitle(string $value): void
    {
        if (! $this->slugManuallyEdited && $this->editingCategoryId === null) {
            $this->slug = Str::slug($value);
        }
    }

    public function updatedSlug(): void
    {
        $this->slugManuallyEdited = true;
    }

    public function openCreateModal(): void
    {
        abort_unless(auth()->check(), 403);

        $this->resetForm();
        $this->showModal = true;
    }

    public function openEditModal(int $categoryId): void
    {
        abort_unless(auth()->check(), 403);

        $category = GalleryCategory::findOrFail($categoryId);

        $this->resetForm();
        $this->editingCategoryId = $category->id;
        $this->title = $category->title;
        $this->slug = $category->slug;
        $this->isActive = $category->is_active;
        $this->slugManuallyEdited = true;
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

        $this->slug = Str::slug($this->slug !== '' ? $this->slug : $this->title);

        $validated = $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('gallery_categories', 'slug')->ignore($this->editingCategoryId),
            ],
            'isActive' => ['boolean'],
        ]);

        $isEditing = $this->editingCategoryId !== null;

        if ($isEditing) {
            GalleryCategory::findOrFail($this->editingCategoryId)->update([
                'title' => $validated['title'],
                'slug' => $validated['slug'],
                'is_active' => $validated['isActive'],
            ]);
        } else {
            GalleryCategory::create([
                'title' => $validated['title'],
                'slug' => $validated['slug'],
                'is_active' => $validated['isActive'],
            ]);
        }

        $this->closeModal();
        unset($this->categories);

        $this->dispatch(
            'toast-show',
            message: $isEditing ? 'Gallery category updated successfully.' : 'Gallery category created successfully.',
            type: 'success',
        );
    }

    public function confirmDelete(int $categoryId): void
    {
        abort_unless(auth()->check(), 403);

        $this->categoryIdBeingDeleted = $categoryId;
        $this->showDeleteModal = true;
    }

    public function cancelDelete(): void
    {
        $this->showDeleteModal = false;
        $this->categoryIdBeingDeleted = null;
    }

    public function deleteCategory(): void
    {
        abort_unless(auth()->check(), 403);

        if (! $this->categoryIdBeingDeleted) {
            return;
        }

        GalleryCategory::whereKey($this->categoryIdBeingDeleted)->delete();

        $this->cancelDelete();
        unset($this->categories);

        $this->dispatch('toast-show', message: 'Gallery category deleted successfully.', type: 'success');
    }

    private function resetForm(): void
    {
        $this->resetValidation();
        $this->editingCategoryId = null;
        $this->title = '';
        $this->slug = '';
        $this->isActive = true;
        $this->slugManuallyEdited = false;
    }
};
