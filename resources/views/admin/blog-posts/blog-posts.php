<?php

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts::admin')] #[Title('Blog Posts')] class extends Component
{
    use WithPagination;

    public string $search = '';

    public int $perPage = 10;

    public bool $showDeleteModal = false;

    public ?int $postIdBeingDeleted = null;

    /**
     * @return LengthAwarePaginator<int, BlogPost>
     */
    #[Computed]
    public function posts(): LengthAwarePaginator
    {
        $search = trim($this->search);

        return BlogPost::query()
            ->with('category')
            ->when($search !== '', function (Builder $query) use ($search): void {
                $query->where(function (Builder $query) use ($search): void {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%")
                        ->orWhereHas('category', fn (Builder $query) => $query->where('title', 'like', "%{$search}%"));
                });
            })
            ->latest()
            ->paginate($this->perPage);
    }

    #[Computed]
    public function postToDelete(): ?BlogPost
    {
        if (! $this->postIdBeingDeleted) {
            return null;
        }

        return BlogPost::with('category')->find($this->postIdBeingDeleted);
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function confirmDelete(int $postId): void
    {
        abort_unless(auth()->check(), 403);

        $this->postIdBeingDeleted = $postId;
        $this->showDeleteModal = true;
    }

    public function cancelDelete(): void
    {
        $this->showDeleteModal = false;
        $this->postIdBeingDeleted = null;
    }

    public function deletePost(): void
    {
        abort_unless(auth()->check(), 403);

        if (! $this->postIdBeingDeleted) {
            return;
        }

        $post = BlogPost::find($this->postIdBeingDeleted);

        if ($post) {
            $previousFeatureImage = $post->feature_image;

            $post->delete();

            $this->deleteStoredImage($previousFeatureImage);
        }

        $this->cancelDelete();
        unset($this->posts);

        $this->dispatch('toast-show', message: 'Blog post deleted successfully.', type: 'success');
    }

    private function deleteStoredImage(?string $featureImage): void
    {
        if (! $featureImage || ! Str::startsWith($featureImage, 'storage/blog/')) {
            return;
        }

        Storage::disk('public')->delete(Str::after($featureImage, 'storage/'));
    }
};
