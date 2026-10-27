<?php

use App\Models\ClinicSetting;
use App\Models\PageSeo;
use App\Models\Review;
use App\Models\Service;
use Illuminate\Database\Eloquent\Builder;
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

    /**
     * @return list<array{question: string, answer: string}>
     */
    #[Computed]
    public function faqs(): array
    {
        $settings = ClinicSetting::current();
        $phone = $settings->phone ?: '+91 88000 23032';
        $address = $settings->address ?: 'Shastri Nagar, Ghaziabad';
        $hours = $settings->openingHoursLines();
        $hours = $hours !== [] ? implode(' and ', $hours) : 'Monday to Saturday';

        return [
            [
                'question' => 'What services are available at MediDENT Multicare Clinic?',
                'answer' => 'We provide general medical consultations, diabetes and chronic condition care, preventive health checks, vaccinations, and dental care for children and adults.',
            ],
            [
                'question' => 'Do I need an appointment to visit the clinic?',
                'answer' => "Appointments are recommended so the team can plan enough time for your concern. Call {$phone} to check availability and whether a same-day visit is possible.",
            ],
            [
                'question' => 'What are the clinic timings?',
                'answer' => "The clinic is open {$hours}. Please call ahead on public holidays to confirm availability.",
            ],
            [
                'question' => 'Where is MediDENT Multicare Clinic located?',
                'answer' => "{$address}.",
            ],
            [
                'question' => 'Does the clinic provide dental care for children?',
                'answer' => 'Yes. Our dental team provides gentle pediatric and preventive care, including first dental visits, routine check-ups, and guidance for parents.',
            ],
            [
                'question' => 'How can I book an appointment?',
                'answer' => "Call {$phone} or use the contact page to send an enquiry. The team will confirm a suitable consultation time with you.",
            ],
        ];
    }

    /**
     * @return list<array{title: string, description: string, slug: string, image: string|null, alt: string, tag: string, icon: string, accent: string, hover: string}>
     */
    #[Computed]
    public function physicianServices(): array
    {
        return $this->servicesForCategory('physician');
    }

    /**
     * @return list<array{title: string, description: string, slug: string, image: string|null, alt: string, tag: string, icon: string, accent: string, hover: string}>
     */
    #[Computed]
    public function dentalServices(): array
    {
        return $this->servicesForCategory('dental');
    }

    /**
     * @return list<array{title: string, description: string, slug: string, image: string|null, alt: string, tag: string, icon: string, accent: string, hover: string}>
     */
    private function servicesForCategory(string $categorySlug): array
    {
        return Service::query()
            ->active()
            ->whereHas('category', fn (Builder $query): Builder => $query->where('slug', $categorySlug)->where('is_active', true))
            ->orderBy('id')
            ->get()
            ->map(function (Service $service) use ($categorySlug): array {
                $meta = $this->serviceCardMeta($service->slug, $categorySlug);

                return [
                    'title' => $service->title,
                    'description' => $service->excerpt(180),
                    'slug' => $service->slug,
                    'image' => $service->imageUrl(),
                    'alt' => $service->title.' at MediDENT Multicare Clinic, Ghaziabad',
                    'tag' => $meta['tag'],
                    'icon' => $meta['icon'],
                    'accent' => $meta['accent'],
                    'hover' => $meta['hover'],
                ];
            })
            ->all();
    }

    /**
     * @return array{tag: string, icon: string, accent: string, hover: string}
     */
    private function serviceCardMeta(string $slug, string $categorySlug): array
    {
        return match ($slug) {
            'general-diseases' => [
                'tag' => 'General Medicine',
                'icon' => 'ri-stethoscope-line',
                'accent' => 'text-med-blue',
                'hover' => 'hover:border-sky-200',
            ],
            'gastrointestinal-diseases' => [
                'tag' => 'Digestive Health',
                'icon' => 'ri-capsule-line',
                'accent' => 'text-emerald-700',
                'hover' => 'hover:border-emerald-200',
            ],
            'heart-disease' => [
                'tag' => 'Heart Health',
                'icon' => 'ri-heart-pulse-line',
                'accent' => 'text-med-red',
                'hover' => 'hover:border-red-200',
            ],
            'thyroid-disorders' => [
                'tag' => 'Hormonal Health',
                'icon' => 'ri-pulse-line',
                'accent' => 'text-violet-700',
                'hover' => 'hover:border-violet-200',
            ],
            'respiratory-diseases' => [
                'tag' => 'Respiratory Health',
                'icon' => 'ri-lungs-line',
                'accent' => 'text-cyan-700',
                'hover' => 'hover:border-cyan-200',
            ],
            'vaccination' => [
                'tag' => 'Preventive Care',
                'icon' => 'ri-syringe-line',
                'accent' => 'text-amber-700',
                'hover' => 'hover:border-amber-200',
            ],
            'cosmetic-dental' => [
                'tag' => 'Smile Design',
                'icon' => 'ri-sparkling-line',
                'accent' => 'text-med-blue',
                'hover' => 'hover:border-sky-200',
            ],
            'kids-dentistry' => [
                'tag' => 'Pediatric Care',
                'icon' => 'ri-user-smile-line',
                'accent' => 'text-amber-700',
                'hover' => 'hover:border-amber-200',
            ],
            'dental-implants' => [
                'tag' => 'Tooth Replacement',
                'icon' => 'ri-tooth-line',
                'accent' => 'text-cyan-700',
                'hover' => 'hover:border-cyan-200',
            ],
            'painless-extraction' => [
                'tag' => 'Gentle Care',
                'icon' => 'ri-shield-check-line',
                'accent' => 'text-emerald-700',
                'hover' => 'hover:border-emerald-200',
            ],
            'dental-filling' => [
                'tag' => 'Restorative Care',
                'icon' => 'ri-first-aid-kit-line',
                'accent' => 'text-violet-700',
                'hover' => 'hover:border-violet-200',
            ],
            'root-canal-treatment' => [
                'tag' => 'Endodontic Care',
                'icon' => 'ri-heart-pulse-line',
                'accent' => 'text-med-red',
                'hover' => 'hover:border-red-200',
            ],
            default => $categorySlug === 'dental'
                ? [
                    'tag' => 'Dental Care',
                    'icon' => 'ri-tooth-line',
                    'accent' => 'text-cyan-700',
                    'hover' => 'hover:border-cyan-200',
                ]
                : [
                    'tag' => 'Medical Care',
                    'icon' => 'ri-stethoscope-line',
                    'accent' => 'text-med-blue',
                    'hover' => 'hover:border-sky-200',
                ],
        };
    }

    public function render()
    {
        $metadata = PageSeo::metadataFor(
            'home',
            'MediDENT Multicare Clinic | Doctor & Dentist in Shastri Nagar, Ghaziabad',
            'Visit MediDENT Multicare Clinic in Shastri Nagar, Ghaziabad for general physician care, diabetes management, dental treatments and preventive health checks.',
            'MediDENT Multicare Clinic, doctor in Shastri Nagar, dentist in Ghaziabad, diabetes care Ghaziabad, general physician Ghaziabad, dental clinic Shastri Nagar',
        );

        return $this->view()
            ->title($metadata['title'])
            ->layoutData([
                'canonical' => route('home'),
                'metaDescription' => $metadata['description'],
                'metaKeyword' => $metadata['keywords'],
            ]);
    }
};
