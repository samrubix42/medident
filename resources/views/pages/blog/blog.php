<?php

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\PageSeo;
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

    /**
     * @return LengthAwarePaginator<int, BlogPost>
     */
    #[Computed]
    public function posts(): LengthAwarePaginator
    {
        return BlogPost::query()
            ->active()
            ->with('category')
            ->whereHas('category', fn (Builder $query) => $query->active())
            ->when($this->category !== 'all', function (Builder $query): void {
                $query->whereHas('category', fn (Builder $categoryQuery) => $categoryQuery->where('slug', $this->category));
            })
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate(6);
    }

    /**
     * @return Collection<int, BlogCategory>
     */
    #[Computed]
    public function categories(): Collection
    {
        return BlogCategory::query()
            ->active()
            ->whereHas('posts', fn (Builder $query) => $query->active())
            ->withCount(['posts' => fn (Builder $query) => $query->active()])
            ->orderBy('title')
            ->get();
    }

    public function selectCategory(string $category): void
    {
        $this->category = $category;
        $this->resetPage();
    }

    public function render()
    {
        $metadata = PageSeo::metadataFor(
            'blog',
            'Health Blog | Medical & Dental Advice | MediDENT',
            'Read practical health guidance from MediDENT Multicare Clinic on preventive care, diabetes, heart health, dental treatments and everyday wellbeing.',
            'health blog Ghaziabad, medical advice Shastri Nagar, dental care tips, diabetes information, heart health guidance',
        );

        return $this->view()
            ->title($metadata['title'])
            ->layoutData([
                'canonical' => route('blog'),
                'metaDescription' => $metadata['description'],
                'metaKeyword' => $metadata['keywords'],
            ]);
    }
};
