<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $heartHealthContent = <<<'MARKDOWN'
## Small habits, meaningful impact

Heart health is not built through a single dramatic change. It grows from the small choices you repeat most days: how you move, what you eat, how well you sleep, and whether you pay attention to the signs your body gives you.

At MediDENT Multicare Clinic, we encourage patients to think of heart care as an ongoing partnership. Regular checks help you understand your baseline, while everyday habits help protect it.

## 1. Move a little every day

You do not need an intense workout to support your heart. A brisk walk, cycling, household work, or a short exercise routine can all help. The key is consistency.

Start with what feels manageable. Even ten to fifteen minutes of activity is a useful beginning. Over time, you can gradually increase the duration or intensity.

## 2. Know your numbers

Blood pressure, blood sugar, cholesterol, and body weight all tell part of your heart health story. Many people do not notice changes until a routine check-up reveals them.

If you have a family history of heart disease, diabetes, or high blood pressure, regular monitoring becomes even more important.

## 3. Build balanced meals

A heart-friendly plate usually includes vegetables, whole grains, protein, and healthy fats. Try to limit heavily processed foods, excess salt, and sugary drinks.

You do not need to remove every treat from your diet. Focus on the overall pattern and make changes you can sustain.

## 4. Protect your sleep

Poor sleep can affect blood pressure, stress levels, and energy. A consistent sleep schedule and a calm bedtime routine can make a real difference.

If you regularly wake up feeling unrested, or if snoring and breathing pauses have been noticed by a family member, it is worth discussing with a doctor.

## 5. Do not ignore warning signs

Chest discomfort, unusual breathlessness, fainting, or unexplained fatigue should not be ignored. Seek medical advice promptly, especially if symptoms are new or worsening.

## When to book a consultation

A routine heart health discussion is a good next step if you have risk factors, ongoing symptoms, or simply want clarity about your health. Our team can help you understand what to monitor and when further evaluation is needed.
MARKDOWN;

        $coughContent = <<<'MARKDOWN'
## A cough that lingers

Most coughs are temporary and improve as the body recovers from a mild infection. A cough that persists for several weeks, keeps returning, or comes with other symptoms deserves a closer look.

The cause may be simple, but a proper assessment can help rule out conditions that need treatment.

## Common causes of a persistent cough

- Viral infections that leave the airways sensitive for a while
- Allergies or exposure to dust and smoke
- Asthma or other breathing conditions
- Acid reflux
- Sinus problems with post-nasal drip
- Certain medicines

The pattern matters. A dry cough, a cough with mucus, a nighttime cough, or a cough triggered by exercise can point in different directions.

## When to see a doctor

Book a consultation if your cough:

- Lasts more than three weeks
- Is accompanied by fever, chest pain, or breathlessness
- Produces blood
- Causes disturbed sleep or significant fatigue
- Keeps recurring over months

Children, older adults, and people with chronic health conditions should be assessed earlier if symptoms are concerning.

## What to expect at your visit

Your doctor will ask about how the cough started, what makes it better or worse, and whether you have other symptoms. A physical examination may be followed by tests if needed.

Avoid self-prescribing antibiotics. Not every cough is bacterial, and unnecessary medicines can cause more harm than benefit.

## Supporting recovery at home

Rest, fluids, and avoiding smoke or strong irritants can help while you recover. If symptoms are worsening or not improving, get medical advice rather than waiting indefinitely.
MARKDOWN;

        $kidsDentalContent = <<<'MARKDOWN'
## Healthy teeth start early

Children's dental care is about more than keeping teeth clean. Early habits shape how a child feels about dental visits and help prevent pain, infection, and long-term problems.

The goal is simple: make care gentle, consistent, and part of normal family life.

## Start with the first tooth

Once a tooth appears, it can be cleaned with a soft brush and a small smear of fluoride toothpaste. Parents should brush for young children and supervise older children until they can brush well on their own.

## Keep sugary snacks occasional

Frequent sugary snacks and drinks expose teeth to acid again and again. Water is the best everyday drink, and sweets are easier on teeth when enjoyed with meals rather than throughout the day.

## Do not wait for pain

A child may have a cavity without complaining. Regular dental check-ups can catch small problems early, when treatment is usually simpler and more comfortable.

## Make visits positive

Use calm, simple language. Avoid telling a child that a visit will hurt or that they will be punished for not brushing. A friendly first visit helps build trust.

## What parents can watch for

