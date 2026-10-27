<?php

namespace Database\Seeders;

use App\Models\PageSeo;
use Illuminate\Database\Seeder;

class PageSeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'page_name' => 'Home',
                'page_slug' => 'home',
                'meta_title' => 'MediDENT Multicare Clinic | Doctor & Dentist in Shastri Nagar, Ghaziabad',
                'meta_description' => 'Visit MediDENT Multicare Clinic in Shastri Nagar, Ghaziabad for general physician care, diabetes management, dental treatments and preventive health checks.',
                'meta_keywords' => 'MediDENT Multicare Clinic, doctor in Shastri Nagar, dentist in Ghaziabad, diabetes care Ghaziabad, general physician Ghaziabad, dental clinic Shastri Nagar',
            ],
            [
                'page_name' => 'About Us',
                'page_slug' => 'about',
                'meta_title' => 'About MediDENT Multicare Clinic | Doctors in Ghaziabad',
                'meta_description' => 'Meet the doctors and learn about MediDENT Multicare Clinic\'s approach to general medicine, diabetes care and family dentistry in Shastri Nagar, Ghaziabad.',
                'meta_keywords' => 'about MediDENT Multicare Clinic, doctors in Shastri Nagar Ghaziabad, Dr Divya Prakash, Dr Ratika Gupta, clinic in Ghaziabad',
            ],
            [
                'page_name' => 'Gallery',
                'page_slug' => 'gallery',
                'meta_title' => 'Clinic Gallery | MediDENT Multicare Clinic, Ghaziabad',
                'meta_description' => 'Explore photos of MediDENT Multicare Clinic in Shastri Nagar, Ghaziabad, including our consultation rooms, dental care facilities and patient care spaces.',
                'meta_keywords' => 'MediDENT clinic photos, medical clinic gallery Ghaziabad, dental clinic gallery Shastri Nagar, clinic facilities Ghaziabad',
            ],
            [
                'page_name' => 'Health Blog',
                'page_slug' => 'blog',
                'meta_title' => 'Health Blog | Medical & Dental Advice | MediDENT',
                'meta_description' => 'Read practical health guidance from MediDENT Multicare Clinic on preventive care, diabetes, heart health, dental treatments and everyday wellbeing.',
                'meta_keywords' => 'health blog Ghaziabad, medical advice Shastri Nagar, dental care tips, diabetes information, heart health guidance',
            ],
            [
                'page_name' => 'Services',
                'page_slug' => 'services',
                'meta_title' => 'Medical & Dental Services in Shastri Nagar, Ghaziabad',
                'meta_description' => 'Explore medical, preventive and dental services at MediDENT Multicare Clinic in Shastri Nagar, Ghaziabad, including general physician care, heart health, vaccination and family dentistry.',
                'meta_keywords' => 'medical services Ghaziabad, dental services Shastri Nagar, general physician Ghaziabad, dental clinic Ghaziabad, MediDENT services',
            ],
            [
                'page_name' => 'Contact Us',
                'page_slug' => 'contact',
                'meta_title' => 'Contact MediDENT Multicare Clinic in Shastri Nagar, Ghaziabad',
                'meta_description' => 'Get the address, phone number, opening hours and map directions for MediDENT Multicare Clinic in Shastri Nagar, Ghaziabad. Book an appointment online.',
                'meta_keywords' => 'contact MediDENT clinic, clinic address Shastri Nagar Ghaziabad, book doctor appointment Ghaziabad, dental appointment Shastri Nagar',
            ],
            [
                'page_name' => 'Dr. Ratika Gupta',
                'page_slug' => 'dentist',
                'meta_title' => 'Dr. Ratika Gupta: Best Dentist in Shastri Nagar, Ghaziabad',
                'meta_description' => 'Dr. Ratika Gupta, B.D.S., M.D.S., is an experienced dental surgeon in Shastri Nagar, Ghaziabad offering family, cosmetic and implant dentistry. Book a visit.',
                'meta_keywords' => 'best dentist in Shastri Nagar, dentist in Shastri Nagar Ghaziabad, Dr Ratika Gupta, dental surgeon Ghaziabad, pediatric dentist Ghaziabad, cosmetic dentistry Ghaziabad, dental implants Ghaziabad, root canal treatment Ghaziabad',
            ],
            [
                'page_name' => 'Dr. Divya Prakash',
                'page_slug' => 'physician',
                'meta_title' => 'Best Physician Doctor in Ghaziabad | Dr. Divya Prakash',
                'meta_description' => 'Dr. Divya Prakash is a diabetologist and general physician in Ghaziabad with over 10 years of experience. Book a consultation at MediDENT, Shastri Nagar.',
                'meta_keywords' => 'best physician in Ghaziabad, general physician Ghaziabad, diabetologist Ghaziabad, Dr Divya Prakash, physician near me Ghaziabad, consultant physician Shastri Nagar',
            ],
        ];

        foreach ($pages as $page) {
            PageSeo::updateOrCreate(
                ['page_slug' => $page['page_slug']],
                $page,
            );
        }
    }
}
