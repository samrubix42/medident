<?php

use App\Models\PageSeo;
use Livewire\Component;

new class extends Component
{
    public function render()
    {
        $metadata = PageSeo::metadataFor(
            'about',
            'About MediDENT Multicare Clinic | Doctors in Ghaziabad',
            'Meet the doctors and learn about MediDENT Multicare Clinic\'s approach to general medicine, diabetes care, pediatric gastroenterology and family dentistry in Shastri Nagar, Ghaziabad.',
            'about MediDENT Multicare Clinic, doctors in Shastri Nagar Ghaziabad, Dr Divya Prakash, Dr Ratika Gupta, Dr Megha Rustagi, pediatric gastroenterologist Ghaziabad, clinic in Ghaziabad',
        );

        return $this->view()
            ->title($metadata['title'])
            ->layoutData([
                'canonical' => route('about'),
                'metaDescription' => $metadata['description'],
                'metaKeyword' => $metadata['keywords'],
            ]);
    }
};
