<?php

namespace App\Models;

use Database\Factories\ReviewFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /** @use HasFactory<ReviewFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'google_id',
        'place_id',
        'location_link',
        'reviews_link',
        'reviews_per_score',
        'rating',
        'review_id',
        'review_pagination_id',
        'author_link',
        'author_title',
        'author_id',
        'author_image',
        'review_text',
        'review_img_urls',
        'review_img_url',
        'owner_answer',
        'owner_answer_timestamp',
        'owner_answer_timestamp_datetime_utc',
        'review_link',
        'review_rating',
        'review_timestamp',
        'review_datetime_utc',
        'review_likes',
        'reviews_id',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'reviews_per_score' => 'array',
            'rating' => 'decimal:2',
            'review_img_urls' => 'array',
            'owner_answer_timestamp' => 'integer',
            'owner_answer_timestamp_datetime_utc' => 'datetime',
            'review_rating' => 'integer',
            'review_timestamp' => 'integer',
            'review_datetime_utc' => 'datetime',
            'review_likes' => 'integer',
        ];
    }
}
