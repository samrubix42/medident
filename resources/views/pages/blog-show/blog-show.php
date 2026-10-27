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
        $settings = $this->settings;
        $url = route('blog.show', $this->post->slug);
        $title = $this->post->meta_title ?: $this->post->title.' | MediDENT Blog';
        $description = $this->post->meta_description ?: $this->post->excerpt();
        $image = $this->post->featureImageUrl() ?: asset('logo.webp');
        $publishedAt = $this->post->created_at?->toIso8601String() ?? now()->toIso8601String();
        $modifiedAt = $this->post->updated_at?->toIso8601String() ?? $publishedAt;
        $clinicId = route('home').'#clinic';

        $clinic = array_filter([
            '@type' => 'MedicalClinic',
            '@id' => $clinicId,
            'name' => $settings->clinic_name,
            'url' => route('home'),
            'telephone' => $settings->phone,
            'image' => asset('logo.webp'),
            'address' => $settings->address ? [
                '@type' => 'PostalAddress',
                'streetAddress' => $settings->address,
                'addressLocality' => 'Ghaziabad',
                'addressRegion' => 'Uttar Pradesh',
                'postalCode' => '201002',
                'addressCountry' => 'IN',
            ] : null,
        ], fn (mixed $value): bool => $value !== null && $value !== '');

        $article = array_filter([
            '@type' => 'BlogPosting',
            '@id' => $url.'#article',
            'headline' => $this->post->title,
            'description' => $description,
            'url' => $url,
            'image' => $image,
            'datePublished' => $publishedAt,
            'dateModified' => $modifiedAt,
            'inLanguage' => 'en-IN',
            'articleSection' => $this->post->category?->title,
            'keywords' => $this->post->meta_keyword,
            'wordCount' => str_word_count(strip_tags($this->post->content)),
            'timeRequired' => 'PT'.$this->post->readingTime().'M',
            'author' => [
                '@type' => 'Organization',
                'name' => 'MediDENT Care Team',
                'url' => route('home'),
            ],
            'publisher' => ['@id' => $clinicId],
            'mainEntityOfPage' => ['@id' => $url.'#webpage'],
            'isPartOf' => ['@id' => route('home').'#website'],
        ], fn (mixed $value): bool => $value !== null && $value !== '');

        $schema = [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'WebSite',
                    '@id' => route('home').'#website',
                    'url' => route('home'),
                    'name' => $settings->clinic_name,
                ],
                [
                    '@type' => 'WebPage',
                    '@id' => $url.'#webpage',
                    'url' => $url,
                    'name' => $title,
                    'description' => $description,
                    'inLanguage' => 'en-IN',
                    'isPartOf' => ['@id' => route('home').'#website'],
                    'mainEntity' => ['@id' => $url.'#article'],
                    'breadcrumb' => ['@id' => $url.'#breadcrumb'],
                ],
                $article,
                $clinic,
                [
                    '@type' => 'BreadcrumbList',
                    '@id' => $url.'#breadcrumb',
                    'itemListElement' => [
                        [
                            '@type' => 'ListItem',
                            'position' => 1,
                            'name' => 'Home',
                            'item' => route('home'),
                        ],
                        [
                            '@type' => 'ListItem',
                            'position' => 2,
                            'name' => 'Blog',
                            'item' => route('blog'),
                        ],
                        [
                            '@type' => 'ListItem',
                            'position' => 3,
                            'name' => $this->post->title,
                            'item' => $url,
                        ],
                    ],
                ],
            ],
        ];

        $schemaJson = json_encode(
            $schema,
            JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT,
        );

        return $this->view()
            ->title($title)
            ->layoutData([
                'canonical' => $url,
                'metaDescription' => $description,
                'metaKeyword' => $this->post->meta_keyword,
                'metaImage' => $image,
                'metaRobots' => 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1',
                'ogType' => 'article',
                'ogTitle' => $title,
                'ogDescription' => $description,
                'articlePublishedTime' => $publishedAt,
                'articleModifiedTime' => $modifiedAt,
                'articleSection' => $this->post->category?->title,
                'schema' => $schemaJson,
            ]);
    }
};
