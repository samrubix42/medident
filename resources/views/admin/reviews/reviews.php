<?php

use App\Models\Review;
use Database\Seeders\ReviewSeeder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts::admin')] #[Title('Reviews')] class extends Component
{
    use WithPagination;

    public string $search = '';

    public int $perPage = 10;

    public bool $showDeleteModal = false;

    public ?int $reviewIdBeingDeleted = null;

    /**
     * @return LengthAwarePaginator<int, Review>
     */
    #[Computed]
    public function reviews(): LengthAwarePaginator
    {
        $search = trim($this->search);

        return Review::query()
            ->when($search !== '', function (Builder $query) use ($search): void {
                $query->where(function (Builder $query) use ($search): void {
                    $query->where('author_title', 'like', "%{$search}%")
                        ->orWhere('review_text', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%")
                        ->orWhere('place_id', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('review_datetime_utc')
            ->orderByDesc('id')
            ->paginate($this->perPage);
    }

    #[Computed]
    public function reviewToDelete(): ?Review
    {
        if (! $this->reviewIdBeingDeleted) {
            return null;
        }

        return Review::find($this->reviewIdBeingDeleted);
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedPerPage(): void
    {
        $this->resetPage();
    }

    public function resetReviews(): void
    {
        abort_unless(auth()->check(), 403);

        DB::transaction(function (): void {
            Review::query()->delete();

            app(ReviewSeeder::class)->run();
        });

        unset($this->reviews);

        $this->resetPage();
        $this->dispatch('toast-show', message: 'Reviews reset successfully.', type: 'success');
    }

    public function confirmDelete(int $reviewId): void
    {
        $this->reviewIdBeingDeleted = $reviewId;
        $this->showDeleteModal = true;
    }

    public function cancelDelete(): void
    {
        $this->showDeleteModal = false;
        $this->reviewIdBeingDeleted = null;
    }

    public function deleteReview(): void
    {
        abort_unless(auth()->check(), 403);

        if (! $this->reviewIdBeingDeleted) {
            return;
        }

        Review::whereKey($this->reviewIdBeingDeleted)->delete();

        $this->cancelDelete();
        $this->dispatch('toast-show', message: 'Review deleted successfully.', type: 'success');
    }
};
