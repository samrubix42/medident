<?php

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    public string $category = 'all';

    public function mount(): void
    {
        $requestedCategory = request()->string('category')->trim()->toString();

        if ($requestedCategory === '') {
            return;
        }

        $this->category = ServiceCategory::query()
            ->active()
            ->where('slug', $requestedCategory)
            ->whereHas('services', fn (Builder $query): Builder => $query->active())
            ->value('slug') ?? 'all';
    }

    /**
     * @return LengthAwarePaginator<int, Service>
     */
    #[Computed]
    public function services(): LengthAwarePaginator
    {
        return Service::query()
            ->active()
            ->with('category')
            ->whereHas('category', fn (Builder $query): Builder => $query->active())
            ->when($this->category !== 'all', function (Builder $query): void {
                $query->whereHas('category', fn (Builder $categoryQuery): Builder => $categoryQuery->where('slug', $this->category));
            })
            ->orderBy('id')
            ->paginate(9);
    }

    /**
     * @return Collection<int, ServiceCategory>
     */
    #[Computed]
    public function categories(): Collection
    {
        return ServiceCategory::query()
            ->active()
            ->whereHas('services', fn (Builder $query): Builder => $query->active())
            ->withCount(['services' => fn (Builder $query): Builder => $query->active()])
            ->orderBy('id')
            ->get();
    }

    public function selectCategory(string $category): void
    {
        $this->category = $category;
        $this->resetPage();
    }

    public function render()
    {
        return $this->view()
            ->title('Medical & Dental Services in Shastri Nagar, Ghaziabad')
            ->layoutData([
                'canonical' => route('services'),
                'metaDescription' => 'Explore medical, preventive and dental services at MediDENT Multicare Clinic in Shastri Nagar, Ghaziabad, including general physician care, heart health, vaccination and family dentistry.',
                'metaKeyword' => 'medical services Ghaziabad, dental services Shastri Nagar, general physician Ghaziabad, dental clinic Ghaziabad, MediDENT services',
                'metaImage' => asset('images/hero-img.jpg'),
            ]);
    }
};
