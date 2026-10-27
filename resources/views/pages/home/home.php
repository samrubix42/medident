<?php

use App\Models\Review;
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
     * @return array<int, array{title: string, description: string, image: string, alt: string, tag: string, icon: string, accent: string, hover: string}>
     */
    #[Computed]
    public function dentalServices(): array
    {
        return [
            [
                'title' => 'Cosmetic Dental',
                'description' => 'Cosmetic treatment is a type of dental treatment that is focused on improving the appearance of the teeth, gums, and smile.',
                'image' => 'dental/cosmetic-dental.jpg',
                'alt' => 'Cosmetic dental treatment',
                'tag' => 'Smile Design',
                'icon' => 'ri-sparkling-line',
                'accent' => 'text-med-blue',
                'hover' => 'hover:border-sky-200',
            ],
            [
                'title' => 'Kids Dentistry',
                'description' => 'Kids dentistry, also known as pediatric dentistry, is a branch of dentistry that focuses on the oral health of infants, children, and teenagers.',
                'image' => 'dental/KIDSDENTISTRY.jpg',
                'alt' => "Children's dental care",
                'tag' => 'Pediatric Care',
                'icon' => 'ri-user-smile-line',
                'accent' => 'text-amber-700',
                'hover' => 'hover:border-amber-200',
            ],
            [
                'title' => 'Dental Implants',
                'description' => 'A dental implant is a prosthetic device used to replace missing teeth. The implant is typically made of titanium and is surgically placed into the jawbone.',
                'image' => 'dental/Dental-Implants.jpg',
                'alt' => 'Dental implant treatment',
                'tag' => 'Tooth Replacement',
                'icon' => 'ri-tooth-line',
                'accent' => 'text-cyan-700',
                'hover' => 'hover:border-cyan-200',
            ],
            [
                'title' => 'Painless Extraction',
                'description' => 'Tooth extraction is the process of removing a tooth from its socket in the jawbone. While it is a common dental procedure, it is performed with care and modern techniques to keep you comfortable.',
                'image' => 'dental/painless-extraction.jpg',
                'alt' => 'Painless tooth extraction',
                'tag' => 'Gentle Care',
                'icon' => 'ri-shield-check-line',
                'accent' => 'text-emerald-700',
                'hover' => 'hover:border-emerald-200',
            ],
            [
                'title' => 'Dental Filling',
                'description' => 'Dental fillings are restorative materials used to repair teeth that have been damaged by decay or trauma.',
                'image' => 'dental/dental-filling.jpg',
                'alt' => 'Dental filling treatment',
                'tag' => 'Restorative Care',
                'icon' => 'ri-first-aid-kit-line',
                'accent' => 'text-violet-700',
                'hover' => 'hover:border-violet-200',
            ],
            [
                'title' => 'Root Canal Treatment',
                'description' => 'Root canal treatment (RCT) is a dental procedure used to treat a tooth that is infected or severely decayed.',
                'image' => 'dental/root-canal.jpg',
                'alt' => 'Root canal treatment',
                'tag' => 'Endodontic Care',
                'icon' => 'ri-heart-pulse-line',
                'accent' => 'text-med-red',
                'hover' => 'hover:border-red-200',
            ],
        ];
    }
};
