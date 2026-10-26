<div>
    <div class="overflow-hidden">


{{-- HERO SECTION --}}
<section class="relative overflow-hidden bg-[#f5fafc]">

    <div class="mx-auto grid max-w-7xl items-center gap-10 px-5 py-14 sm:px-6 sm:py-20 lg:grid-cols-[1.05fr_.95fr] lg:gap-16 lg:px-8 lg:py-24">

        {{-- Hero Content --}}
        <div>
            <div class="inline-flex items-center gap-2 border border-sky-100 bg-white px-3 py-2 text-xs font-semibold uppercase tracking-[0.16em] text-med-blue">
                <i class="ri-hospital-line text-base"></i>
                MediDENT Multicare Clinic · Ghaziabad
            </div>

            <h1 class="mt-6 max-w-2xl text-4xl font-bold leading-[1.15] tracking-tight text-med-navy sm:text-5xl lg:text-[3.5rem]">
                Welcome to
                <span class="text-med-blue">MediDENT Multicare Clinic</span>
                Ghaziabad
            </h1>

            <p class="mt-6 max-w-xl text-base leading-8 text-slate-600">
                MediDENT Multicare Clinic provides medical, diabetes and dental care for patients of all ages. Our healthcare team works to deliver comprehensive services tailored to your individual needs.
            </p>

            <p class="mt-4 max-w-xl text-sm leading-7 text-slate-500 sm:text-base sm:leading-8">
                From general health check-ups and common illnesses to chronic condition management, vaccinations and preventive screenings, we offer a range of services to support your health and wellbeing.
            </p>

            {{-- Buttons --}}
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="#contact"
                   class="inline-flex items-center gap-3 bg-med-blue px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-sky-800">
                    Book an Appointment
                    <i class="ri-arrow-right-up-line text-lg"></i>
                </a>

                <a href="#about"
                   class="inline-flex items-center gap-2 border border-slate-300 bg-white px-6 py-3.5 text-sm font-semibold text-med-navy transition hover:border-med-blue hover:text-med-blue">
                    About Our Clinic
                    <i class="ri-arrow-right-line"></i>
                </a>
            </div>

            {{-- Service Highlights --}}
            <div class="mt-9 grid grid-cols-2 gap-4 border-t border-slate-200 pt-6 sm:gap-6">

                <div class="flex items-start gap-3">
                    <div class="grid h-10 w-10 shrink-0 place-items-center bg-white text-xl text-med-blue">
                        <i class="ri-stethoscope-line"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-med-navy">Medical Care</p>
                        <p class="mt-1 text-xs leading-5 text-slate-500">
                            General health and consultations
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <div class="grid h-10 w-10 shrink-0 place-items-center bg-white text-xl text-med-red">
                        <i class="ri-heart-pulse-line"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-med-navy">Diabetes Care</p>
                        <p class="mt-1 text-xs leading-5 text-slate-500">
                            Monitoring and ongoing support
                        </p>
                    </div>
                </div>

            </div>
        </div>

        {{-- Hero Image --}}
        <div class="relative">
            <div class="absolute -right-3 -top-3 h-24 w-24 border border-sky-200 sm:-right-5 sm:-top-5 sm:h-32 sm:w-32"></div>

            <div class="relative border-[5px] border-white bg-white shadow-[0_20px_60px_rgba(18,50,74,0.12)]">
                <img
                    src="{{ asset('images/hero-img.jpg') }}"
                    alt="MediDENT Multicare Clinic"
                    fetchpriority="high"
                    class="h-[300px] w-full object-cover sm:h-[400px] lg:h-[470px]"
                >
            </div>

        
        </div>

    </div>
</section>


