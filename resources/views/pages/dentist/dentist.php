<?php

use App\Models\ClinicSetting;
use App\Models\PageSeo;
use App\Models\Service;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    #[Computed]
    public function settings(): ClinicSetting
    {
        return ClinicSetting::current();
    }

    /**
     * @return list<array{title: string, description: string, icon: string, image: string|null, alt: string}>
     */
    #[Computed]
    public function services(): array
    {
        return Service::query()
            ->active()
            ->whereHas('category', fn (Builder $query): Builder => $query->where('slug', 'dental')->where('is_active', true))
            ->orderBy('id')
            ->get()
            ->map(fn (Service $service): array => [
                'title' => $service->title,
                'description' => $service->short_description ?: Str::limit(strip_tags($service->content), 180),
                'icon' => $this->serviceIcon($service->slug),
                'image' => $service->imageUrl(),
                'alt' => $service->title.' at MediDENT Multicare Clinic, Ghaziabad',
            ])
            ->all();
    }

    private function serviceIcon(string $slug): string
    {
        return match ($slug) {
            'cosmetic-dental' => 'ri-sparkling-line',
            'kids-dentistry' => 'ri-user-smile-line',
            'dental-implants' => 'ri-tooth-line',
            'painless-extraction' => 'ri-shield-check-line',
            'dental-filling' => 'ri-first-aid-kit-line',
            'root-canal-treatment' => 'ri-heart-pulse-line',
            default => 'ri-tooth-line',
        };
    }

    /**
     * @return list<array{question: string, answer: string}>
     */
    #[Computed]
    public function faqs(): array
    {
        return [
            [
                'question' => 'Who is Dr. Ratika Gupta?',
                'answer' => 'Dr. Ratika Gupta is a dental surgeon with more than 12 years of clinical experience in Ghaziabad and Delhi NCR. She practises at MediDENT Multicare Clinic in Shastri Nagar, Ghaziabad, and provides preventive, pediatric, cosmetic, and implant dentistry.',
            ],
            [
                'question' => 'What are Dr. Ratika Gupta’s educational qualifications?',
                'answer' => 'Dr. Ratika Gupta completed her B.D.S. at Bankey Bihari Dental College, Ghaziabad, under CCS University, Meerut. She completed her M.D.S. at Jaipur Dental College.',
            ],
            [
                'question' => 'Which dental services does Dr. Ratika Gupta provide?',
                'answer' => 'Her dental services include general and preventive dentistry, pediatric and preventive dentistry, cosmetic dentistry, dental implants, root canal treatment, gum care, and orthodontic guidance.',
            ],
            [
                'question' => 'Does Dr. Ratika Gupta treat children?',
                'answer' => 'Yes. Pediatric and preventive dentistry is one of her core areas of care. She treats children with a calm, patient approach and focuses on building positive dental habits early.',
            ],
            [
                'question' => 'Where is Dr. Ratika Gupta’s clinic in Shastri Nagar?',
                'answer' => 'Dr. Ratika Gupta practises at MediDENT Multicare Clinic, SC-296, Hapur Road, C Block, Shastri Nagar, Ghaziabad, Uttar Pradesh 201002.',
            ],
            [
                'question' => 'How can I book a dental appointment with Dr. Ratika Gupta?',
                'answer' => 'You can call the clinic at +91-8290582582 or use the book appointment option on this page. The team will confirm a convenient consultation time with you.',
            ],
        ];
    }

    public function render()
    {
        $settings = $this->settings;
        $url = route('dentist');
        $image = asset('dental/Dr.-Ratika-Gupta-4.jpg');

        $metadata = PageSeo::metadataFor(
            'dentist',
            'Dr. Ratika Gupta: Best Dentist in Shastri Nagar, Ghaziabad',
            'Dr. Ratika Gupta, B.D.S., M.D.S., is an experienced dental surgeon in Shastri Nagar, Ghaziabad offering family, cosmetic and implant dentistry. Book a visit.',
            'best dentist in Shastri Nagar, dentist in Shastri Nagar Ghaziabad, Dr Ratika Gupta, dental surgeon Ghaziabad, pediatric dentist Ghaziabad, cosmetic dentistry Ghaziabad, dental implants Ghaziabad, root canal treatment Ghaziabad',
        );

        $title = $metadata['title'];
        $description = $metadata['description'];

        $serviceNames = array_column($this->services, 'title');

        $services = collect($this->services)
            ->map(fn (array $service): array => [
                '@type' => 'Offer',
                'itemOffered' => [
                    '@type' => 'MedicalProcedure',
                    'name' => $service['title'],
                    'description' => $service['description'],
                ],
            ])
            ->all();

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
                    'primaryImageOfPage' => ['@id' => $url.'#primaryimage'],
                    'mainEntity' => ['@id' => $url.'#dentist'],
                    'breadcrumb' => ['@id' => $url.'#breadcrumb'],
                ],
                [
                    '@type' => 'ImageObject',
                    '@id' => $url.'#primaryimage',
                    'url' => $image,
                    'contentUrl' => $image,
                    'caption' => 'Dr. Ratika Gupta, dental surgeon in Shastri Nagar, Ghaziabad',
                ],
                [
                    '@type' => 'Person',
                    '@id' => $url.'#person',
                    'name' => 'Dr. Ratika Gupta',
                    'jobTitle' => 'Dental Surgeon',
                    'description' => 'Dr. Ratika Gupta is a dental surgeon with over 12 years of experience in Ghaziabad and Delhi NCR.',
                    'image' => $image,
                    'url' => $url,
                    'worksFor' => ['@id' => $url.'#dentist'],
                    'alumniOf' => [
                        [
                            '@type' => 'CollegeOrUniversity',
                            'name' => 'Bankey Bihari Dental College, Ghaziabad (CCS University, Meerut)',
                        ],
                        [
                            '@type' => 'CollegeOrUniversity',
                            'name' => 'Jaipur Dental College',
                        ],
                    ],
                    'hasCredential' => [
                        [
                            '@type' => 'EducationalOccupationalCredential',
                            'credentialCategory' => 'degree',
                            'name' => 'Bachelor of Dental Surgery (B.D.S.)',
                        ],
                        [
                            '@type' => 'EducationalOccupationalCredential',
                            'credentialCategory' => 'degree',
                            'name' => 'Master of Dental Surgery (M.D.S.)',
                        ],
                    ],
                    'knowsAbout' => $serviceNames !== [] ? $serviceNames : [
                        'General dentistry',
                        'Pediatric and preventive dentistry',
                        'Cosmetic dentistry',
                        'Dental implants',
                        'Root canal treatment',
                        'Orthodontic guidance',
                    ],
                ],
                [
                    '@type' => 'Dentist',
                    '@id' => $url.'#dentist',
                    'name' => $settings->clinic_name,
                    'description' => 'A dental clinic in Shastri Nagar, Ghaziabad providing preventive, pediatric, cosmetic, and implant dentistry.',
                    'url' => route('home'),
                    'image' => $image,
                    'telephone' => $settings->phone,
                    'address' => [
                        '@type' => 'PostalAddress',
                        'streetAddress' => $settings->address,
                        'addressLocality' => 'Ghaziabad',
                        'addressRegion' => 'Uttar Pradesh',
                        'postalCode' => '201002',
                        'addressCountry' => 'IN',
                    ],
                    'areaServed' => [
                        '@type' => 'City',
                        'name' => 'Shastri Nagar, Ghaziabad',
                    ],
                    'medicalSpecialty' => 'Dentistry',
                    'employee' => ['@id' => $url.'#person'],
                    'openingHoursSpecification' => [
                        [
                            '@type' => 'OpeningHoursSpecification',
                            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                            'opens' => '11:00',
                            'closes' => '13:00',
                        ],
                        [
                            '@type' => 'OpeningHoursSpecification',
                            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                            'opens' => '17:00',
                            'closes' => '20:00',
                        ],
                    ],
                    'hasOfferCatalog' => [
                        '@type' => 'OfferCatalog',
                        'name' => 'Dental services',
                        'itemListElement' => $services,
                    ],
                ],
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
                            'name' => 'About Us',
                            'item' => route('about'),
                        ],
                        [
                            '@type' => 'ListItem',
                            'position' => 3,
                            'name' => 'Dr. Ratika Gupta',
                            'item' => $url,
                        ],
                    ],
                ],
                [
                    '@type' => 'FAQPage',
                    '@id' => $url.'#faq',
                    'mainEntity' => collect($this->faqs)
                        ->map(fn (array $faq): array => [
                            '@type' => 'Question',
                            'name' => $faq['question'],
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => $faq['answer'],
                            ],
                        ])
                        ->all(),
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
                'metaKeyword' => $metadata['keywords'],
                'metaImage' => $image,
                'metaRobots' => 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1',
                'ogType' => 'profile',
                'ogTitle' => $title,
                'ogDescription' => $description,
                'schema' => $schemaJson,
            ]);
    }
};
