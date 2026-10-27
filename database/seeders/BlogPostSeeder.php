<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Diabetes Prevention: How a Diabetologist Can Help',
                'slug' => 'diabetes-prevention-how-a-diabetologist-can-help',
                'category_slug' => 'diabetes-care',
                'content' => <<<'HTML'
<p>Diabetes is a chronic condition that affects millions of people worldwide. While there is no cure, it can be effectively managed and, in some cases, prevented.</p>
<p>A diabetologist can help assess your risk, guide lifestyle changes, monitor your health, and support early intervention. Book a consultation to understand your diabetes risk and the right prevention plan for you.</p>
HTML,
                'meta_title' => 'Diabetes Prevention: How a Diabetologist Can Help | MediDENT Blog',
                'meta_description' => 'Diabetes can be managed and sometimes prevented. Learn how a diabetologist helps with risk assessment, lifestyle changes, and early intervention.',
                'meta_keyword' => 'Diabetes Prevention, Diabetes Prevention Guidelines, Diabetes Prevention Tips, Diabetologist, Preventing Diabetes Naturally, Preventive Measures for Diabetes',
                'feature_image' => 'blog/diabetes-prevention-how-a-diabetologist-can-help.jpg',
                'is_active' => true,
                'created_at' => '2023-05-23 17:19:55',
            ],
            [
                'title' => 'How a Physician Can Help You Achieve Optimal Health',
                'slug' => 'how-a-physician-can-help-you-achieve-optimal-health',
                'category_slug' => 'general-health',
                'content' => <<<'HTML'
<p>Physicians are highly trained medical professionals who play a crucial role in promoting and maintaining optimal health. They diagnose and treat a wide range of medical conditions and provide preventive care and advice to help patients reach their health goals.</p>
<p>Regular consultations can help you understand your health, manage ongoing concerns, and take practical steps toward better wellbeing.</p>
HTML,
                'meta_title' => 'How a Physician Can Help You Achieve Optimal Health | MediDENT Blog',
                'meta_description' => 'Learn how a physician supports optimal health through diagnosis, treatment, preventive care, and practical health advice.',
                'meta_keyword' => 'best physician in ghaziabad, best physician near me, General Physician, primary care physician',
                'feature_image' => 'blog/how-a-physician-can-help-you-achieve-optimal-health.jpg',
                'is_active' => true,
                'created_at' => '2023-05-04 16:46:35',
            ],
            [
                'title' => 'The Benefits of Cosmetic Dentistry: Beyond Just a Brighter Smile',
                'slug' => 'the-benefits-of-cosmetic-dentistry-beyond-just-a-brighter-smile',
                'category_slug' => 'dental-care',
                'content' => <<<'HTML'
<p>Cosmetic dentistry refers to a range of dental procedures that improve the appearance of a person's teeth, gums, and bite. While a brighter smile is often the most obvious benefit, there are many other advantages, including improved self-esteem and confidence.</p>
<p>Cosmetic treatment can also support better oral function and help you feel more comfortable with your smile.</p>
HTML,
                'meta_title' => 'The Benefits of Cosmetic Dentistry: Beyond Just a Brighter Smile | MediDENT Blog',
                'meta_description' => 'Cosmetic dentistry is about more than a brighter smile. Explore the confidence, function, and oral health benefits of cosmetic dental care.',
                'meta_keyword' => 'Best Dentist, Best dentist in ghaziabad, Cosmetic Dental Care, Kids Dentistry',
                'feature_image' => 'blog/the-benefits-of-cosmetic-dentistry-beyond-just-a-brighter-smile.png',
                'is_active' => true,
                'created_at' => '2023-03-29 17:07:30',
            ],
            [
                'title' => 'The Benefits of a Multi Care Clinic for Patients & Families',
                'slug' => 'the-benefits-of-a-multi-care-clinic-for-patients-families',
                'category_slug' => 'general-health',
                'content' => <<<'HTML'
<p>A multi-care clinic provides various healthcare services under one roof. This gives patients and families the convenience of accessing multiple services in one location, saving time and effort while supporting more coordinated care.</p>
<p>Having medical and dental care available together can make it easier to manage appointments for the whole family.</p>
HTML,
                'meta_title' => 'The Benefits of a Multi Care Clinic for Patients & Families | MediDENT Blog',
                'meta_description' => 'Discover how a multi-care clinic brings medical and dental services together for convenient, coordinated care for patients and families.',
                'meta_keyword' => 'Health Care, Multi Care Clinic, Multi Care Clinic Ghaziabad, Multi Speciality Clinic Ghaziabad',
                'feature_image' => 'blog/the-benefits-of-a-multi-care-clinic-for-patients-families.png',
                'is_active' => true,
                'created_at' => '2023-03-23 16:14:07',
            ],
            [
                'title' => '5 Simple Health Care Tips for the Busy Professional',
                'slug' => '5-simple-health-care-tips-for-the-busy-professional',
                'category_slug' => 'general-health',
                'content' => <<<'HTML'
<p>As a busy professional, it can be challenging to prioritize your health and well-being. Taking care of your health is essential to stay productive and efficient, and a few simple habits can make a meaningful difference.</p>
<p>Focus on practical changes you can repeat consistently rather than trying to overhaul everything at once.</p>
HTML,
                'meta_title' => '5 Simple Health Care Tips for the Busy Professional | MediDENT Blog',
                'meta_description' => 'Five practical health care tips to help busy professionals protect their energy, manage stress, and stay well.',
                'meta_keyword' => 'Eat Healthy food, health, Health Care, healthy diet, healthy food, healthy lifestyle, mental health, primary care physician, Stay Healthy',
                'feature_image' => 'blog/5-simple-health-care-tips-for-the-busy-professional.png',
                'is_active' => true,
                'created_at' => '2023-03-16 17:26:58',
            ],
            [
                'title' => 'Top 10 Most Common Reasons To Meet The Best General Physician',
                'slug' => 'top-10-most-common-reasons-to-meet-the-best-general-physician',
                'category_slug' => 'general-health',
                'content' => <<<'HTML'
<p>Having a primary care physician is important for both individuals and families. They provide an avenue for good health and give patients peace of mind.</p>
<p>Regular visits can help with routine check-ups, respiratory infections, digestive issues, blood pressure, diabetes, joint pain, allergies, and other common health concerns.</p>
HTML,
                'meta_title' => 'Top 10 Most Common Reasons To Meet The Best General Physician | MediDENT Blog',
                'meta_description' => 'From routine check-ups to chronic care, discover the most common reasons to meet a general physician.',
                'meta_keyword' => 'General Physician, Health Care',
                'feature_image' => 'blog/top-10-most-common-reasons-to-meet-the-best-general-physician.jpg',
                'is_active' => true,
                'created_at' => '2023-03-03 16:03:00',
            ],
            [
                'title' => 'Top 10 Ways to Keep Your Teeth Healthy - Oral Health Tips',
                'slug' => 'top-10-ways-to-keep-your-teeth-healthy-oral-health-tips',
                'category_slug' => 'dental-care',
                'content' => <<<'HTML'
<p>Achieving and maintaining healthy teeth requires consistent effort and attention. Developing good dental care habits from a young age is essential for maintaining healthy teeth and gums throughout life.</p>
<p>Small daily habits, regular dental reviews, and timely treatment can help prevent common oral health problems.</p>
HTML,
                'meta_title' => 'Top 10 Ways to Keep Your Teeth Healthy - Oral Health Tips | MediDENT Blog',
                'meta_description' => 'Simple, consistent oral health habits can help protect your teeth and gums for life. Explore ten practical tips.',
                'meta_keyword' => 'Best Dentist, Dental Care Tips, Oral Health, Oral Health Tips',
                'feature_image' => 'blog/top-10-ways-to-keep-your-teeth-healthy-oral-health-tips.png',
                'is_active' => true,
                'created_at' => '2023-03-03 15:30:01',
            ],
            [
                'title' => 'Top 10 Dental Care Tips to Improve Your Oral Hygiene Routine',
                'slug' => 'top-10-dental-care-tips-to-improve-your-oral-hygiene-routine',
                'category_slug' => 'dental-care',
                'content' => <<<'HTML'
<p>Dental care is the practice of maintaining good oral hygiene and preventing problems such as tooth decay, gum disease, and bad breath. It involves regular brushing, flossing, dental check-ups, and professional cleaning.</p>
<p>A consistent routine and regular dental reviews can help keep your teeth and gums healthy over time.</p>
HTML,
                'meta_title' => 'Top 10 Dental Care Tips to Improve Your Oral Hygiene Routine | MediDENT Blog',
                'meta_description' => 'Improve your daily oral hygiene routine with ten practical dental care tips from MediDENT Multicare Clinic.',
                'meta_keyword' => 'Best Dentist, Dental Care, Dental Care Tips, Oral Health, Oral Health Tips',
                'feature_image' => 'blog/top-10-dental-care-tips-to-improve-your-oral-hygiene-routine.jpg',
                'is_active' => true,
                'created_at' => '2023-03-03 15:14:12',
            ],
        ];

        $categoryIds = BlogCategory::query()->pluck('id', 'slug');

        foreach ($posts as $post) {
            $categoryId = $categoryIds[$post['category_slug']] ?? null;
            $createdAt = Carbon::parse($post['created_at']);

            unset($post['category_slug'], $post['created_at']);

            $blogPost = BlogPost::updateOrCreate(
                ['slug' => $post['slug']],
                [
                    ...$post,
                    'category_id' => $categoryId,
                ],
            );

            $blogPost->forceFill(['created_at' => $createdAt])->saveQuietly();
        }
    }
}
