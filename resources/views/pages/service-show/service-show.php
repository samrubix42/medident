<?php

use App\Models\ClinicSetting;
use App\Models\Service;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    public Service $service;

    public function mount(string $slug): void
    {
        $this->service = Service::query()
            ->active()
            ->with('category')
            ->whereHas('category', fn (Builder $query): Builder => $query->active())
            ->where('slug', $slug)
            ->firstOrFail();
    }

    #[Computed]
    public function settings(): ClinicSetting
    {
        return ClinicSetting::current();
    }

    /**
     * @return Collection<int, Service>
     */
    #[Computed]
    public function relatedServices(): Collection
    {
        $relatedServices = Service::query()
            ->active()
            ->with('category')
            ->whereHas('category', fn (Builder $query): Builder => $query->active())
            ->whereKeyNot($this->service->id)
            ->when($this->service->service_category_id, function (Builder $query): void {
                $query->where('service_category_id', $this->service->service_category_id);
            })
            ->orderBy('id')
            ->take(3)
            ->get();

        if ($relatedServices->count() >= 3) {
            return $relatedServices;
        }

        $remaining = 3 - $relatedServices->count();

        $excludedIds = $relatedServices
            ->pluck('id')
            ->push($this->service->id);

        $fallbackServices = Service::query()
            ->active()
            ->with('category')
            ->whereHas('category', fn (Builder $query): Builder => $query->active())
            ->whereNotIn('id', $excludedIds)
            ->orderBy('id')
            ->take($remaining)
            ->get();

        return $relatedServices->concat($fallbackServices);
    }

    public function render()
    {
        $settings = $this->settings;
        $url = route('services.show', $this->service->slug);
        $title = $this->service->meta_title ?: $this->service->title.' | MediDENT Services';
        $description = $this->service->meta_description ?: $this->service->excerpt(160);
        $image = $this->service->imageUrl() ?: asset('images/hero-img.jpg');
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
                    'mainEntity' => ['@id' => $url.'#service'],
                    'breadcrumb' => ['@id' => $url.'#breadcrumb'],
                ],
                [
                    '@type' => 'MedicalProcedure',
                    '@id' => $url.'#service',
                    'name' => $this->service->title,
                    'description' => $description,
                    'url' => $url,
                    'image' => $image,
                    'provider' => ['@id' => $clinicId],
                ],
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
                            'name' => 'Services',
                            'item' => route('services'),
                        ],
                        [
                            '@type' => 'ListItem',
                            'position' => 3,
                            'name' => $this->service->title,
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
                'metaKeyword' => $this->service->meta_keyword,
                'metaImage' => $image,
                'metaRobots' => 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1',
                'ogType' => 'article',
                'ogTitle' => $title,
                'ogDescription' => $description,
                'schema' => $schemaJson,
            ]);
    }
};
