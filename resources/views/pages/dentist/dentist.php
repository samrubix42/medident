<?php

use App\Models\ClinicSetting;
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
     * @return list<array{title: string, description: string, icon: string}>
     */
    #[Computed]
    public function services(): array
    {
        return [
            [
                'title' => 'General & Preventive Dentistry',
                'description' => 'Routine dental check-ups, professional cleaning, cavity treatment, and gum health assessments to protect your smile before problems become painful.',
                'icon' => 'ri-tooth-line',
            ],
            [
                'title' => 'Pediatric & Preventive Dentistry',
                'description' => 'Gentle dental care for children, including first-tooth guidance, preventive check-ups, and age-appropriate treatment in a calm, reassuring environment.',
                'icon' => 'ri-user-smile-line',
            ],
            [
                'title' => 'Cosmetic Dentistry',
                'description' => 'Smile-focused care such as teeth whitening and veneers, planned around your dental health, facial features, and personal goals.',
                'icon' => 'ri-magic-line',
            ],
            [
                'title' => 'Dental Implants',
                'description' => 'Implant-based solutions for missing teeth, with a careful assessment of your bone health, bite, and long-term oral function.',
                'icon' => 'ri-surgical-mask-line',
            ],
            [
                'title' => 'Root Canal Treatment',
                'description' => 'Treatment for infected or badly inflamed teeth to relieve pain and preserve your natural tooth whenever possible.',
                'icon' => 'ri-heart-pulse-line',
            ],
            [
                'title' => 'Orthodontic Guidance',
                'description' => 'Assessment and guidance for crowded, spaced, or misaligned teeth, including orthodontic treatment options suited to your needs.',
                'icon' => 'ri-align-center',
            ],
        ];
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
        $title = 'Dr. Ratika Gupta: Best Dentist in Shastri Nagar, Ghaziabad';
        $description = 'Dr. Ratika Gupta, B.D.S., M.D.S., is an experienced dental surgeon in Shastri Nagar, Ghaziabad offering family, cosmetic and implant dentistry. Book a visit.';

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
                    'knowsAbout' => [
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
                'metaKeyword' => 'best dentist in Shastri Nagar, dentist in Shastri Nagar Ghaziabad, Dr Ratika Gupta, dental surgeon Ghaziabad, pediatric dentist Ghaziabad, cosmetic dentistry Ghaziabad, dental implants Ghaziabad, root canal treatment Ghaziabad',
                'metaImage' => $image,
                'metaRobots' => 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1',
                'ogType' => 'profile',
                'ogTitle' => $title,
                'ogDescription' => $description,
                'schema' => $schemaJson,
            ]);
    }
};
