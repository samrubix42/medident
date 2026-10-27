<?php

use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Gallery')] class extends Component
{
    public string $category = 'all';

    /**
     * @return Collection<int, GalleryCategory>
     */
    #[Computed]
    public function categories(): Collection
    {
        return GalleryCategory::query()
            ->where('is_active', true)
            ->withCount([
                'images' => fn (Builder $query) => $query->where('is_active', true),
            ])
            ->orderBy('title')
            ->get();
    }

    /**
     * @return Collection<int, GalleryImage>
     */
    #[Computed]
    public function images(): Collection
    {
        $category = $this->category;

        return GalleryImage::query()
            ->with('category')
            ->where('is_active', true)
            ->whereHas('category', fn (Builder $query) => $query->where('is_active', true))
            ->when($category !== 'all', function (Builder $query) use ($category): void {
                $query->whereHas('category', fn (Builder $query) => $query->where('slug', $category));
            })
            ->latest()
            ->get();
    }

    public function selectCategory(string $category): void
    {
        $this->category = $category;
    }
};
