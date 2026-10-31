<?php

use App\Models\ClinicSetting;
use App\Models\PageSeo;
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
    public function areasOfExpertise(): array
    {
        return [
            [
                'title' => 'Recurrent abdominal pain',
                'description' => 'Careful evaluation of long-standing tummy pain, including functional and organic causes.',
                'icon' => 'ri-heart-2-line',
            ],
            [
                'title' => 'Constipation',
                'description' => 'Gentle bowel-habit assessment with diet, toilet training and medication guidance.',
                'icon' => 'ri-stethoscope-line',
            ],
            [
                'title' => 'GERD & chronic vomiting',
                'description' => 'Diagnosis and management of reflux, persistent vomiting and feeding difficulty.',
                'icon' => 'ri-hospital-line',
            ],
            [
                'title' => 'Food allergies & celiac disease',
                'description' => 'Structured allergy review, coeliac testing and practical elimination diets for children.',
                'icon' => 'ri-shield-check-line',
            ],
            [
                'title' => 'Inflammatory bowel disease',
                'description' => 'Long-term care for children with Crohn’s disease, ulcerative colitis and very early onset IBD.',
                'icon' => 'ri-microscope-line',
            ],
            [
                'title' => 'Childhood liver diseases & jaundice',
                'description' => 'Assessment of liver disorders, prolonged jaundice and liver-related nutritional needs.',
                'icon' => 'ri-body-scan-line',
            ],
            [
                'title' => 'Gastrointestinal bleeding',
                'description' => 'Evaluation of blood in vomit or stool, with endoscopic assessment where indicated.',
                'icon' => 'ri-first-aid-kit-line',
            ],
            [
                'title' => 'Pediatric gastrointestinal endoscopy',
                'description' => 'Fellowship-trained upper and lower gastrointestinal endoscopic procedures in children.',
                'icon' => 'ri-lungs-line',
            ],
        ];
    }

    /**
     * @return list<array{role: string, organisation: string, duration: string, highlights: list<string>}>
     */
    #[Computed]
    public function experience(): array
    {
        return [
            [
                'role' => 'Fellow, Pediatric Gastroenterology, Hepatology & Nutrition',
                'organisation' => 'Indraprastha Apollo Hospital, New Delhi',
                'duration' => 'ISPGHAN Fellowship · 2023–2024',
                'highlights' => [
                    'Advanced training in pediatric digestive, liver and nutritional disorders.',
                    'Fellowship-level exposure to pediatric gastrointestinal endoscopy.',
                ],
            ],
            [
                'role' => 'Fellow, Pediatric Gastroenterology, Hepatology & Nutrition',
                'organisation' => 'Bai Jerbai Wadia Hospital, Mumbai',
                'duration' => 'M.U.H.S. Fellowship · 2022–2023',
                'highlights' => [
                    'Structured fellowship training at a pediatric referral hospital.',
                    'Clinical care for infants, children and adolescents with gastrointestinal and liver conditions.',
                ],
            ],
            [
                'role' => 'Senior Resident',
                'organisation' => 'Kalawati Saran Children’s Hospital (LHMC) & Chacha Nehru Bal Chikitsalaya, Delhi',
                'duration' => '3 years of senior residency',
                'highlights' => [
                    'Three years of broad pediatric inpatient and emergency experience.',
                    'Care of newborns, children and adolescents in high-volume pediatric units.',
                ],
            ],
        ];
    }

    /**
     * @return list<array{title: string, journal: string}>
     */
    #[Computed]
    public function publications(): array
    {
        return [
            [
                'title' => 'Plummer Vinson Syndrome and role of Endoscopic Balloon dilatation in a 4 year old child',
                'journal' => 'Journal of Pediatric Gastroenterology Reports',
            ],
            [
                'title' => 'Clinical Evaluation of Acute Respiratory Distress and Chest Wheezing in Infants',
                'journal' => 'Journal of Natural Science, Biology and Medicine',
            ],
            [
                'title' => 'Serum Thyroid Profile and its Correlation to Clinical Outcome in Critically Ill Children',
                'journal' => 'International Journal of Health Sciences',
            ],
            [
                'title' => 'Comparison of Caffeine versus Aminophylline for Apnea of Prematurity',
                'journal' => 'Biomedical and Pharmacology Journal',
            ],
        ];
    }

    /**
     * @return list<array{title: string, event: string, year: string, recognition: string|null}>
     */
    #[Computed]
    public function conferences(): array
    {
        return [
            [
                'title' => 'E-poster presentation',
                'event' => 'European Society of Pediatric Gastroenterology, Hepatology and Nutrition (ESPGHAN) Conference',
                'year' => '2025',
                'recognition' => 'Young Investigator Award',
            ],
            [
                'title' => 'Clinical and genetic spectrum of very early onset inflammatory bowel disease – a single center experience',
                'event' => 'ISPGHAN Conference',
                'year' => '2024',
                'recognition' => null,
            ],
            [
                'title' => 'Serum Thyroid Profile in Critically Ill Children and its Correlation to Clinical Outcome',
                'event' => 'MAHAPEDICRITICON (Maharashtra State Conference)',
                'year' => '2019',
                'recognition' => 'Second Prize',
            ],
            [
                'title' => 'Unilateral Neonatal Adrenal Hematoma Presenting with Signs of Adrenal Insufficiency',
                'event' => 'MAHAPEDICRITICON (Maharashtra State Conference)',
                'year' => '2019',
                'recognition' => 'First Prize',
            ],
            [
                'title' => 'VACTERL Syndrome with Bilateral Choanal Atresia and Bed Side Treatment of Choanal Atresia',
                'event' => 'MAHAPEDICON (Maharashtra State Conference)',
                'year' => '2018',
                'recognition' => null,
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
                'question' => 'Who is Dr. Megha Rustagi?',
                'answer' => 'Dr. Megha Rustagi is a pediatrician and pediatric gastroenterologist and hepatologist. She has over 10 years of experience in pediatrics, with fellowship training in pediatric gastroenterology, hepatology and nutrition at Indraprastha Apollo Hospital, New Delhi and Bai Jerbai Wadia Hospital, Mumbai.',
            ],
            [
                'question' => 'What are Dr. Megha Rustagi’s qualifications?',
                'answer' => 'She completed her M.B.B.S. at Jhalawar Medical College, Jhalawar, Rajasthan, and her M.D. Pediatrics at Krishna Institute of Medical Sciences, Karad, Maharashtra. She then completed an M.U.H.S. Fellowship at Bai Jerbai Wadia Hospital, Mumbai, and an ISPGHAN Fellowship at Indraprastha Apollo Hospital, New Delhi.',
            ],
            [
                'question' => 'Which conditions does Dr. Megha Rustagi treat?',
                'answer' => 'Her areas of expertise include recurrent abdominal pain, constipation, GERD, chronic vomiting, food allergies, celiac disease, inflammatory bowel disease, childhood liver diseases, jaundice and gastrointestinal bleeding in infants, children and adolescents.',
            ],
            [
                'question' => 'Does Dr. Megha Rustagi perform endoscopy in children?',
                'answer' => 'Yes. She has fellowship training in pediatric gastrointestinal endoscopic procedures. Endoscopy is recommended only when it is clinically appropriate, and the reasons, preparation and aftercare are explained clearly to parents.',
            ],
            [
                'question' => 'Where can I consult Dr. Megha Rustagi in Ghaziabad?',
                'answer' => 'Dr. Megha Rustagi consults by appointment at MediDENT Multicare Clinic, SC-296, Hapur Road, C Block, Shastri Nagar, Ghaziabad, Uttar Pradesh 201002.',
            ],
            [
                'question' => 'How can I book an appointment with Dr. Megha Rustagi?',
                'answer' => 'Call the clinic at +91-8800023032 or 0120-4169996, or use the book appointment option on this page. The clinic team will confirm a convenient consultation time for your child.',
            ],
        ];
    }

    public function render()
    {
        $settings = $this->settings;
        $url = route('gastroenterologist');
        $image = asset('doctors/Dr.-Megha-Rustagi.jpeg');

        $metadata = PageSeo::metadataFor(
            'gastroenterologist',
            'Dr. Megha Rustagi | Pediatric Gastroenterologist in Ghaziabad',
            'Dr. Megha Rustagi is a pediatric gastroenterologist and hepatologist in Ghaziabad with over 10 years of pediatric experience, treating digestive, liver and nutritional disorders in children.',
            'pediatric gastroenterologist Ghaziabad, child gastroenterologist Ghaziabad, pediatric hepatologist Ghaziabad, Dr Megha Rustagi, child digestion specialist, pediatric liver specialist Ghaziabad, pediatric endoscopy Ghaziabad',
        );

        $title = $metadata['title'];
        $description = $metadata['description'];

        $expertiseNames = array_column($this->areasOfExpertise, 'title');

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
                    'caption' => 'Dr. Megha Rustagi, pediatric gastroenterologist and hepatologist in Ghaziabad',
                ],
                [
                    '@type' => 'Person',
                    '@id' => $url.'#person',
                    'name' => 'Dr. Megha Rustagi',
                    'jobTitle' => 'Pediatric Gastroenterologist & Hepatologist',
                    'description' => 'Dr. Megha Rustagi is a pediatrician and pediatric gastroenterologist and hepatologist with over 10 years of experience in pediatrics.',
                    'image' => $image,
                    'url' => $url,
                    'worksFor' => ['@id' => $url.'#physician'],
                    'medicalSpecialty' => ['Pediatric Gastroenterology', 'Pediatric Hepatology'],
                    'alumniOf' => [
                        [
                            '@type' => 'CollegeOrUniversity',
                            'name' => 'Jhalawar Medical College, Jhalawar, Rajasthan',
                        ],
                        [
                            '@type' => 'CollegeOrUniversity',
                            'name' => 'Krishna Institute of Medical Sciences, Karad, Maharashtra',
                        ],
                        [
                            '@type' => 'Hospital',
                            'name' => 'Bai Jerbai Wadia Hospital, Mumbai',
                        ],
                        [
                            '@type' => 'Hospital',
                            'name' => 'Indraprastha Apollo Hospital, New Delhi',
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
                            'name' => 'Doctor of Medicine in Pediatrics (M.D. Pediatrics)',
                        ],
                        [
                            '@type' => 'EducationalOccupationalCredential',
                            'credentialCategory' => 'certificate',
                            'name' => 'M.U.H.S. Fellowship in Pediatric Gastroenterology, Hepatology and Nutrition',
                        ],
                        [
                            '@type' => 'EducationalOccupationalCredential',
                            'credentialCategory' => 'certificate',
                            'name' => 'ISPGHAN Fellowship in Pediatric Gastroenterology, Hepatology and Nutrition',
                        ],
                    ],
                    'memberOf' => [
                        [
                            '@type' => 'Hospital',
                            'name' => 'Kalawati Saran Children’s Hospital (LHMC), Delhi',
                        ],
                        [
                            '@type' => 'Hospital',
                            'name' => 'Chacha Nehru Bal Chikitsalaya, Delhi',
                        ],
                    ],
                    'knowsAbout' => $expertiseNames,
                ],
                [
                    '@type' => 'Physician',
                    '@id' => $url.'#physician',
                    'name' => $settings->clinic_name,
                    'description' => 'A multicare clinic in Shastri Nagar, Ghaziabad providing pediatric gastroenterology, general physician care, diabetes management and family dentistry.',
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
                    'medicalSpecialty' => ['Pediatric Gastroenterology', 'Pediatric Hepatology', 'Pediatrics'],
                    'employee' => ['@id' => $url.'#person'],
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
                            'name' => 'Dr. Megha Rustagi',
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
