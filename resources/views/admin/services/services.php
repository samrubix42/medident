<?php

use App\Models\Service;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts::admin')] #[Title('Services')] class extends Component
{
    use WithPagination;

    public string $search = '';

    public int $perPage = 10;

    public bool $showDeleteModal = false;

    public ?int $serviceIdBeingDeleted = null;

    /**
     * @return LengthAwarePaginator<int, Service>
     */
    #[Computed]
    public function services(): LengthAwarePaginator
    {
        $search = trim($this->search);

        return Service::query()
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
    public function serviceToDelete(): ?Service
    {
        if (! $this->serviceIdBeingDeleted) {
            return null;
        }

        return Service::with('category')->find($this->serviceIdBeingDeleted);
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function confirmDelete(int $serviceId): void
    {
        abort_unless(auth()->check(), 403);

        $this->serviceIdBeingDeleted = $serviceId;
        $this->showDeleteModal = true;
    }

    public function cancelDelete(): void
    {
        $this->showDeleteModal = false;
        $this->serviceIdBeingDeleted = null;
    }

    public function deleteService(): void
    {
        abort_unless(auth()->check(), 403);

        if (! $this->serviceIdBeingDeleted) {
            return;
        }

        $service = Service::find($this->serviceIdBeingDeleted);

        if ($service) {
            $previousImage = $service->image_link;

            $service->delete();

            $this->deleteStoredImage($previousImage);
        }

        $this->cancelDelete();
        unset($this->services);

        $this->dispatch('toast-show', message: 'Service deleted successfully.', type: 'success');
    }

    private function deleteStoredImage(?string $imageLink): void
    {
        if (! $imageLink || ! Str::startsWith($imageLink, 'storage/services/')) {
            return;
        }

        Storage::disk('public')->delete(Str::after($imageLink, 'storage/'));
    }
};
