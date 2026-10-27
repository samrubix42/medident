<?php

namespace App\Models;

use Database\Factories\ServiceFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Service extends Model
{
    /** @use HasFactory<ServiceFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'service_category_id',
        'title',
        'slug',
        'short_description',
        'content',
        'image_link',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'is_active',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'service_category_id' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    /**
     * @param  Builder<Service>  $query
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    /**
     * @return BelongsTo<ServiceCategory, $this>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    public function imageUrl(): ?string
    {
        if (! $this->image_link) {
            return null;
        }

        if (Str::startsWith($this->image_link, ['http://', 'https://'])) {
            return $this->image_link;
        }

        return asset($this->image_link);
    }

    public function excerpt(int $length = 160): string
    {
        $shortDescription = trim((string) $this->short_description);

        if ($shortDescription !== '') {
            return $shortDescription;
        }

        return Str::limit(strip_tags((string) $this->content), $length);
    }
}
