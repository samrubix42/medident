<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ServiceCategory::query()
            ->whereIn('slug', ['physician', 'dental'])
            ->get()
            ->keyBy('slug');

        $services = [
            [
                'category' => 'physician',
                'title' => 'General Diseases',
                'slug' => 'general-diseases',
                'short_description' => 'Consultation for common illnesses, fever, infections and other everyday health concerns, with guidance on appropriate treatment and prevention.',
                'image_link' => 'images/general-diseases.jpg',
                'meta_title' => 'General Disease Treatment in Shastri Nagar, Ghaziabad',
                'meta_description' => 'Get medical consultation for fever, infections, seasonal illnesses and everyday health concerns at MediDENT Multicare Clinic, Shastri Nagar, Ghaziabad.',
                'meta_keyword' => 'general physician Ghaziabad, fever treatment Shastri Nagar, infection consultation, general diseases doctor',
                'content' => <<<'HTML'
<h2>Everyday medical care for common illnesses</h2>

<p>General diseases include the everyday health concerns that affect people of all ages, such as fever, throat infections, seasonal colds, body aches, weakness and minor injuries. Many of these problems can be assessed and treated effectively with a timely medical consultation.</p>

<p>At MediDENT Multicare Clinic, our physician reviews your symptoms, medical history and current medicines before recommending a suitable plan. When a problem needs tests or specialist attention, the next step is explained clearly.</p>

<h3>What this consultation can help with</h3>

<ul>
    <li>Fever, cold, cough and throat infections</li>
    <li>Body pain, weakness and fatigue</li>
    <li>Recurring headaches or seasonal allergies</li>
    <li>Minor skin, ear or urinary concerns</li>
    <li>Preventive advice and general health check-ups</li>
</ul>

<h3>What to expect during your visit</h3>

<p>Your consultation begins with a discussion of your symptoms and how long they have been present. Blood pressure, temperature and other relevant observations may be checked. If medicine is needed, you will receive instructions about dosage, duration and follow-up.</p>

<p>Please book an appointment if symptoms are persistent, worsening or accompanied by breathlessness, chest pain, confusion or dehydration.</p>
HTML,
            ],
            [
                'category' => 'physician',
                'title' => 'Gastrointestinal Diseases',
                'slug' => 'gastrointestinal-diseases',
                'short_description' => 'Medical evaluation for digestive concerns such as acidity, indigestion, abdominal discomfort and changes in bowel habits.',
                'image_link' => 'images/gastro.jpg',
                'meta_title' => 'Digestive & Gastrointestinal Care in Ghaziabad',
                'meta_description' => 'Consult a physician for acidity, indigestion, stomach pain, bloating and bowel changes at MediDENT Multicare Clinic in Shastri Nagar, Ghaziabad.',
                'meta_keyword' => 'gastroenterology consultation Ghaziabad, acidity treatment, indigestion doctor, stomach pain Shastri Nagar',
                'content' => <<<'HTML'
<h2>Care for digestive discomfort and gut health</h2>

<p>Digestive symptoms can be uncomfortable and worrying, especially when they keep returning. Acidity, bloating, indigestion, abdominal pain and changes in bowel habits may be linked to food, stress, infection, medicines or an underlying condition.</p>

<p>A proper consultation helps identify the likely cause and decide whether simple lifestyle changes, medication or further testing is appropriate.</p>

<h3>Common concerns we assess</h3>

<ul>
    <li>Acidity, reflux and heartburn</li>
    <li>Indigestion, gas and bloating</li>
    <li>Abdominal pain or cramping</li>
    <li>Constipation or loose motions</li>
    <li>Loss of appetite or unexplained weight change</li>
</ul>

<h3>How your evaluation works</h3>

<p>Your physician will ask about your eating pattern, bowel habits, medicines and previous digestive problems. Based on this information, an examination may be performed and relevant tests may be advised. Treatment is then tailored to your symptoms and health needs.</p>

<p>Seek urgent medical attention for severe abdominal pain, persistent vomiting, black stools or blood in the stool.</p>
HTML,
            ],
            [
                'category' => 'physician',
                'title' => 'Heart Disease',
                'slug' => 'heart-disease',
                'short_description' => 'Assessment of cardiovascular risk factors, blood pressure concerns and symptoms that may require further heart health evaluation.',
                'image_link' => 'images/heart.jpg',
                'meta_title' => 'Heart Disease & Blood Pressure Consultation in Ghaziabad',
                'meta_description' => 'Get heart health assessment for blood pressure, chest discomfort and cardiovascular risk factors at MediDENT Multicare Clinic, Shastri Nagar, Ghaziabad.',
                'meta_keyword' => 'heart disease doctor Ghaziabad, blood pressure consultation, cardiovascular risk assessment, chest pain check-up',
                'content' => <<<'HTML'
<h2>Understand your heart health and risk factors</h2>

<p>Heart disease is not always obvious. High blood pressure, raised cholesterol, diabetes, smoking, excess weight, poor sleep and a family history of heart problems can quietly increase risk over time.</p>

<p>Our physician can assess your symptoms and risk factors, arrange appropriate tests and guide you on the next steps. When specialist cardiology care is needed, you will be advised accordingly.</p>

<h3>Reasons to book a heart health consultation</h3>

<ul>
    <li>High or fluctuating blood pressure</li>
    <li>Chest discomfort, palpitations or unusual breathlessness</li>
    <li>Diabetes, high cholesterol or a family history of heart disease</li>
    <li>Unexplained fatigue, swelling or reduced exercise tolerance</li>
    <li>Guidance on prevention and regular monitoring</li>
</ul>

<h3>What your consultation includes</h3>

<p>Your history, lifestyle, current medicines and symptoms will be reviewed, followed by a physical examination and blood pressure check. If required, investigations such as blood tests or an ECG may be recommended. You will also receive practical advice on diet, activity and risk reduction.</p>

<p>Chest pain, fainting or sudden severe breathlessness needs urgent medical attention.</p>
HTML,
            ],
            [
                'category' => 'physician',
                'title' => 'Thyroid Disorders',
                'slug' => 'thyroid-disorders',
                'short_description' => 'Evaluation and management of thyroid-related concerns, including hormone imbalances that can affect energy, metabolism and overall wellbeing.',
                'image_link' => 'images/throid.jpg',
                'meta_title' => 'Thyroid Disorder Consultation in Shastri Nagar, Ghaziabad',
                'meta_description' => 'Consult for thyroid symptoms such as fatigue, weight changes and hair loss at MediDENT Multicare Clinic in Shastri Nagar, Ghaziabad.',
                'meta_keyword' => 'thyroid doctor Ghaziabad, thyroid test Shastri Nagar, hypothyroidism consultation, hyperthyroidism treatment',
                'content' => <<<'HTML'
<h2>Care for thyroid-related symptoms</h2>

<p>The thyroid gland influences energy, metabolism, body temperature, weight and mood. When hormone levels are too high or too low, symptoms can develop gradually and may be mistaken for stress or normal ageing.</p>

<p>An assessment can help connect your symptoms with the right tests and treatment. If you are already on thyroid medicine, your dose and monitoring schedule can be reviewed.</p>

<h3>Symptoms that may need evaluation</h3>

<ul>
    <li>Persistent tiredness or low energy</li>
    <li>Unexplained weight gain or weight loss</li>
    <li>Feeling unusually cold or hot</li>
    <li>Hair thinning, dry skin or mood changes</li>
    <li>Neck swelling or a known thyroid condition</li>
</ul>

<h3>How thyroid care is planned</h3>

<p>Your physician will review your symptoms, family history and current medicines. A thyroid function test or other relevant investigations may be advised. Treatment and follow-up depend on the type of thyroid problem, your age and overall health.</p>

<p>Do not stop or change thyroid medication without medical advice.</p>
HTML,
            ],
            [
                'category' => 'physician',
                'title' => 'Respiratory Diseases',
                'slug' => 'respiratory-diseases',
                'short_description' => 'Consultation for breathing difficulties, persistent cough, asthma-related concerns and other respiratory symptoms.',
                'image_link' => 'images/respiratory.jpg',
                'meta_title' => 'Respiratory & Breathing Problems Doctor in Ghaziabad',
                'meta_description' => 'Get medical help for persistent cough, breathlessness, wheezing and asthma-related symptoms at MediDENT Multicare Clinic, Shastri Nagar, Ghaziabad.',
                'meta_keyword' => 'respiratory doctor Ghaziabad, breathing difficulty treatment, asthma consultation, persistent cough Shastri Nagar',
                'content' => <<<'HTML'
<h2>Support for breathing and lung-related concerns</h2>

<p>Respiratory symptoms can range from a mild cough to breathlessness that limits daily activity. Allergies, infections, asthma, pollution exposure and smoking are among the common factors that may contribute.</p>

<p>A careful consultation helps determine how serious the symptoms are and whether further testing or specialist care is needed.</p>

<h3>When to seek a consultation</h3>

<ul>
    <li>A cough lasting more than two to three weeks</li>
    <li>Wheezing, chest tightness or noisy breathing</li>
    <li>Shortness of breath during routine activity</li>
    <li>Recurring chest infections</li>
    <li>Asthma symptoms that are not well controlled</li>
</ul>

<h3>What to expect</h3>

<p>Your physician will ask about the pattern of symptoms, triggers, smoking history and any known allergies. A chest examination and oxygen saturation check may be performed. Depending on the findings, inhalers, medicines, tests or a specialist referral may be recommended.</p>

<p>Severe breathlessness, blue lips, confusion or chest pain requires emergency care.</p>
HTML,
            ],
            [
                'category' => 'physician',
                'title' => 'Vaccination',
                'slug' => 'vaccination',
                'short_description' => 'Preventive vaccination services and guidance on recommended immunisation schedules for eligible children and adults.',
                'image_link' => 'images/vaccination.jpg',
                'meta_title' => 'Vaccination & Immunisation Services in Ghaziabad',
                'meta_description' => 'Ask about recommended vaccines for children and adults at MediDENT Multicare Clinic in Shastri Nagar, Ghaziabad. Book a vaccination consultation.',
                'meta_keyword' => 'vaccination clinic Ghaziabad, adult vaccination Shastri Nagar, child immunisation, preventive healthcare',
                'content' => <<<'HTML'
<h2>Preventive care through timely vaccination</h2>

<p>Vaccination is one of the most effective ways to reduce the risk of serious infectious diseases. Children, adults, older people and anyone with ongoing health conditions may benefit from different vaccines at different stages of life.</p>

<p>Our team can review your age, health history and previous immunisations before advising on what is due.</p>

<h3>Vaccination guidance may include</h3>

<ul>
    <li>Routine childhood immunisation schedules</li>
    <li>Missed or delayed vaccine catch-up plans</li>
    <li>Seasonal influenza vaccination</li>
    <li>Adult and travel-related vaccine advice</li>
    <li>Recommendations for eligible people with chronic conditions</li>
</ul>

<h3>What to expect</h3>

<p>You will be asked about previous vaccines, allergies and current health. The vaccine is then given according to the recommended schedule, followed by brief observation where appropriate. You will receive advice on expected side effects and when to seek help.</p>

<p>Bring your existing immunisation record to your appointment if you have one.</p>
HTML,
            ],
            [
                'category' => 'dental',
                'title' => 'Cosmetic Dental',
                'slug' => 'cosmetic-dental',
                'short_description' => 'Cosmetic treatment is focused on improving the appearance of the teeth, gums, and smile.',
                'image_link' => 'dental/cosmetic-dental.jpg',
                'meta_title' => 'Cosmetic Dental Treatment in Shastri Nagar, Ghaziabad',
                'meta_description' => 'Improve the appearance of your smile with cosmetic dental treatment such as whitening and veneers at MediDENT in Shastri Nagar, Ghaziabad.',
                'meta_keyword' => 'cosmetic dentist Ghaziabad, teeth whitening Shastri Nagar, dental veneers, smile design Ghaziabad',
                'content' => <<<'HTML'
<h2>A smile that looks natural and feels healthy</h2>

<p>Cosmetic dentistry focuses on the appearance of your teeth, gums and smile. Treatment may address staining, small chips, gaps, uneven edges or teeth that feel out of proportion.</p>

<p>Good cosmetic care begins with healthy teeth and gums. Dr. Ratika Gupta assesses your dental health first, then discusses options that suit your face, bite and expectations.</p>

<h3>Cosmetic treatments may include</h3>

<ul>
    <li>Professional teeth whitening</li>
    <li>Veneers for shape, colour or minor alignment concerns</li>
    <li>Smile planning around your facial features</li>
    <li>Repair of small chips or uneven edges</li>
    <li>Guidance on maintaining results at home</li>
</ul>

<h3>What to expect</h3>

<p>Your consultation includes an examination, photographs where useful, and a discussion of realistic outcomes. Some treatments can be completed in one visit, while others need more planning or multiple appointments. You will receive clear information about benefits, limits and aftercare.</p>

<p>Book a cosmetic consultation if you would like to understand what is achievable for your smile.</p>
HTML,
            ],
            [
                'category' => 'dental',
                'title' => 'Kids Dentistry',
                'slug' => 'kids-dentistry',
                'short_description' => 'Kids dentistry, also known as pediatric dentistry, focuses on the oral health of infants, children, and teenagers.',
                'image_link' => 'dental/KIDSDENTISTRY.jpg',
                'meta_title' => 'Kids Dentist in Shastri Nagar, Ghaziabad',
                'meta_description' => 'Gentle dental care for children at MediDENT Multicare Clinic in Shastri Nagar, Ghaziabad. Book a pediatric dental visit with Dr. Ratika Gupta.',
                'meta_keyword' => 'kids dentist Ghaziabad, pediatric dentist Shastri Nagar, child dental care, first dental visit',
                'content' => <<<'HTML'
<h2>Gentle dental care for children and teenagers</h2>

<p>Children need dental care that matches their stage of growth. A positive first visit can help them feel comfortable with dentists and build habits that last into adulthood.</p>

<p>Dr. Ratika Gupta provides pediatric and preventive dental care in a calm, patient manner, with explanations suited to the child and reassurance for parents.</p>

<h3>Kids dentistry can help with</h3>

<ul>
    <li>First dental visits and parent guidance</li>
    <li>Routine check-ups and cleaning</li>
    <li>Cavity prevention and fluoride advice</li>
    <li>Habits such as thumb sucking or mouth breathing</li>
    <li>Dental care for children with special needs</li>
</ul>

<h3>What to expect</h3>

<p>The visit starts with a friendly conversation and a gentle examination. Treatment is explained to both the child and parent, and preventive advice is given for brushing, diet and regular reviews. If a child is anxious, the appointment is paced to help them feel safe.</p>

<p>Bring your child for a first visit by their first birthday or when the first tooth appears, unless a concern arises sooner.</p>
HTML,
            ],
            [
                'category' => 'dental',
                'title' => 'Dental Implants',
                'slug' => 'dental-implants',
                'short_description' => 'A dental implant is a prosthetic device used to replace missing teeth, typically made of titanium and placed into the jawbone.',
                'image_link' => 'dental/Dental-Implants.jpg',
                'meta_title' => 'Dental Implants in Shastri Nagar, Ghaziabad',
                'meta_description' => 'Replace missing teeth with dental implants at MediDENT Multicare Clinic in Shastri Nagar, Ghaziabad. Book an implant assessment with Dr. Ratika Gupta.',
                'meta_keyword' => 'dental implants Ghaziabad, tooth replacement Shastri Nagar, implant dentist, missing teeth treatment',
                'content' => <<<'HTML'
<h2>A long-term option for missing teeth</h2>

<p>Missing teeth can affect chewing, speech, confidence and the health of the surrounding jaw. A dental implant is a titanium fixture placed in the jawbone to support a replacement tooth or bridge.</p>

<p>Not everyone is suitable for implants straight away. Bone volume, gum health, medical history and oral habits all need to be assessed before a plan is made.</p>

<h3>Dental implants may help with</h3>

<ul>
    <li>Replacing a single missing tooth</li>
    <li>Supporting a bridge without preparing neighbouring teeth</li>
    <li>Restoring chewing function</li>
    <li>Preserving jawbone around a missing tooth</li>
    <li>Improving confidence when smiling or speaking</li>
</ul>

<h3>What to expect</h3>

<p>Your assessment includes a dental examination, imaging where required, and a discussion of alternatives. If an implant is suitable, the treatment is planned in stages and you will receive aftercare instructions. Regular reviews help protect the long-term result.</p>

<p>Book an implant consultation to find out whether this option is right for you.</p>
HTML,
            ],
            [
                'category' => 'dental',
                'title' => 'Painless Extraction',
                'slug' => 'painless-extraction',
                'short_description' => 'Tooth extraction is performed with care and modern techniques to keep you comfortable when a tooth cannot be saved.',
                'image_link' => 'dental/painless-extraction.jpg',
                'meta_title' => 'Painless Tooth Extraction in Shastri Nagar, Ghaziabad',
                'meta_description' => 'Book gentle tooth extraction at MediDENT Multicare Clinic in Shastri Nagar, Ghaziabad. Modern techniques help keep the procedure comfortable.',
                'meta_keyword' => 'painless tooth extraction Ghaziabad, tooth removal Shastri Nagar, wisdom tooth extraction, gentle dentist',
                'content' => <<<'HTML'
<h2>Comfort-focused tooth removal</h2>

<p>Tooth extraction may be needed when a tooth is severely decayed, infected, crowded or damaged beyond repair. The aim is to remove the tooth safely while protecting the surrounding gums and bone.</p>

<p>Modern techniques and local anaesthesia help keep the procedure as comfortable as possible. Dr. Ratika Gupta explains why extraction is recommended and what alternatives may exist.</p>

<h3>Reasons an extraction may be advised</h3>

<ul>
    <li>A tooth that cannot be saved by other treatment</li>
    <li>Severe infection or ongoing pain</li>
    <li>Advanced decay or fracture below the gumline</li>
    <li>Crowding before orthodontic treatment</li>
    <li>A problematic wisdom tooth</li>
</ul>

<h3>What to expect</h3>

<p>The area is numbed before treatment begins, and the tooth is removed with controlled technique. You will receive clear aftercare instructions for bleeding, eating, brushing and pain relief, along with warning signs that need follow-up.</p>

<p>Tell the dentist about blood thinners, diabetes, pregnancy or other health conditions before the procedure.</p>
HTML,
            ],
            [
                'category' => 'dental',
                'title' => 'Dental Filling',
                'slug' => 'dental-filling',
                'short_description' => 'Dental fillings are restorative materials used to repair teeth that have been damaged by decay or trauma.',
                'image_link' => 'dental/dental-filling.jpg',
                'meta_title' => 'Dental Filling Treatment in Shastri Nagar, Ghaziabad',
                'meta_description' => 'Repair cavities and damaged teeth with tooth-coloured dental fillings at MediDENT Multicare Clinic in Shastri Nagar, Ghaziabad.',
                'meta_keyword' => 'dental filling Ghaziabad, cavity treatment Shastri Nagar, tooth filling dentist, restorative dentistry',
                'content' => <<<'HTML'
<h2>Restore a tooth affected by decay or damage</h2>

<p>Dental fillings repair areas of a tooth that have been damaged by decay, wear or minor trauma. Treating a cavity early helps prevent pain, infection and the need for more extensive treatment later.</p>

<p>Tooth-coloured fillings are shaped and finished to restore function while blending with the natural tooth. Dr. Ratika Gupta checks the bite and surrounding teeth as part of the treatment.</p>

<h3>Signs you may need a filling</h3>

<ul>
    <li>Sensitivity to sweet, hot or cold food</li>
    <li>A visible dark spot or hole in a tooth</li>
    <li>Food getting caught between teeth</li>
    <li>Mild pain when biting</li>
    <li>A chipped or worn tooth edge</li>
</ul>

<h3>What to expect</h3>

<p>The tooth is examined, and the damaged area is removed under local anaesthesia if needed. The filling is then placed, shaped and polished. You can usually eat once the numbness has worn off, and you will receive advice on caring for the restored tooth.</p>

<p>Regular check-ups help catch new cavities while they are still small.</p>
HTML,
            ],
            [
                'category' => 'dental',
                'title' => 'Root Canal Treatment',
                'slug' => 'root-canal-treatment',
                'short_description' => 'Root canal treatment (RCT) is a dental procedure used to treat a tooth that is infected or severely decayed.',
                'image_link' => 'dental/root-canal.jpg',
                'meta_title' => 'Root Canal Treatment in Shastri Nagar, Ghaziabad',
                'meta_description' => 'Relieve tooth pain and save an infected tooth with root canal treatment at MediDENT Multicare Clinic in Shastri Nagar, Ghaziabad.',
                'meta_keyword' => 'root canal treatment Ghaziabad, RCT dentist Shastri Nagar, infected tooth pain, endodontic treatment',
                'content' => <<<'HTML'
<h2>Save an infected tooth and relieve pain</h2>

<p>Root canal treatment is used when the inner tissue of a tooth becomes infected or badly inflamed. Without treatment, the infection can spread, cause swelling and lead to tooth loss.</p>

<p>The procedure removes the damaged tissue, cleans the canal system and seals the tooth. The aim is to relieve pain and preserve your natural tooth whenever possible.</p>

<h3>Signs that root canal treatment may be needed</h3>

<ul>
    <li>Severe or lingering tooth pain</li>
    <li>Pain when biting or pressing on a tooth</li>
    <li>Swelling or a recurring gum boil</li>
    <li>Increased sensitivity to hot or cold</li>
    <li>A deep cavity or history of dental trauma</li>
</ul>

<h3>What to expect</h3>

<p>Dr. Ratika Gupta examines the tooth and may take an X-ray to understand the extent of the problem. Treatment is performed under local anaesthesia, often over one or more visits. A filling or crown may be needed afterwards to protect the tooth.</p>

<p>Seek prompt care for severe dental pain or facial swelling, especially with fever or difficulty swallowing.</p>
HTML,
            ],
        ];

        foreach ($services as $service) {
            $category = $categories->get($service['category']);

            if (! $category) {
                continue;
            }

            Service::updateOrCreate(
                ['slug' => $service['slug']],
                [
                    'service_category_id' => $category->id,
                    'title' => $service['title'],
                    'short_description' => $service['short_description'],
                    'content' => $service['content'],
                    'image_link' => $service['image_link'],
                    'meta_title' => $service['meta_title'],
                    'meta_description' => $service['meta_description'],
                    'meta_keyword' => $service['meta_keyword'],
                    'is_active' => true,
                ],
            );
        }
    }
}
