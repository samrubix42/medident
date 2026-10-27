<?php

use App\Models\BlogPost;
use App\Models\ClinicSetting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    public BlogPost $post;

    public function mount(string $slug): void
    {
        $this->post = BlogPost::query()
            ->active()
            ->with('category')
            ->whereHas('category', fn (Builder $query) => $query->active())
            ->where('slug', $slug)
            ->firstOrFail();
    }

    #[Computed]
    public function settings(): ClinicSetting
    {
        return ClinicSetting::current();
    }

    /**
     * @return Collection<int, BlogPost>
     */
    #[Computed]
    public function relatedPosts(): Collection
    {
        $relatedPosts = BlogPost::query()
            ->active()
            ->with('category')
            ->whereHas('category', fn (Builder $query) => $query->active())
            ->whereKeyNot($this->post->id)
            ->when($this->post->category_id, function (Builder $query): void {
                $query->where('category_id', $this->post->category_id);
            })
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->take(3)
            ->get();

        if ($relatedPosts->count() >= 3) {
            return $relatedPosts;
        }

        $remaining = 3 - $relatedPosts->count();

        $excludedIds = $relatedPosts
            ->pluck('id')
            ->push($this->post->id);

        $fallbackPosts = BlogPost::query()
            ->active()
            ->with('category')
            ->whereHas('category', fn (Builder $query) => $query->active())
            ->whereNotIn('id', $excludedIds)
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->take($remaining)
            ->get();

        return $relatedPosts->concat($fallbackPosts);
    }

    public function render()
    {
        return $this->view()
            ->title($this->post->meta_title ?: $this->post->title.' | MediDENT Blog')
            ->layoutData([
                'metaDescription' => $this->post->meta_description ?: $this->post->excerpt(),
                'metaKeyword' => $this->post->meta_keyword,
                'metaImage' => $this->post->featureImageUrl(),
            ]);
    }
};
