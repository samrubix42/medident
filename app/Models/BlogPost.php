<?php

namespace App\Models;

use Database\Factories\BlogPostFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    /** @use HasFactory<BlogPostFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'content',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'feature_image',
        'is_active',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'category_id' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    /**
     * @param  Builder<BlogPost>  $query
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    /**
     * @return BelongsTo<BlogCategory, $this>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function featureImageUrl(): ?string
    {
        if (! $this->feature_image) {
            return null;
        }

        if (Str::startsWith($this->feature_image, ['http://', 'https://'])) {
            return $this->feature_image;
        }

        return asset($this->feature_image);
    }

    public function excerpt(int $length = 160): string
    {
        return Str::limit(strip_tags($this->content), $length);
    }

    public function readingTime(): int
    {
        $wordCount = str_word_count(strip_tags($this->content));

        return max(1, (int) ceil($wordCount / 200));
    }
}
