<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('google_id')->nullable();
            $table->string('place_id')->nullable();
            $table->text('location_link')->nullable();
            $table->text('reviews_link')->nullable();
            $table->json('reviews_per_score')->nullable();
            $table->decimal('rating', 3, 2)->nullable();
            $table->string('review_id')->unique();
            $table->string('review_pagination_id')->nullable();
            $table->text('author_link')->nullable();
            $table->string('author_title')->nullable();
            $table->string('author_id')->nullable();
            $table->text('author_image')->nullable();
            $table->longText('review_text')->nullable();
            $table->json('review_img_urls')->nullable();
            $table->text('review_img_url')->nullable();
            $table->text('owner_answer')->nullable();
            $table->bigInteger('owner_answer_timestamp')->nullable();
            $table->dateTime('owner_answer_timestamp_datetime_utc')->nullable();
            $table->text('review_link')->nullable();
            $table->unsignedTinyInteger('review_rating')->nullable();
            $table->bigInteger('review_timestamp')->nullable();
            $table->dateTime('review_datetime_utc')->nullable();
            $table->unsignedInteger('review_likes')->default(0);
            $table->string('reviews_id')->nullable();
            $table->timestamps();

            $table->index('place_id');
            $table->index('reviews_id');
            $table->index('review_datetime_utc');
            $table->index('review_rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
