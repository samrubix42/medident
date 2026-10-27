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
            ->whereHas('category', fn (Builder $query): Builder => $query->where('slug', 'physician')->where('is_active', true))
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
            'general-diseases' => 'ri-stethoscope-line',
            'gastrointestinal-diseases' => 'ri-hospital-line',
            'heart-disease' => 'ri-heart-pulse-line',
            'thyroid-disorders' => 'ri-body-scan-line',
            'respiratory-diseases' => 'ri-lungs-line',
            'vaccination' => 'ri-syringe-line',
            default => 'ri-stethoscope-line',
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
                'question' => 'Who is Dr. Divya Prakash?',
                'answer' => 'Dr. Divya Prakash is a diabetologist and general physician in Ghaziabad with more than 10 years of experience. He consults at MediDENT Multicare Clinic in Shastri Nagar and at Yashoda Superspeciality Hospital and Cancer Institute in Sanjay Nagar.',
            ],
            [
                'question' => 'What are Dr. Divya Prakash qualifications?',
                'answer' => 'Dr. Divya Prakash completed his M.B.B.S. at Rajiv Gandhi University of Health Sciences, Karnataka. He completed his D.N.B. at Maharaja Agrasen Hospital, Punjabi Bagh, New Delhi, and his PGDGM through Maulana Azad Medical College (IGNOU), New Delhi. He also holds CCEBDM in diabetology.',
            ],
            [
                'question' => 'Which conditions does Dr. Divya Prakash treat?',
                'answer' => 'He treats diabetes, hypertension, thyroid disorders, respiratory conditions, gastrointestinal concerns, fever, infections, and other common medical problems. He also provides preventive health checks and vaccination guidance.',
            ],
            [
                'question' => 'Where can I consult Dr. Divya Prakash in Ghaziabad?',
                'answer' => 'You can consult him at MediDENT Multicare Clinic, SC-296, Hapur Road, C Block, Shastri Nagar, Ghaziabad. He also consults at Yashoda Superspeciality Hospital and Cancer Institute, Sanjay Nagar, Ghaziabad.',
            ],
            [
                'question' => 'What are Dr. Divya Prakash clinic timings?',
                'answer' => 'At MediDENT Multicare Clinic, he is available Monday to Saturday from 5:00 PM to 8:30 PM and Sunday from 10:00 AM to 12:00 noon. At Yashoda Superspeciality Hospital, he is available Monday to Saturday from 11:00 AM to 3:00 PM.',
            ],
            [
                'question' => 'How can I book an appointment with Dr. Divya Prakash?',
                'answer' => 'Call +91-8800023032 or 0120-4169996, or use the appointment option on this page. The clinic team will confirm a convenient consultation time.',
            ],
        ];
    }

    public function render()
    {
        $settings = $this->settings;
        $url = route('physician');
        $image = asset('doctors/Dr.-Divya-Prakash-2.jpg');

        $metadata = PageSeo::metadataFor(
            'physician',
            'Best Physician Doctor in Ghaziabad | Dr. Divya Prakash',
            'Dr. Divya Prakash is a diabetologist and general physician in Ghaziabad with over 10 years of experience. Book a consultation at MediDENT, Shastri Nagar.',
            'best physician in Ghaziabad, general physician Ghaziabad, diabetologist Ghaziabad, Dr Divya Prakash, physician near me Ghaziabad, consultant physician Shastri Nagar',
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
                    'mainEntity' => ['@id' => $url.'#physician'],
                    'breadcrumb' => ['@id' => $url.'#breadcrumb'],
                ],
                [
                    '@type' => 'ImageObject',
                    '@id' => $url.'#primaryimage',
                    'url' => $image,
                    'contentUrl' => $image,
                    'caption' => 'Dr. Divya Prakash, diabetologist and general physician in Ghaziabad',
                ],
                [
                    '@type' => 'Person',
                    '@id' => $url.'#person',
                    'name' => 'Dr. Divya Prakash',
                    'jobTitle' => 'Diabetologist & General Physician',
                    'description' => 'Dr. Divya Prakash is a diabetologist and general physician with over 10 years of experience in Ghaziabad and Delhi NCR.',
                    'image' => $image,
                    'url' => $url,
                    'worksFor' => ['@id' => $url.'#clinic'],
                    'medicalSpecialty' => ['Diabetology', 'General Practice', 'Internal Medicine'],
                    'alumniOf' => [
                        [
                            '@type' => 'CollegeOrUniversity',
                            'name' => 'Rajiv Gandhi University of Health Sciences, Karnataka',
                        ],
                        [
                            '@type' => 'Hospital',
                            'name' => 'Maharaja Agrasen Hospital, Punjabi Bagh, New Delhi',
                        ],
                        [
                            '@type' => 'CollegeOrUniversity',
                            'name' => 'Maulana Azad Medical College (IGNOU), New Delhi',
                        ],
                    ],
                    'hasCredential' => [
                        [
                            '@type' => 'EducationalOccupationalCredential',
                            'credentialCategory' => 'degree',
                            'name' => 'Bachelor of Medicine and Bachelor of Surgery (M.B.B.S.)',
                        ],
                        [
                            '@type' => 'EducationalOccupationalCredential',
                            'credentialCategory' => 'degree',
                            'name' => 'Diplomate of National Board (D.N.B.)',
                        ],
                        [
                            '@type' => 'EducationalOccupationalCredential',
                            'credentialCategory' => 'degree',
                            'name' => 'Post Graduate Diploma in General Medicine (PGDGM)',
                        ],
                        [
                            '@type' => 'EducationalOccupationalCredential',
                            'credentialCategory' => 'certificate',
                            'name' => 'CCEBDM (Diabetology)',
                        ],
                    ],
                    'memberOf' => [
                        [
                            '@type' => 'Hospital',
                            'name' => 'Yashoda Superspeciality Hospital and Cancer Institute, Sanjay Nagar, Ghaziabad',
                        ],
                        [
                            '@type' => 'Hospital',
                            'name' => 'Sarvodya Hospital, Kavi Nagar, Ghaziabad',
                        ],
                        [
                            '@type' => 'Hospital',
                            'name' => 'Gargi Hospital, Raj Nagar, Ghaziabad',
                        ],
                    ],
                    'knowsAbout' => $serviceNames !== [] ? $serviceNames : [
                        'Diabetes management',
                        'General medicine',
                        'Hypertension',
                        'Thyroid disorders',
                        'Respiratory conditions',
                        'Preventive health',
                    ],
                ],
                [
                    '@type' => 'Physician',
                    '@id' => $url.'#clinic',
                    'name' => $settings->clinic_name,
                    'description' => 'A medical clinic in Shastri Nagar, Ghaziabad providing general physician care, diabetes management and preventive health services.',
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
                        'name' => 'Ghaziabad',
                    ],
                    'medicalSpecialty' => ['Diabetology', 'General Practice', 'Internal Medicine'],
                    'employee' => ['@id' => $url.'#person'],
                    'openingHoursSpecification' => [
                        [
                            '@type' => 'OpeningHoursSpecification',
                            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                            'opens' => '17:00',
                            'closes' => '20:30',
                        ],
                        [
                            '@type' => 'OpeningHoursSpecification',
                            'dayOfWeek' => 'Sunday',
                            'opens' => '10:00',
                            'closes' => '12:00',
                        ],
                    ],
                    'hasOfferCatalog' => [
                        '@type' => 'OfferCatalog',
                        'name' => 'Physician services',
                        'itemListElement' => $services,
                    ],
                ],
                [
                    '@type' => 'Hospital',
                    '@id' => $url.'#yashoda',
                    'name' => 'Yashoda Superspeciality Hospital and Cancer Institute',
                    'address' => [
                        '@type' => 'PostalAddress',
                        'streetAddress' => 'Sanjay Nagar',
                        'addressLocality' => 'Ghaziabad',
                        'addressRegion' => 'Uttar Pradesh',
                        'addressCountry' => 'IN',
                    ],
                    'employee' => ['@id' => $url.'#person'],
                    'openingHoursSpecification' => [
                        '@type' => 'OpeningHoursSpecification',
                        'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                        'opens' => '11:00',
                        'closes' => '15:00',
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
                            'name' => 'Dr. Divya Prakash',
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