- White or brown spots on teeth
- Sensitivity to hot or cold
- Bleeding gums
- Bad breath that persists
- Difficulty chewing
- A tooth that looks injured after a fall

## A routine worth keeping

Brushing twice a day, limiting sugary drinks, and scheduling regular dental reviews give children a strong foundation for lifelong oral health.
MARKDOWN;

        $bloodSugarContent = <<<'MARKDOWN'
## Understanding blood sugar checks

Blood sugar monitoring can feel confusing at first, especially when numbers change from day to day. The purpose is not to judge yourself. It is to understand patterns and make better decisions with your care team.

## Why monitoring matters

Checking blood sugar helps show how food, activity, medicines, sleep, and stress affect your body. Over time, these patterns can guide treatment and help prevent complications.

## Common ways to monitor

Your doctor may recommend different checks depending on your needs:

- Fasting blood sugar
- Post-meal blood sugar
- HbA1c, which reflects average blood sugar over time
- Home glucose monitoring for selected patients

Not everyone needs the same testing schedule. The right plan depends on your diagnosis, medicines, and overall health.

## Keep a simple record

Note the reading, the time, and anything relevant such as a meal, exercise, or feeling unwell. A basic record is often more useful than trying to remember weeks of numbers.

## Do not adjust medicines alone

If readings are frequently high or low, speak with your doctor. Changing doses without guidance can be unsafe, particularly with insulin or medicines that can cause low blood sugar.

## Watch for low blood sugar

Shakiness, sweating, confusion, hunger, or a racing heartbeat can be warning signs. If you are at risk, keep a fast-acting sugar source nearby and follow your care plan.

## Build a plan you can follow

Diabetes care works best when it is practical. Bring your readings and questions to your next consultation so your plan can be adjusted to your real life.
MARKDOWN;

        $rootCanalContent = <<<'MARKDOWN'
## Root canal treatment: what to expect

A root canal is a dental procedure used when the inside of a tooth becomes infected or badly inflamed. It can relieve pain and help save a tooth that might otherwise need removal.

The name can sound intimidating, but modern treatment is usually comfortable and predictable when done at the right time.

## Why a root canal may be needed

Common reasons include:

- Deep decay reaching the tooth's nerve
- Infection after a previous filling or injury
- A cracked or fractured tooth
- Persistent sensitivity or pain in a specific tooth

Your dentist will examine the tooth and may take an X-ray to confirm the diagnosis.

## What happens during treatment

The affected area is numbed. The dentist removes infected tissue from inside the tooth, cleans and shapes the canals, and seals them. In many cases, a crown or permanent restoration is needed afterward to protect the tooth.

Treatment may take one or more visits depending on the tooth and the extent of infection.

## Is it painful?

With modern local anaesthesia, the procedure is usually not painful. Many patients are surprised at how similar it feels to a routine filling. Mild tenderness afterward can happen and usually settles with the advised care.

## After treatment

Follow your dentist's instructions about eating, cleaning, and medicines. Avoid chewing hard foods on the treated tooth until your final restoration is in place.

Seek advice if you notice worsening pain, swelling, or a loose restoration.

## Do not delay care

Waiting until pain becomes severe can make treatment more complex. If a tooth is consistently painful or sensitive, arrange a dental review early.
MARKDOWN;

        $preventiveContent = <<<'MARKDOWN'
## Why preventive check-ups matter

Preventive health check-ups are an opportunity to understand your health before symptoms become difficult to ignore. They are not only for people who feel unwell.

A routine review can identify risk factors, update screenings, and help you make informed decisions about your health.

## What a check-up may include

Depending on your age, history, and concerns, your doctor may discuss:

- Blood pressure and weight
- Blood sugar and cholesterol
- Vaccination status
- Lifestyle and family history
- Mental wellbeing
- Screening tests appropriate for you

The conversation is often as important as the tests. Your doctor can help you understand what matters most for your situation.

## Prevention is personal

Your family history, work, daily routine, and existing conditions all influence your health risks. A preventive plan should fit your life rather than follow a one-size-fits-all checklist.

## Make the most of your visit

Bring a list of medicines, recent reports, and any symptoms or questions you have been putting aside. Small concerns are easier to address early.

## How often should you go?

There is no single schedule for everyone. Your doctor can recommend a review interval based on your health and risk factors. People with ongoing conditions may need more frequent follow-up.

## Take the first step

