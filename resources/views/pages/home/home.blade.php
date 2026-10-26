<div>
    <div class="overflow-hidden">

    {{-- HERO --}}
    <section class="relative bg-[#f5fafc]">
        <div class="mx-auto grid max-w-7xl items-center gap-12 px-5 py-16 sm:px-6 sm:py-20 lg:grid-cols-2 lg:gap-16 lg:px-8 lg:py-24">

            <div>
                <div class="inline-flex items-center gap-2 border border-sky-100 bg-white px-3 py-2 text-xs font-semibold uppercase tracking-[0.16em] text-med-blue">
                    <i class="ri-heart-pulse-line text-base"></i>
                    Your health, our priority
                </div>

                <h1 class="mt-7 max-w-2xl text-4xl font-bold leading-[1.13] tracking-tight text-med-navy sm:text-5xl lg:text-[3.8rem]">
                    Better health begins with
                    <span class="text-med-blue">better care.</span>
                </h1>

                <p class="mt-6 max-w-xl text-base leading-8 text-slate-600 sm:text-lg">
                    Complete medical, diabetes and dental care for your family, delivered with compassion, attention and a personal touch.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="#contact"
                        class="inline-flex items-center gap-3 bg-med-blue px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-sky-800">
                        Book an Appointment
                        <i class="ri-arrow-right-up-line text-lg"></i>
                    </a>

                    <a href="#services"
                        class="inline-flex items-center gap-2 border border-slate-300 bg-white px-6 py-3.5 text-sm font-semibold text-med-navy transition hover:border-med-blue hover:text-med-blue">
                        Explore Services
                        <i class="ri-arrow-right-line"></i>
                    </a>
                </div>

                <div class="mt-9 flex flex-wrap gap-x-6 gap-y-3 border-t border-slate-200 pt-6 text-sm text-slate-600">
                    <span class="flex items-center gap-2">
                        <i class="ri-checkbox-circle-fill text-lg text-emerald-600"></i>
                        Family-focused care
                    </span>

                    <span class="flex items-center gap-2">
                        <i class="ri-checkbox-circle-fill text-lg text-emerald-600"></i>
                        Multiple care services
                    </span>
                </div>
            </div>

            {{-- Hero image --}}
            <div class="relative">
                <div class="absolute -right-4 -top-4 h-32 w-32 border border-sky-200"></div>

                <div class="relative overflow-hidden border-[6px] border-white shadow-[0_25px_70px_rgba(18,50,74,0.13)]">
                    <img
                        src="https://images.unsplash.com/photo-1629909613654-28e377c37b09?auto=format&fit=crop&w=1200&q=85"
                        alt="Modern healthcare clinic interior"
                        fetchpriority="high"
                        class="h-[340px] w-full object-cover sm:h-[430px] lg:h-[490px]">

                    <div class="absolute inset-0 bg-gradient-to-t from-med-navy/50 via-transparent to-transparent"></div>

                    <div class="absolute bottom-0 left-0 right-0 p-5 sm:p-7">
                        <div class="flex items-center gap-4 border border-white/30 bg-white/95 p-4 sm:p-5">
                            <div class="grid h-12 w-12 shrink-0 place-items-center bg-sky-50 text-2xl text-med-blue">
                                <i class="ri-shield-check-line"></i>
                            </div>

                            <div>
                                <h2 class="font-bold text-med-navy">Care that puts you first</h2>
                                <p class="mt-1 text-sm text-slate-500">
                                    Personal attention at every visit
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="absolute -left-4 top-10 hidden items-center gap-3 border border-slate-100 bg-white p-4 shadow-lg sm:flex lg:-left-8">
                    <i class="ri-heart-pulse-line text-2xl text-med-red"></i>
                    <div>
                        <p class="text-sm font-bold text-med-navy">Compassion first</p>
                        <p class="mt-1 text-xs text-slate-500">Care for every family</p>
                    </div>
                </div>
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

                <div class="absolute -bottom-5 right-0 border border-slate-100 bg-white p-5 shadow-lg sm:right-5">
                    <p class="text-sm font-bold text-med-navy">
                        Medical · Diabetes · Dental
                    </p>
                    <p class="mt-1 text-xs text-slate-500">
                        Healthcare for your family
                    </p>
                </div>
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