<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageSeo extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'page_name',
        'page_slug',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    /**
     * @return array{title: string, description: string, keywords: string|null}
     */
    public static function metadataFor(
        string $pageSlug,
        string $defaultTitle,
        string $defaultDescription,
        ?string $defaultKeywords = null,
    ): array {
        $pageSeo = static::query()
            ->where('page_slug', $pageSlug)
            ->first();

        return [
            'title' => filled($pageSeo?->meta_title) ? $pageSeo->meta_title : $defaultTitle,
            'description' => filled($pageSeo?->meta_description) ? $pageSeo->meta_description : $defaultDescription,
            'keywords' => filled($pageSeo?->meta_keywords) ? $pageSeo->meta_keywords : $defaultKeywords,
        ];
    }
}
