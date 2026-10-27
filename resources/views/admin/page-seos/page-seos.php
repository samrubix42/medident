<?php

use App\Models\PageSeo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts::admin')] #[Title('Page SEO')] class extends Component
{
    use WithPagination;

    public string $search = '';

    public int $perPage = 10;

    public bool $showDeleteModal = false;

    public ?int $pageSeoIdBeingDeleted = null;

    /**
     * @return LengthAwarePaginator<int, PageSeo>
     */
    #[Computed]
    public function pageSeos(): LengthAwarePaginator
    {
        $search = trim($this->search);

        return PageSeo::query()
            ->when($search !== '', function (Builder $query) use ($search): void {
                $query->where(function (Builder $query) use ($search): void {
                    $query->where('page_name', 'like', "%{$search}%")
                        ->orWhere('page_slug', 'like', "%{$search}%")
                        ->orWhere('meta_title', 'like', "%{$search}%");
                });
            })
            ->orderBy('page_name')
            ->paginate($this->perPage);
    }

    #[Computed]
    public function pageSeoToDelete(): ?PageSeo
    {
        if (! $this->pageSeoIdBeingDeleted) {
            return null;
        }

        return PageSeo::find($this->pageSeoIdBeingDeleted);
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function confirmDelete(int $pageSeoId): void
    {
        abort_unless(auth()->check(), 403);

        $this->pageSeoIdBeingDeleted = $pageSeoId;
        $this->showDeleteModal = true;
    }

    public function cancelDelete(): void
    {
        $this->showDeleteModal = false;
        $this->pageSeoIdBeingDeleted = null;
    }

    public function deletePageSeo(): void
    {
        abort_unless(auth()->check(), 403);

        if (! $this->pageSeoIdBeingDeleted) {
            return;
        }

        PageSeo::query()
            ->whereKey($this->pageSeoIdBeingDeleted)
            ->delete();

        $this->cancelDelete();
        unset($this->pageSeos);

        $this->dispatch('toast-show', message: 'Page SEO deleted successfully.', type: 'success');
    }
};
