<?php

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts::admin')] #[Title('Bookings')] class extends Component
{
    use WithPagination;

    public string $search = '';

    public string $dateFilter = 'all';

    public int $perPage = 10;

    public bool $showBookingModal = false;

    public ?int $selectedBookingId = null;

    public bool $showDeleteModal = false;

    public ?int $bookingIdBeingDeleted = null;

    /**
     * @return LengthAwarePaginator<int, Appointment>
     */
    #[Computed]
    public function bookings(): LengthAwarePaginator
    {
        $search = trim($this->search);

        return Appointment::query()
            ->when($search !== '', function (Builder $query) use ($search): void {
                $query->where(function (Builder $query) use ($search): void {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('address', 'like', "%{$search}%")
                        ->orWhere('problem', 'like', "%{$search}%");

                    if (is_numeric($search)) {
                        $query->orWhere('age', (int) $search);
                    }
                });
            })
            ->when($this->dateFilter === 'today', function (Builder $query): void {
                $query->whereDate('created_at', today());
            })
            ->when($this->dateFilter === 'this_week', function (Builder $query): void {
                $query->where('created_at', '>=', now()->startOfWeek());
            })
            ->when($this->dateFilter === 'this_month', function (Builder $query): void {
                $query->where('created_at', '>=', now()->startOfMonth());
            })
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate($this->perPage);
    }

    /**
     * @return array{total: int, today: int, this_week: int}
     */
    #[Computed]
    public function stats(): array
    {
        return [
            'total' => Appointment::query()->count(),
            'today' => Appointment::query()->whereDate('created_at', today())->count(),
            'this_week' => Appointment::query()->where('created_at', '>=', now()->startOfWeek())->count(),
        ];
    }

    #[Computed]
    public function selectedBooking(): ?Appointment
    {
        if (! $this->selectedBookingId) {
            return null;
        }

        return Appointment::find($this->selectedBookingId);
    }

    #[Computed]
    public function bookingToDelete(): ?Appointment
    {
        if (! $this->bookingIdBeingDeleted) {
            return null;
        }

        return Appointment::find($this->bookingIdBeingDeleted);
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedDateFilter(): void
    {
        $this->resetPage();
    }

    public function updatedPerPage(): void
    {
        $this->resetPage();
    }

    public function openBooking(int $bookingId): void
    {
        Appointment::findOrFail($bookingId);

        $this->selectedBookingId = $bookingId;
        $this->showBookingModal = true;
    }

    public function closeBooking(): void
    {
        $this->showBookingModal = false;
        $this->selectedBookingId = null;
    }

    public function confirmDelete(int $bookingId): void
    {
        Appointment::findOrFail($bookingId);

        $this->bookingIdBeingDeleted = $bookingId;
        $this->showDeleteModal = true;
    }

    public function cancelDelete(): void
    {
        $this->showDeleteModal = false;
        $this->bookingIdBeingDeleted = null;
    }

    public function deleteBooking(): void
    {
        abort_unless(auth()->check(), 403);

        if (! $this->bookingIdBeingDeleted) {
            return;
        }

        $deletedId = $this->bookingIdBeingDeleted;

        Appointment::whereKey($deletedId)->delete();

        if ($this->selectedBookingId === $deletedId) {
            $this->closeBooking();
        }

        $this->cancelDelete();
        unset($this->bookings, $this->stats);

        $this->dispatch('toast-show', message: 'Booking request deleted successfully.', type: 'success');
    }
};