{{-- GENERAL PHYSICIAN CONSULTATION --}}
<section id="consultation"
    class="scroll-mt-24 border-y border-slate-100 bg-white py-16 sm:py-20 lg:py-24">

    <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

        {{-- Section heading --}}
        <div class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between">

            <div class="max-w-2xl">
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-red">
                    General Healthcare
                </p>

                <h2 class="mt-3 text-3xl font-bold leading-tight tracking-tight text-med-navy sm:text-4xl">
                    General Physician Consultation
                </h2>

                <p class="mt-4 max-w-xl text-sm leading-7 text-slate-500 sm:text-base">
                    Expert medical guidance for common illnesses, ongoing health concerns, preventive care and your family's wellbeing.
                </p>
            </div>

            <a href="#contact"
                class="inline-flex w-fit shrink-0 items-center gap-2 border-b border-med-blue pb-1 text-sm font-semibold text-med-blue transition hover:text-sky-800">
                Book a Consultation
                <i class="ri-arrow-right-line"></i>
            </a>

        </div>

        {{-- Service cards --}}
        <div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">

            {{-- General Disease --}}
            <article class="group flex h-full flex-col overflow-hidden border border-slate-200 bg-white transition duration-300 hover:-translate-y-1 hover:border-sky-200 hover:shadow-[0_16px_40px_rgba(18,50,74,0.08)]">

                <div class="relative h-52 overflow-hidden bg-slate-100">
                    <img
                        src="{{ asset('images/general-diseases.jpg') }}"
                        alt="General physician consultation"
                        loading="lazy"
                        class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                    >

                    <span class="absolute left-4 top-4 bg-white px-3 py-1.5 text-xs font-semibold text-med-blue shadow-sm">
                        General Medicine
                    </span>
                </div>

                <div class="flex flex-1 flex-col p-6 sm:p-7">
                    <div class="flex items-start justify-between gap-3">
                        <h3 class="text-xl font-bold text-med-navy">
                            General Diseases
                        </h3>

                        <i class="ri-stethoscope-line text-2xl text-med-blue"></i>
                    </div>

                    <p class="mt-3 flex-1 text-sm leading-7 text-slate-600">
                        Consultation for common illnesses, fever, infections and other everyday health concerns, with guidance on appropriate treatment and prevention.
                    </p>

                    <a href="#contact"
                        class="mt-6 inline-flex items-center gap-2 border-t border-slate-100 pt-4 text-sm font-semibold text-med-blue">
                        View Details
                        <i class="ri-arrow-right-line transition group-hover:translate-x-1"></i>
                    </a>
                </div>
            </article>

            {{-- Gastrointestinal Diseases --}}
            <article class="group flex h-full flex-col overflow-hidden border border-slate-200 bg-white transition duration-300 hover:-translate-y-1 hover:border-emerald-200 hover:shadow-[0_16px_40px_rgba(18,50,74,0.08)]">

                <div class="relative h-52 overflow-hidden bg-slate-100">
                    <img
                        src="{{ asset('images/gastro.jpg') }}"
                        alt="Digestive health consultation"
                        loading="lazy"
                        class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                    >

                    <span class="absolute left-4 top-4 bg-white px-3 py-1.5 text-xs font-semibold text-emerald-700 shadow-sm">
                        Digestive Health
                    </span>
                </div>

                <div class="flex flex-1 flex-col p-6 sm:p-7">
                    <div class="flex items-start justify-between gap-3">
                        <h3 class="text-xl font-bold text-med-navy">
                            Gastrointestinal Diseases
                        </h3>

                        <i class="ri-capsule-line text-2xl text-emerald-600"></i>
                    </div>

                    <p class="mt-3 flex-1 text-sm leading-7 text-slate-600">
                        Medical evaluation for digestive concerns such as acidity, indigestion, abdominal discomfort and changes in bowel habits.
                    </p>

                    <a href="#contact"
                        class="mt-6 inline-flex items-center gap-2 border-t border-slate-100 pt-4 text-sm font-semibold text-emerald-700">
                        View Details
                        <i class="ri-arrow-right-line transition group-hover:translate-x-1"></i>
                    </a>
                </div>
            </article>

            {{-- Heart Disease --}}
            <article class="group flex h-full flex-col overflow-hidden border border-slate-200 bg-white transition duration-300 hover:-translate-y-1 hover:border-red-200 hover:shadow-[0_16px_40px_rgba(18,50,74,0.08)]">

                <div class="relative h-52 overflow-hidden bg-slate-100">
                    <img
                        src="{{ asset('images/heart.jpg') }}"
                        alt="Heart health consultation"
                        loading="lazy"
                        class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                    >

                    <span class="absolute left-4 top-4 bg-white px-3 py-1.5 text-xs font-semibold text-med-red shadow-sm">
                        Heart Health
                    </span>
                </div>

                <div class="flex flex-1 flex-col p-6 sm:p-7">
                    <div class="flex items-start justify-between gap-3">
                        <h3 class="text-xl font-bold text-med-navy">
                            Heart Disease
                        </h3>

                        <i class="ri-heart-pulse-line text-2xl text-med-red"></i>
                    </div>

                    <p class="mt-3 flex-1 text-sm leading-7 text-slate-600">
                        Assessment of cardiovascular risk factors, blood pressure concerns and symptoms that may require further heart health evaluation.
                    </p>

                    <a href="#contact"
                        class="mt-6 inline-flex items-center gap-2 border-t border-slate-100 pt-4 text-sm font-semibold text-med-red">
                        View Details
                        <i class="ri-arrow-right-line transition group-hover:translate-x-1"></i>
                    </a>
                </div>
            </article>

            {{-- Thyroid --}}
            <article class="group flex h-full flex-col overflow-hidden border border-slate-200 bg-white transition duration-300 hover:-translate-y-1 hover:border-violet-200 hover:shadow-[0_16px_40px_rgba(18,50,74,0.08)]">

                <div class="relative h-52 overflow-hidden bg-slate-100">
                    <img
                        src="{{ asset('images/throid.jpg') }}"
                        alt="Thyroid health consultation"
                        loading="lazy"
                        class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                    >

                    <span class="absolute left-4 top-4 bg-white px-3 py-1.5 text-xs font-semibold text-violet-700 shadow-sm">
                        Hormonal Health
                    </span>
                </div>

                <div class="flex flex-1 flex-col p-6 sm:p-7">
                    <div class="flex items-start justify-between gap-3">
                        <h3 class="text-xl font-bold text-med-navy">
                            Thyroid Disorders
                        </h3>

                        <i class="ri-pulse-line text-2xl text-violet-600"></i>
                    </div>

                    <p class="mt-3 flex-1 text-sm leading-7 text-slate-600">
                        Evaluation and management of thyroid-related concerns, including hormone imbalances that can affect energy, metabolism and overall wellbeing.
                    </p>

                    <a href="#contact"
                        class="mt-6 inline-flex items-center gap-2 border-t border-slate-100 pt-4 text-sm font-semibold text-violet-700">
                        View Details
                        <i class="ri-arrow-right-line transition group-hover:translate-x-1"></i>
                    </a>
                </div>
            </article>

            {{-- Respiratory Disease --}}
            <article class="group flex h-full flex-col overflow-hidden border border-slate-200 bg-white transition duration-300 hover:-translate-y-1 hover:border-cyan-200 hover:shadow-[0_16px_40px_rgba(18,50,74,0.08)]">

                <div class="relative h-52 overflow-hidden bg-slate-100">
                    <img
                        src="{{ asset('images/respiratory.jpg') }}"
                        alt="Respiratory health consultation"
                        loading="lazy"
                        class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                    >

                    <span class="absolute left-4 top-4 bg-white px-3 py-1.5 text-xs font-semibold text-cyan-700 shadow-sm">
                        Respiratory Health
                    </span>
                </div>

                <div class="flex flex-1 flex-col p-6 sm:p-7">
                    <div class="flex items-start justify-between gap-3">
                        <h3 class="text-xl font-bold text-med-navy">
                            Respiratory Diseases
                        </h3>

                        <i class="ri-lungs-line text-2xl text-cyan-700"></i>
                    </div>

                    <p class="mt-3 flex-1 text-sm leading-7 text-slate-600">
                        Consultation for breathing difficulties, persistent cough, asthma-related concerns and other respiratory symptoms.
                    </p>

                    <a href="#contact"
                        class="mt-6 inline-flex items-center gap-2 border-t border-slate-100 pt-4 text-sm font-semibold text-cyan-700">
                        View Details
                        <i class="ri-arrow-right-line transition group-hover:translate-x-1"></i>
                    </a>
                </div>
            </article>

            {{-- Vaccination --}}
            <article class="group flex h-full flex-col overflow-hidden border border-slate-200 bg-white transition duration-300 hover:-translate-y-1 hover:border-amber-200 hover:shadow-[0_16px_40px_rgba(18,50,74,0.08)]">

                <div class="relative h-52 overflow-hidden bg-slate-100">
                    <img
                        src="{{ asset('images/vaccination.jpg') }}"
                        alt="Vaccination and preventive healthcare"
                        loading="lazy"
                        class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                    >

                    <span class="absolute left-4 top-4 bg-white px-3 py-1.5 text-xs font-semibold text-amber-700 shadow-sm">
                        Preventive Care
                    </span>
                </div>

                <div class="flex flex-1 flex-col p-6 sm:p-7">
                    <div class="flex items-start justify-between gap-3">
                        <h3 class="text-xl font-bold text-med-navy">
                            Vaccination
                        </h3>

                        <i class="ri-syringe-line text-2xl text-amber-600"></i>
                    </div>

                    <p class="mt-3 flex-1 text-sm leading-7 text-slate-600">
                        Preventive vaccination services and guidance on recommended immunisation schedules for eligible children and adults.
                    </p>

                    <a href="#contact"
                        class="mt-6 inline-flex items-center gap-2 border-t border-slate-100 pt-4 text-sm font-semibold text-amber-700">
                        View Details
                        <i class="ri-arrow-right-line transition group-hover:translate-x-1"></i>
                    </a>
                </div>
            </article>

        </div>

        {{-- Bottom CTA --}}
        <div class="mt-10 flex flex-col gap-4 border border-slate-200 bg-[#f8fbfd] p-6 sm:flex-row sm:items-center sm:justify-between sm:p-8">
            <div>
                <h3 class="text-lg font-bold text-med-navy">
                    Need help choosing the right consultation?
                </h3>

                <p class="mt-2 text-sm leading-6 text-slate-500">
                    Contact our clinic to discuss your concerns and available services.
                </p>
            </div>

            <a href="#contact"
                class="inline-flex shrink-0 items-center justify-center gap-2 bg-med-blue px-5 py-3 text-sm font-semibold text-white transition hover:bg-sky-800">
                Contact the Clinic
                <i class="ri-arrow-right-up-line"></i>
            </a>
        </div>

    </div>
