<?php

use App\Models\ContactMessage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts::admin')] #[Title('Inquiries')] class extends Component
{
    use WithPagination;

    public string $search = '';

    public string $filter = 'all';

    public int $perPage = 10;

    public bool $showInquiryModal = false;

    public ?int $selectedInquiryId = null;

    public bool $showDeleteModal = false;

    public ?int $inquiryIdBeingDeleted = null;

    /**
     * @return LengthAwarePaginator<int, ContactMessage>
     */
    #[Computed]
    public function inquiries(): LengthAwarePaginator
    {
        $search = trim($this->search);

        return ContactMessage::query()
            ->when($search !== '', function (Builder $query) use ($search): void {
                $query->where(function (Builder $query) use ($search): void {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('subject', 'like', "%{$search}%")
                        ->orWhere('message', 'like', "%{$search}%");
                });
            })
            ->when($this->filter === 'unread', fn (Builder $query) => $query->where('is_read', false))
            ->when($this->filter === 'read', fn (Builder $query) => $query->where('is_read', true))
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate($this->perPage);
    }

    /**
     * @return array{total: int, unread: int, read: int}
     */
    #[Computed]
    public function stats(): array
    {
        $total = ContactMessage::query()->count();
        $unread = ContactMessage::query()->where('is_read', false)->count();

        return [
            'total' => $total,
            'unread' => $unread,
            'read' => $total - $unread,
        ];
    }

    #[Computed]
    public function selectedInquiry(): ?ContactMessage
    {
        if (! $this->selectedInquiryId) {
            return null;
        }

        return ContactMessage::find($this->selectedInquiryId);
    }

    #[Computed]
    public function inquiryToDelete(): ?ContactMessage
    {
        if (! $this->inquiryIdBeingDeleted) {
            return null;
        }

        return ContactMessage::find($this->inquiryIdBeingDeleted);
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedFilter(): void
    {
        $this->resetPage();
    }

    public function updatedPerPage(): void
    {
        $this->resetPage();
    }

    public function openInquiry(int $inquiryId): void
    {
        ContactMessage::findOrFail($inquiryId);

        $this->selectedInquiryId = $inquiryId;
        $this->showInquiryModal = true;
    }

    public function closeInquiry(): void
    {
        $this->showInquiryModal = false;
        $this->selectedInquiryId = null;
    }

    public function toggleRead(int $inquiryId): void
    {
        abort_unless(auth()->check(), 403);

        $inquiry = ContactMessage::findOrFail($inquiryId);
        $inquiry->update(['is_read' => ! $inquiry->is_read]);

        unset($this->inquiries, $this->stats, $this->selectedInquiry);

        $this->dispatch(
            'toast-show',
            message: $inquiry->is_read ? 'Inquiry marked as read.' : 'Inquiry marked as unread.',
            type: 'success',
        );
    }

    public function markAllAsRead(): void
    {
        abort_unless(auth()->check(), 403);

        $updated = ContactMessage::query()->where('is_read', false)->update(['is_read' => true]);

        unset($this->inquiries, $this->stats, $this->selectedInquiry);

        $this->dispatch(
            'toast-show',
            message: $updated > 0 ? 'All inquiries marked as read.' : 'There are no unread inquiries.',
            type: 'success',
        );
    }

    public function confirmDelete(int $inquiryId): void
    {
        ContactMessage::findOrFail($inquiryId);

        $this->inquiryIdBeingDeleted = $inquiryId;
        $this->showDeleteModal = true;
    }

    public function cancelDelete(): void
    {
        $this->showDeleteModal = false;
        $this->inquiryIdBeingDeleted = null;
    }

    public function deleteInquiry(): void
    {
        abort_unless(auth()->check(), 403);

        if (! $this->inquiryIdBeingDeleted) {
            return;
        }

        $deletedId = $this->inquiryIdBeingDeleted;

        ContactMessage::whereKey($deletedId)->delete();

        if ($this->selectedInquiryId === $deletedId) {
            $this->closeInquiry();
        }

        $this->cancelDelete();
        unset($this->inquiries, $this->stats);

        $this->dispatch('toast-show', message: 'Inquiry deleted successfully.', type: 'success');
    }
};