If it has been a while since your last check-up, book a consultation. Prevention is not about finding problems everywhere. It is about knowing your health and acting early when something needs attention.
MARKDOWN;

        $posts = [
            [
                'title' => '5 Everyday Habits That Support Better Heart Health',
                'slug' => 'everyday-habits-better-heart-health',
                'category_slug' => 'heart-health',
                'content' => Str::markdown($heartHealthContent),
                'meta_title' => '5 Everyday Habits That Support Better Heart Health | MediDENT Blog',
                'meta_description' => 'Small, consistent choices can make a meaningful difference to your heart. Here are five practical habits to focus on.',
                'meta_keyword' => 'heart health, healthy habits, blood pressure, exercise',
                'feature_image' => 'images/heart.jpg',
                'is_active' => true,
                'created_at' => now()->subDays(4),
            ],
            [
                'title' => 'When Should You See a Doctor for a Persistent Cough?',
                'slug' => 'persistent-cough-when-to-see-a-doctor',
                'category_slug' => 'respiratory-care',
                'content' => Str::markdown($coughContent),
                'meta_title' => 'When Should You See a Doctor for a Persistent Cough? | MediDENT Blog',
                'meta_description' => 'Most coughs settle on their own, but some need medical attention. Learn the signs that mean it is time to book a review.',
                'meta_keyword' => 'persistent cough, respiratory care, when to see a doctor',
                'feature_image' => 'images/respiratory.jpg',
                'is_active' => true,
                'created_at' => now()->subDays(11),
            ],
            [
                'title' => "A Simple Guide to Children's Dental Care",
                'slug' => 'simple-guide-childrens-dental-care',
                'category_slug' => 'dental-care',
                'content' => Str::markdown($kidsDentalContent),
                'meta_title' => "A Simple Guide to Children's Dental Care | MediDENT Blog",
                'meta_description' => 'From the first tooth to the first dental visit, a few consistent habits can set children up for lifelong oral health.',
                'meta_keyword' => 'childrens dental care, kids dentist, oral health',
                'feature_image' => 'dental/KIDSDENTISTRY.jpg',
                'is_active' => true,
                'created_at' => now()->subDays(18),
            ],
            [
                'title' => 'Understanding Blood Sugar Checks and Diabetes Care',
                'slug' => 'understanding-blood-sugar-checks-diabetes-care',
                'category_slug' => 'diabetes-care',
                'content' => Str::markdown($bloodSugarContent),
                'meta_title' => 'Understanding Blood Sugar Checks and Diabetes Care | MediDENT Blog',
                'meta_description' => 'Blood sugar numbers are a tool for understanding patterns, not a score to judge yourself by. Here is how to use them well.',
                'meta_keyword' => 'blood sugar, diabetes care, HbA1c, glucose monitoring',
                'feature_image' => 'images/general-diseases.jpg',
                'is_active' => true,
                'created_at' => now()->subDays(27),
            ],
            [
                'title' => 'Root Canal Treatment: What to Expect',
                'slug' => 'root-canal-treatment-what-to-expect',
                'category_slug' => 'dental-care',
                'content' => Str::markdown($rootCanalContent),
                'meta_title' => 'Root Canal Treatment: What to Expect | MediDENT Blog',
                'meta_description' => 'A root canal can relieve pain and save a damaged tooth. Here is a clear look at the process, comfort, and recovery.',
                'meta_keyword' => 'root canal, dental treatment, tooth pain, endodontics',
                'feature_image' => 'dental/root-canal.jpg',
                'is_active' => true,
                'created_at' => now()->subDays(38),
            ],
            [
                'title' => 'Why Preventive Health Check-ups Matter',
                'slug' => 'why-preventive-health-check-ups-matter',
                'category_slug' => 'general-health',
                'content' => Str::markdown($preventiveContent),
                'meta_title' => 'Why Preventive Health Check-ups Matter | MediDENT Blog',
                'meta_description' => 'A routine check-up is a chance to understand your health early. Here is what to expect and how to prepare.',
                'meta_keyword' => 'preventive health checkup, health screening, family medicine',
                'feature_image' => 'images/vaccination.jpg',
                'is_active' => true,
                'created_at' => now()->subDays(52),
            ],
        ];

        $categoryIds = BlogCategory::query()->pluck('id', 'slug');

        foreach ($posts as $post) {
            $categoryId = $categoryIds[$post['category_slug']] ?? null;
            $createdAt = $post['created_at'];

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