</section>



    {{-- SERVICES --}}
    <section id="services" class="scroll-mt-24 py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

            <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                <div class="max-w-2xl">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-red">
                        Our Healthcare Services
                    </p>

                    <h2 class="mt-3 text-3xl font-bold tracking-tight text-med-navy sm:text-4xl">
                        Complete care. One trusted clinic.
                    </h2>

                    <p class="mt-4 max-w-xl leading-7 text-slate-600">
                        Focused care for your everyday health, long-term wellbeing and confident smile.
                    </p>
                </div>

                <a href="#contact"
                    class="inline-flex w-fit items-center gap-2 border-b border-med-blue pb-1 text-sm font-semibold text-med-blue hover:text-sky-800">
                    Book a Consultation <i class="ri-arrow-right-line"></i>
                </a>
            </div>

            <div class="mt-10 grid gap-5 md:grid-cols-3">

                {{-- Medical --}}
                <article class="group border border-slate-200 bg-white p-7 transition hover:border-sky-200 hover:shadow-[0_15px_40px_rgba(18,50,74,0.07)] sm:p-8">
                    <div class="flex items-center justify-between">
                        <div class="grid h-14 w-14 place-items-center bg-sky-50 text-2xl text-med-blue">
                            <i class="ri-stethoscope-line"></i>
                        </div>

                        <span class="text-2xl text-slate-300 transition group-hover:text-med-blue">
                            <i class="ri-arrow-up-right-line"></i>
                        </span>
                    </div>

                    <h3 class="mt-7 text-xl font-bold text-med-navy">Medical Care</h3>

                    <p class="mt-3 text-sm leading-7 text-slate-600">
                        Medical consultations and guidance for everyday health concerns and your family's general healthcare needs.
                    </p>

                    <a href="#contact"
                        class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-med-blue">
                        Learn More <i class="ri-arrow-right-line transition group-hover:translate-x-1"></i>
                    </a>
                </article>

                {{-- Diabetes --}}
                <article class="group border border-slate-200 bg-white p-7 transition hover:border-red-200 hover:shadow-[0_15px_40px_rgba(18,50,74,0.07)] sm:p-8">
                    <div class="flex items-center justify-between">
                        <div class="grid h-14 w-14 place-items-center bg-red-50 text-2xl text-med-red">
                            <i class="ri-heart-pulse-line"></i>
                        </div>

                        <span class="text-2xl text-slate-300 transition group-hover:text-med-red">
                            <i class="ri-arrow-up-right-line"></i>
                        </span>
                    </div>

                    <h3 class="mt-7 text-xl font-bold text-med-navy">Diabetes Care</h3>

                    <p class="mt-3 text-sm leading-7 text-slate-600">
                        Support with diabetes monitoring, ongoing management and guidance to help you care for your health.
                    </p>

                    <a href="#contact"
                        class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-med-red">
                        Learn More <i class="ri-arrow-right-line transition group-hover:translate-x-1"></i>
                    </a>
                </article>

                {{-- Dental --}}
                <article class="group border border-slate-200 bg-white p-7 transition hover:border-cyan-200 hover:shadow-[0_15px_40px_rgba(18,50,74,0.07)] sm:p-8">
                    <div class="flex items-center justify-between">
                        <div class="grid h-14 w-14 place-items-center bg-cyan-50 text-2xl text-cyan-700">
                            <i class="ri-tooth-line"></i>
                        </div>

                        <span class="text-2xl text-slate-300 transition group-hover:text-cyan-700">
                            <i class="ri-arrow-up-right-line"></i>
                        </span>
                    </div>

                    <h3 class="mt-7 text-xl font-bold text-med-navy">Dental Care</h3>

                    <p class="mt-3 text-sm leading-7 text-slate-600">
                        Oral health consultations, preventive dental care and treatment options to help maintain a healthy smile.
                    </p>

                    <a href="#contact"
                        class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-cyan-700">
                        Learn More <i class="ri-arrow-right-line transition group-hover:translate-x-1"></i>
                    </a>
                </article>

            </div>
        </div>
    </section>


    {{-- ABOUT --}}
    <section id="about" class="scroll-mt-24 border-y border-slate-100 bg-[#f5fafc] py-16 sm:py-20 lg:py-24">
        <div class="mx-auto grid max-w-7xl items-center gap-12 px-5 sm:px-6 lg:grid-cols-2 lg:gap-16 lg:px-8">

            <div class="relative">
                <img
                    src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=1100&q=85"
                    alt="Healthcare professional consulting a patient"
                    loading="lazy"
                    class="h-[330px] w-full object-cover sm:h-[430px]">

              
            </div>

            <div class="pt-3 lg:pt-0">
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-red">
                    About MediDENT
                </p>

                <h2 class="mt-4 text-3xl font-bold leading-tight tracking-tight text-med-navy sm:text-4xl">
                    Healthcare should feel personal, not complicated.
                </h2>

                <p class="mt-5 text-base leading-8 text-slate-600">
                    We believe better healthcare begins with listening. Our approach focuses on understanding your concerns, explaining your options clearly and helping you make informed decisions about your wellbeing.
                </p>

                <div class="mt-7 space-y-5">

                    <div class="flex gap-4">
                        <i class="ri-check-line mt-0.5 text-xl text-med-blue"></i>
                        <div>
                            <h3 class="font-semibold text-med-navy">A patient-first approach</h3>
                            <p class="mt-1 text-sm leading-6 text-slate-600">
                                Your questions and concerns deserve time, respect and attention.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <i class="ri-check-line mt-0.5 text-xl text-med-blue"></i>
                        <div>
                            <h3 class="font-semibold text-med-navy">Multiple care services</h3>
                            <p class="mt-1 text-sm leading-6 text-slate-600">
                                Medical, diabetes and dental services in one convenient place.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <i class="ri-check-line mt-0.5 text-xl text-med-blue"></i>
                        <div>
                            <h3 class="font-semibold text-med-navy">Clear, thoughtful guidance</h3>
                            <p class="mt-1 text-sm leading-6 text-slate-600">
                                Understand your care options and the next steps to consider.
                            </p>
                        </div>
                    </div>

                </div>

                <a href="#contact"
                    class="mt-8 inline-flex items-center gap-3 bg-med-navy px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-slate-800">
                    Get in Touch <i class="ri-arrow-right-up-line text-lg"></i>
                </a>
            </div>
        </div>
    </section>


    {{-- TESTIMONIALS --}}
    <section
        id="testimonials"
        x-data="{
            active: 0,
            reviews: [
                {
                    quote: 'The team took time to explain everything clearly, and I felt that my concerns were heard.',
                    name: 'Patient Review',
                    service: 'Medical consultation'
                },
                {
                    quote: 'The staff were welcoming and made the visit feel comfortable. The information was easy to understand.',
                    name: 'Patient Review',
                    service: 'Clinic experience'
                },
                {
                    quote: 'I appreciated the friendly communication and the attention given to my questions.',
                    name: 'Patient Review',
                    service: 'Family healthcare'
                }
            ]
        }"
        class="scroll-mt-24 py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

            <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
                <div class="max-w-2xl">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-red">
                        Patient Experiences
                    </p>

                    <h2 class="mt-3 text-3xl font-bold tracking-tight text-med-navy sm:text-4xl">
                        Care that makes a difference.
                    </h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        Every patient deserves to feel heard, respected and supported throughout their care.
                    </p>
                </div>

                <div class="flex gap-2">
                    <button
                        type="button"
                        @click="active = (active - 1 + reviews.length) % reviews.length"
                        aria-label="Previous review"
                        class="grid h-11 w-11 place-items-center border border-slate-300 text-xl text-med-navy transition hover:border-med-blue hover:text-med-blue">
                        <i class="ri-arrow-left-line"></i>
                    </button>

                    <button
                        type="button"
                        @click="active = (active + 1) % reviews.length"
                        aria-label="Next review"
                        class="grid h-11 w-11 place-items-center bg-med-blue text-xl text-white transition hover:bg-sky-800">
                        <i class="ri-arrow-right-line"></i>
                    </button>
                </div>
            </div>

            <div class="mt-9 grid gap-5 md:grid-cols-3">

                <template x-for="(review, index) in reviews" :key="index">
                    <article
                        @click="active = index"
                        class="cursor-pointer border p-6 transition sm:p-7"
                        :class="active === index
                            ? 'border-sky-200 bg-[#f5fafc] shadow-md'
                            : 'border-slate-200 bg-white hover:border-slate-300'">
                        <div class="flex items-center gap-1 text-amber-500" aria-label="Sample five-star rating">
                            <template x-for="star in 5" :key="star">
                                <i class="ri-star-fill"></i>
                            </template>
                        </div>

                        <i class="ri-double-quotes-l mt-6 block text-3xl text-med-blue"></i>

                        <p class="mt-2 min-h-24 text-sm leading-7 text-slate-600" x-text="review.quote"></p>

                        <div class="mt-6 border-t border-slate-200 pt-5">
                            <p class="text-sm font-bold text-med-navy" x-text="review.name"></p>
                            <p class="mt-1 text-xs text-slate-500" x-text="review.service"></p>
                        </div>
                    </article>
                </template>

            </div>

            <p class="mt-4 text-xs text-slate-400">
                Replace sample reviews with genuine patient feedback before publishing.
            </p>
        </div>
    </section>

</div>
</div>