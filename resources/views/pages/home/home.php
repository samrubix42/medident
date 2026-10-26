<?php

use App\Models\Review;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    /**
     * @return Collection<int, Review>
     */
    #[Computed]
    public function reviews(): Collection
    {
        return Review::query()
            ->where('review_rating', '>=', 4.5)
            ->whereNotNull('review_text')
            ->where('review_text', '<>', '')
            ->orderByDesc('review_datetime_utc')
            ->orderByDesc('id')
            ->limit(12)
            ->get();
    }
};
