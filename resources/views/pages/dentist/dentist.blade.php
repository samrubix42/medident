<div>
    @php
        $settings = $this->settings;
        $services = $this->services;
        $faqs = $this->faqs;
    @endphp

    {{-- HERO SECTION --}}
    <section class="relative overflow-hidden bg-[#FAFDFE] py-10 sm:py-16 lg:py-20">
        <div class="relative mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-xs font-medium text-slate-400" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="transition hover:text-med-blue">Home</a>
                <i class="ri-arrow-right-s-line text-sm text-slate-300"></i>
                <a href="{{ route('about') }}" class="transition hover:text-med-blue">About Us</a>
                <i class="ri-arrow-right-s-line text-sm text-slate-300"></i>
                <span class="text-cyan-700">Dr. Ratika Gupta</span>
            </nav>

            <div class="mt-8 grid items-center gap-10 lg:grid-cols-[minmax(0,1fr)_minmax(360px,.85fr)] lg:gap-14">
                <div>
                    <div class="inline-flex items-center gap-2 rounded-full border border-cyan-100 bg-white px-3.5 py-1.5 text-xs font-bold uppercase tracking-wider text-cyan-700 shadow-sm">
                        <i class="ri-tooth-line text-sm"></i>
                        <span>Dental Surgeon in Shastri Nagar</span>
                    </div>

                    <h1 class="mt-5 text-3xl font-extrabold leading-[1.12] tracking-tight text-med-navy sm:text-5xl lg:text-[3.5rem]">
                        Dr. Ratika Gupta<span class="text-cyan-600">.</span>
                        <span class="mt-2 block text-2xl sm:text-3xl lg:text-4xl font-bold text-med-blue">Best Dentist in Shastri Nagar, Ghaziabad</span>
                    </h1>

                    <p class="mt-5 max-w-2xl text-base leading-relaxed text-slate-600 sm:text-lg sm:leading-8">
                        Dr. Ratika Gupta is an experienced dental surgeon providing thoughtful, family-friendly dental care at MediDENT Multicare Clinic in Shastri Nagar, Ghaziabad. With over 12 years of clinical experience, she helps children and adults protect their oral health through painless preventive, cosmetic, and restorative dentistry.
                    </p>

                    <div class="mt-6 flex flex-wrap gap-2 text-xs font-semibold text-slate-600">
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-slate-200 bg-white px-3.5 py-1.5 shadow-sm">
                            <i class="ri-award-line text-cyan-700"></i>
                            <span>12+ years experience</span>
                        </span>
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-slate-200 bg-white px-3.5 py-1.5 shadow-sm">
                            <i class="ri-graduation-cap-line text-cyan-700"></i>
                            <span>B.D.S., M.D.S.</span>
                        </span>
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-slate-200 bg-white px-3.5 py-1.5 shadow-sm">
                            <i class="ri-parent-line text-cyan-700"></i>
                            <span>Pediatric &amp; preventive care</span>
                        </span>
                    </div>

                    <div class="mt-8 flex flex-col gap-3.5 sm:flex-row sm:items-center">
                        <button type="button"
                                @click="$dispatch('open-booking-modal')"
                                class="group inline-flex w-full sm:w-auto items-center justify-center gap-2.5 rounded-full bg-med-navy px-7 py-3.5 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:bg-cyan-700 hover:shadow-lg active:translate-y-0">
                            <span>Book a Dental Appointment</span>
                            <i class="ri-arrow-right-line text-base transition-transform duration-200 group-hover:translate-x-1"></i>
                        </button>

                        <a href="tel:+918290582582"
                           class="group inline-flex w-full sm:w-auto items-center justify-center gap-2 rounded-full border border-slate-200 bg-white px-7 py-3.5 text-sm font-semibold text-med-navy shadow-sm transition-all duration-200 hover:border-cyan-700 hover:text-cyan-700 hover:shadow-md active:translate-y-0">
                            <i class="ri-phone-line text-cyan-700 text-base"></i>
                            <span>+91-8290582582</span>
                        </a>
                    </div>
                </div>

                {{-- Doctor Profile Photo Card --}}
                <div class="relative mx-auto w-full max-w-md lg:mx-0 lg:ml-auto">
                    <div class="relative overflow-hidden rounded-[2.5rem] border-4 border-white bg-slate-100 shadow-[0_25px_60px_rgba(18,50,74,0.14)]">
                        <img
                            src="{{ asset('dental/Dr.-Ratika-Gupta-4.jpg') }}"
                            alt="Dr. Ratika Gupta, dentist in Shastri Nagar, Ghaziabad"
                            fetchpriority="high"
                            decoding="async"
                            class="aspect-[4/5] w-full object-cover object-center"
                        >

                        <div class="pointer-events-none absolute inset-x-0 bottom-0 h-36 bg-gradient-to-t from-med-navy/60 via-med-navy/20 to-transparent"></div>

                        <div class="absolute inset-x-5 bottom-5 rounded-2xl border border-white/60 bg-white/95 p-4 shadow-lg backdrop-blur-md">
                            <p class="text-xs font-bold uppercase tracking-wider text-cyan-700">Dental Surgeon</p>
                            <p class="mt-0.5 text-lg font-bold text-med-navy">Dr. Ratika Gupta</p>
                            <p class="mt-0.5 text-xs text-slate-500">B.D.S., M.D.S. · MediDENT Multicare Clinic</p>
                        </div>
                    </div>

                    {{-- Experience Badge --}}
                    <div class="absolute -left-3 top-6 hidden rounded-2xl bg-med-navy px-4 py-3 text-white shadow-xl sm:block">
                        <p class="text-2xl font-extrabold leading-none">12+</p>
                        <p class="mt-1 text-[10px] font-semibold uppercase tracking-wider text-cyan-200">Years of Care</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- INTRODUCTION & QUALIFICATIONS --}}
    <section class="border-t border-slate-100 bg-white py-12 sm:py-16 lg:py-24">
        <div class="mx-auto grid max-w-7xl gap-10 px-5 sm:px-6 lg:grid-cols-[minmax(0,1.15fr)_minmax(320px,.85fr)] lg:gap-14 lg:px-8">
            <div>
                <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold leading-tight tracking-tight text-med-navy">
                    Personalized dental care for children and adults<span class="text-cyan-600">.</span>
                </h2>

                <div class="mt-6 space-y-4 text-base leading-relaxed text-slate-600 sm:text-lg sm:leading-8">
                    <p>
                        Dr. Ratika Gupta practises at MediDENT Multicare Clinic, a modern family healthcare centre in Shastri Nagar, Ghaziabad. Her approach combines gentle, careful diagnosis with clear explanations, so patients understand every procedure and feel completely comfortable in the dental chair.
                    </p>

                    <p>
                        She has more than 12 years of experience as a dental surgeon in Ghaziabad and Delhi NCR. Her clinical expertise covers pediatric and preventive dentistry, painless root canal treatment, cosmetic smile styling, and dental implants.
                    </p>

                    <p>
                        Patients appreciate her calm, gentle manner and practical guidance. Whether you need a routine check-up, relief from severe tooth pain, or advice about cosmetic alignment, the focus is always on painless care and long-term oral health.
                    </p>
                </div>

                <div class="mt-8 grid gap-4 sm:grid-cols-2">
                    <div class="rounded-3xl border border-slate-100 bg-[#fbfdfd] p-6 shadow-sm transition hover:bg-white hover:shadow-md">
                        <span class="grid h-12 w-12 place-items-center rounded-2xl bg-cyan-50 text-2xl text-cyan-700">
                            <i class="ri-shield-check-line"></i>
                        </span>
                        <h3 class="mt-4 text-base font-bold text-med-navy">Prevention-First Approach</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-500">
                            Regular cleanings and early diagnosis prevent dental pain, infections, and avoid complex treatments.
                        </p>
                    </div>

                    <div class="rounded-3xl border border-slate-100 bg-[#fbfdfd] p-6 shadow-sm transition hover:bg-white hover:shadow-md">
                        <span class="grid h-12 w-12 place-items-center rounded-2xl bg-cyan-50 text-2xl text-cyan-700">
                            <i class="ri-parent-line"></i>
                        </span>
                        <h3 class="mt-4 text-base font-bold text-med-navy">Care for the Whole Family</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-500">
                            Gentle dentistry for toddlers, school-age kids, adults, and seniors, with treatments explained step by step.
                        </p>
                    </div>
                </div>
            </div>

            <aside class="space-y-6 lg:sticky lg:top-24 lg:self-start">
                {{-- Educational Qualifications Card --}}
                <div class="rounded-3xl border border-slate-100 bg-white shadow-sm overflow-hidden">
                    <div class="border-b border-slate-100 bg-[#f8fbfd] px-6 py-5">
                        <h2 class="text-base font-bold text-med-navy">Educational Qualifications</h2>
                        <p class="mt-0.5 text-xs text-slate-400">Formal postgraduate dental training and certifications.</p>
                    </div>

                    <div class="divide-y divide-slate-100">
                        <div class="flex gap-4 p-5 sm:p-6">
                            <span class="grid h-11 w-11 shrink-0 place-items-center rounded-2xl bg-sky-50 text-xl text-med-blue">
                                <i class="ri-graduation-cap-line"></i>
                            </span>

                            <div>
                                <p class="text-sm font-bold text-med-navy">B.D.S. (Bachelor of Dental Surgery)</p>
                                <p class="mt-1 text-sm text-slate-600">
                                    Bankey Bihari Dental College, Ghaziabad
                                </p>
                                <p class="mt-0.5 text-xs text-slate-400">
                                    CCS University, Meerut
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4 p-5 sm:p-6">
                            <span class="grid h-11 w-11 shrink-0 place-items-center rounded-2xl bg-cyan-50 text-xl text-cyan-700">
                                <i class="ri-award-line"></i>
                            </span>

                            <div>
                                <p class="text-sm font-bold text-med-navy">M.D.S. (Master of Dental Surgery)</p>
                                <p class="mt-1 text-sm text-slate-600">
                                    Jaipur Dental College
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Areas of Expertise Card --}}
                <div class="rounded-3xl border border-cyan-100 bg-gradient-to-br from-cyan-50/70 to-white p-6 shadow-sm">
                    <h2 class="text-base font-bold text-med-navy">Areas of Dental Expertise</h2>

                    <ul class="mt-4 space-y-2.5 text-sm text-slate-600">
                        @foreach (['Pediatric and preventive dentistry', 'Painless root canal treatment', 'General dentistry & tooth fillings', 'Cosmetic smile design & teeth whitening', 'Dental crowns, bridges & implants', 'Orthodontic braces & aligners guidance'] as $expertise)
                            <li class="flex items-start gap-2.5">
                                <i class="ri-checkbox-circle-fill mt-0.5 text-base text-cyan-700"></i>
                                <span>{{ $expertise }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <a href="#dental-services"
                       class="group mt-6 inline-flex items-center gap-2 border-t border-cyan-100 pt-4 text-sm font-semibold text-cyan-700 transition hover:text-cyan-900">
                        <span>Explore dental treatments</span>
                        <i class="ri-arrow-down-line transition-transform duration-200 group-hover:translate-y-0.5"></i>
                    </a>
                </div>
            </aside>
        </div>
    </section>

    {{-- DENTAL SERVICES --}}
    <section id="dental-services" class="scroll-mt-24 border-y border-slate-100 bg-[#FAFDFE] py-12 sm:py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
                <div class="max-w-3xl">
                    <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-med-navy">
                        Dental treatments offered by Dr. Ratika Gupta<span class="text-cyan-600">.</span>
                    </h2>

                    <p class="mt-3 sm:mt-4 max-w-xl text-sm sm:text-base leading-relaxed text-slate-600">
                        From routine dental check-ups to aesthetic and restorative smile makeovers, treatments are tailored around your oral wellness.
                    </p>
                </div>

                <button type="button"
                    @click="$dispatch('open-booking-modal')"
                    class="group inline-flex w-full sm:w-auto shrink-0 items-center justify-center gap-2.5 rounded-full bg-med-navy px-7 py-3.5 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:-translate-y-0.5 hover:bg-cyan-700 hover:shadow-lg">
                    <span>Book a Consultation</span>
                    <i class="ri-arrow-right-line transition-transform duration-200 group-hover:translate-x-1"></i>
                </button>
            </div>

            <div class="mt-10 grid gap-6 sm:mt-12 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($services as $service)
                    <article class="group flex h-full flex-col overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-sm transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_25px_60px_rgba(18,50,74,0.12)]">
                        @if ($service['image'])
                            <div class="relative h-48 overflow-hidden bg-slate-100">
                                <img
                                    src="{{ $service['image'] }}"
                                    alt="{{ $service['alt'] }}"
                                    loading="lazy"
                                    class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                                >

                                <div class="absolute inset-0 bg-gradient-to-t from-med-navy/30 via-transparent to-transparent"></div>

                                <span class="absolute left-4 top-4 grid h-10 w-10 place-items-center rounded-2xl bg-white/95 text-xl text-cyan-700 shadow-sm backdrop-blur">
                                    <i class="{{ $service['icon'] }}"></i>
                                </span>
                            </div>
                        @endif

                        <div class="flex flex-1 flex-col p-6 sm:p-7">
                            @if (! $service['image'])
                                <span class="grid h-12 w-12 place-items-center rounded-2xl bg-cyan-50 text-2xl text-cyan-700 transition group-hover:scale-110">
                                    <i class="{{ $service['icon'] }}"></i>
                                </span>
                            @endif

                            <h3 @class([
                                'text-xl font-bold leading-snug text-med-navy group-hover:text-cyan-700 transition-colors',
                                'mt-4' => ! $service['image'],
                            ])>
                                {{ $service['title'] }}
                            </h3>

                            <p class="mt-3 flex-1 text-sm leading-relaxed text-slate-600">
                                {{ $service['description'] }}
                            </p>

                            <button type="button"
                                    @click="$dispatch('open-booking-modal')"
                                    class="group/btn mt-6 inline-flex w-fit items-center gap-2 border-t border-slate-100 pt-4 text-sm font-semibold text-cyan-700">
                                <span>Book this consultation</span>
                                <i class="ri-arrow-right-line transition-transform duration-200 group-hover/btn:translate-x-1"></i>
                            </button>
                        </div>
                    </article>
                @empty
                    <div class="rounded-3xl border border-slate-100 bg-white p-8 text-center text-sm leading-relaxed text-slate-500 sm:col-span-2 lg:col-span-3">
                        Dental service information is currently being updated. Please
                        <a href="{{ route('contact') }}" class="font-semibold text-cyan-700 underline underline-offset-2 hover:text-cyan-900">contact the clinic</a>
                        to ask about a treatment or book a consultation.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- WHY CHOOSE --}}
    <section class="bg-white py-12 sm:py-16 lg:py-24">
        <div class="mx-auto grid max-w-7xl gap-10 px-5 sm:px-6 lg:grid-cols-[minmax(0,1fr)_minmax(340px,.8fr)] lg:items-start lg:gap-14 lg:px-8">
            <div>
                <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold leading-tight tracking-tight text-med-navy">
                    Experienced dentistry with a calm, gentle approach<span class="text-cyan-600">.</span>
                </h2>

                <div class="mt-6 space-y-4 text-base leading-relaxed text-slate-600 sm:text-lg sm:leading-8">
                    <p>
                        Dental visits can feel intimidating, especially for children or anyone who has had a painful past experience. Dr. Ratika Gupta takes time to listen, explain every step in plain language, and ensure complete comfort with local anesthesia before starting any procedure.
                    </p>

                    <p>
                        Her comprehensive background across preventive, pediatric, cosmetic, and implant dentistry ensures holistic dental health for all family members in Shastri Nagar, Ghaziabad.
                    </p>
                </div>

                <ul class="mt-8 grid gap-3.5 sm:grid-cols-2">
                    @foreach ([
                        'Over 12 years of clinical dental surgery experience',
                        'Recognized B.D.S. and M.D.S. degrees',
                        'Gentle, anxiety-free care for kids and adults',
                        'Painless root canal treatment and modern fillings',
                        'Cosmetic smile styling, tooth whitening & implants',
                        'Centrally located at Shastri Nagar, Ghaziabad',
                    ] as $reason)
                        <li class="flex items-start gap-3 rounded-2xl border border-slate-100 bg-[#fbfdfd] p-4 text-sm leading-relaxed text-slate-600 shadow-sm">
                            <i class="ri-checkbox-circle-fill mt-0.5 text-base text-cyan-700 shrink-0"></i>
                            <span>{{ $reason }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="space-y-6">
                {{-- Visit the Clinic Card --}}
                <div class="rounded-3xl bg-med-navy p-7 text-white shadow-xl sm:p-8">
                    <p class="text-xs font-bold uppercase tracking-wider text-cyan-300">
                        Visit the Clinic
                    </p>

                    <h2 class="mt-3 text-2xl font-extrabold leading-tight tracking-tight">
                        Dental care in Shastri Nagar, Ghaziabad
                    </h2>

                    <div class="mt-5 space-y-3.5 text-sm leading-relaxed text-slate-300">
                        <p class="flex items-start gap-3">
                            <i class="ri-map-pin-line mt-0.5 text-lg text-cyan-300 shrink-0"></i>
                            <span>{{ $settings->address }}</span>
                        </p>

                        <div class="flex items-start gap-3">
                            <i class="ri-time-line mt-0.5 text-lg text-cyan-300 shrink-0"></i>
                            <div>
                                <p>Monday–Saturday: 11:00 AM–1:00 PM and 5:00 PM–8:00 PM</p>
                                <p class="text-xs text-slate-400 mt-0.5">Sunday: Closed</p>
                            </div>
                        </div>

                        <p class="flex items-center gap-3">
                            <i class="ri-phone-line text-lg text-cyan-300 shrink-0"></i>
                            <a href="tel:+918290582582" class="font-bold text-white transition hover:text-cyan-200">+91-8290582582</a>
                        </p>
                    </div>

                    <div class="mt-7 flex flex-col gap-3">
                        <button type="button"
                                @click="$dispatch('open-booking-modal')"
                                class="group inline-flex w-full items-center justify-center gap-2 rounded-full bg-cyan-700 px-6 py-3.5 text-sm font-semibold text-white shadow-md transition hover:bg-cyan-600 hover:shadow-lg">
                            <span>Book an Appointment</span>
                            <i class="ri-arrow-right-line transition-transform duration-200 group-hover:translate-x-1"></i>
                        </button>

                        <a href="{{ route('contact') }}"
                           class="inline-flex w-full items-center justify-center gap-2 rounded-full border border-white/20 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/10">
                            <span>Contact MediDENT</span>
                        </a>
                    </div>
                </div>

                {{-- Blog promo card --}}
                <div class="rounded-3xl border border-slate-100 bg-[#f8fbfd] p-6 text-sm leading-relaxed text-slate-500 shadow-sm">
                    <p class="font-bold text-med-navy">Looking for dental health advice?</p>
                    <p class="mt-2 text-xs leading-5">
                        Read practical dental guidance written by our doctors in the
                        <a href="{{ route('blog') }}" class="font-bold text-cyan-700 underline underline-offset-2 hover:text-cyan-900">MediDENT health journal</a>,
                        including articles on pediatric cavity care and root canals.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ SECTION --}}
    <section id="faq" class="scroll-mt-24 border-t border-slate-100 bg-[#FAFDFE] py-12 sm:py-16 lg:py-24">
        <div class="mx-auto max-w-4xl px-5 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-med-navy sm:text-4xl lg:text-5xl">
                    Questions about Dental Care<span class="text-cyan-600">.</span>
                </h2>

                <p class="mx-auto mt-4 max-w-2xl text-base leading-relaxed text-slate-600">
                    Helpful answers about visiting Dr. Ratika Gupta at MediDENT Multicare Clinic.
                </p>
            </div>

            <div class="mt-10 space-y-3.5">
                @foreach ($faqs as $faq)
                    <details class="group rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm transition-all duration-200 hover:border-cyan-600/40 hover:shadow-md sm:p-6 [&_summary::-webkit-details-marker]:hidden">
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 text-left focus:outline-none">
                            <h3 class="text-base font-bold text-med-navy transition-colors group-hover:text-cyan-700">
                                {{ $faq['question'] }}
                            </h3>

                            <span class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-slate-100 text-slate-600 transition-all duration-300 group-open:rotate-45 group-open:bg-cyan-700 group-open:text-white">
                                <i class="ri-add-line text-lg"></i>
                            </span>
                        </summary>

                        <div class="mt-4 border-t border-slate-100 pt-4 text-sm leading-relaxed text-slate-600">
                            {{ $faq['answer'] }}
                        </div>
                    </details>
                @endforeach
            </div>
        </div>
    </section>

    {{-- FINAL CTA BANNER --}}
    <section class="border-t border-slate-100 bg-white py-12 sm:py-16">
        <div class="mx-auto max-w-5xl px-5 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-3xl border border-cyan-100 bg-gradient-to-br from-cyan-50/80 via-white to-sky-50/60 p-8 sm:p-12 text-center shadow-sm">
                <h2 class="relative text-2xl font-extrabold tracking-tight text-med-navy sm:text-3xl lg:text-4xl">
                    Ready to see a dentist in Shastri Nagar, Ghaziabad<span class="text-cyan-600">?</span>
                </h2>

                <p class="relative mx-auto mt-3 max-w-2xl text-base leading-relaxed text-slate-600">
                    Book a consultation with Dr. Ratika Gupta for preventive care, dental pain relief, cosmetic styling, or a child’s dental visit.
                </p>

                <div class="relative mt-7 flex flex-col justify-center gap-3.5 sm:flex-row sm:items-center">
                    <button type="button"
                            @click="$dispatch('open-booking-modal')"
                            class="group inline-flex items-center justify-center gap-2 rounded-full bg-cyan-700 px-7 py-3.5 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:bg-cyan-800 hover:shadow-lg">
                        <span>Book an Appointment</span>
                        <i class="ri-arrow-right-line transition-transform duration-200 group-hover:translate-x-1"></i>
                    </button>

                    <a href="tel:+918290582582"
                       class="inline-flex items-center justify-center gap-2 rounded-full border border-slate-200 bg-white px-7 py-3.5 text-sm font-semibold text-med-navy shadow-sm transition hover:border-cyan-700 hover:text-cyan-700 hover:shadow-md">
                        <i class="ri-phone-line text-cyan-700"></i>
                        <span>Call +91-8290582582</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

