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
                <span class="text-med-blue">Dr. Divya Prakash</span>
            </nav>

            <div class="mt-8 grid items-center gap-10 lg:grid-cols-[minmax(0,1fr)_minmax(360px,.85fr)] lg:gap-14">
                <div>
                    <h1 class="text-3xl font-extrabold leading-[1.12] tracking-tight text-med-navy sm:text-5xl lg:text-[3.5rem]">
                        Dr. Divya Prakash<span class="text-med-blue">.</span>
                        <span class="mt-2 block text-2xl sm:text-3xl lg:text-4xl font-bold text-med-blue">Best Physician Doctor &amp; Consultant in Ghaziabad</span>
                    </h1>

                    <p class="mt-5 max-w-2xl text-base leading-relaxed text-slate-600 sm:text-lg sm:leading-8">
                        Dr. Divya Prakash is a diabetologist and general physician with over 10 years of experience. He is one of the most trusted physicians in Ghaziabad and Delhi NCR, providing comprehensive medical care at MediDENT Multicare Clinic in Shastri Nagar.
                    </p>

                    <div class="mt-6 flex flex-wrap items-center gap-y-2 gap-x-5 text-sm font-medium text-slate-600">
                        <span class="inline-flex items-center gap-2">
                            <i class="ri-award-line text-med-blue text-base"></i>
                            <strong class="text-med-navy font-semibold">10+ years</strong> experience
                        </span>
                        <span class="h-1 w-1 rounded-full bg-slate-300"></span>
                        <span class="inline-flex items-center gap-2">
                            <i class="ri-graduation-cap-line text-med-blue text-base"></i>
                            <strong class="text-med-navy font-semibold">M.B.B.S., D.N.B., MNAMS</strong>
                        </span>
                        <span class="h-1 w-1 rounded-full bg-slate-300"></span>
                        <span class="inline-flex items-center gap-2">
                            <i class="ri-heart-pulse-line text-med-red text-base"></i>
                            <span>CCEBDM (Diabetology)</span>
                        </span>
                    </div>

                    <div class="mt-8 flex flex-col gap-3.5 sm:flex-row sm:items-center">
                        <button type="button"
                                @click="$dispatch('open-booking-modal')"
                                class="group inline-flex w-full sm:w-auto items-center justify-center gap-2.5 rounded-full bg-med-navy px-7 py-3.5 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:bg-med-blue hover:shadow-lg active:translate-y-0">
                            <span>Book a Consultation</span>
                            <i class="ri-arrow-right-line text-base transition-transform duration-200 group-hover:translate-x-1"></i>
                        </button>

                        <a href="tel:+918800023032"
                           class="group inline-flex w-full sm:w-auto items-center justify-center gap-2 rounded-full border border-slate-200 bg-white px-7 py-3.5 text-sm font-semibold text-med-navy shadow-sm transition-all duration-200 hover:border-med-blue hover:text-med-blue hover:shadow-md active:translate-y-0">
                            <i class="ri-phone-line text-med-blue text-base"></i>
                            <span>+91-8800023032</span>
                        </a>
                    </div>
                </div>

                {{-- Doctor Profile Photo Card --}}
                <div class="relative mx-auto w-full max-w-md lg:mx-0 lg:ml-auto">
                    <div class="relative overflow-hidden rounded-[2.5rem] border-4 border-white bg-slate-100 shadow-[0_25px_60px_rgba(18,50,74,0.14)]">
                        <img
                            src="{{ asset('doctors/Dr.-Divya-Prakash-2.jpg') }}"
                            alt="Dr. Divya Prakash, diabetologist and general physician in Ghaziabad"
                            fetchpriority="high"
                            decoding="async"
                            class="aspect-[4/5] w-full object-cover object-top"
                        >

                        <div class="pointer-events-none absolute inset-x-0 bottom-0 h-36 bg-gradient-to-t from-med-navy/60 via-med-navy/20 to-transparent"></div>

                        <div class="absolute inset-x-5 bottom-5 rounded-2xl border border-white/60 bg-white/95 p-4 shadow-lg backdrop-blur-md">
                            <p class="text-xs font-bold uppercase tracking-wider text-med-blue">Consultant Diabetologist &amp; Physician</p>
                            <p class="mt-0.5 text-lg font-bold text-med-navy">Dr. Divya Prakash</p>
                            <p class="mt-0.5 text-xs text-slate-500">M.B.B.S., D.N.B., MNAMS, CCEBDM · MediDENT Multicare Clinic</p>
                        </div>
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
                    Experienced diabetes and general medicine care in Shastri Nagar<span class="text-med-blue">.</span>
                </h2>

                <div class="mt-6 space-y-4 text-base leading-relaxed text-slate-600 sm:text-lg sm:leading-8">
                    <p>
                        Dr. Divya Prakash is a consultant physician and diabetologist in Ghaziabad NCR with more than 10 years of clinical experience. At MediDENT Multicare Clinic, he provides in-depth medical consultation for diabetes, viral illnesses, blood pressure, thyroid disorders, and long-term condition management with a strong emphasis on clear patient communication and evidence-based treatment plans.
                    </p>

                    <p>
                        His approach combines careful physical examination and review of lab tests with personalized attention, ensuring every patient understands their diagnosis, medication plan, and dietary adjustments.
                    </p>

                    <p>
                        Consultations are available daily for adults seeking dedicated diabetes reversal advice, preventive health screenings, and comprehensive treatment for acute or everyday health concerns.
                    </p>
                </div>

                <div class="mt-8 grid gap-4 sm:grid-cols-3">
                    <div class="rounded-3xl border border-slate-100 bg-[#fbfdfd] p-6 shadow-sm transition hover:bg-white hover:shadow-md">
                        <span class="grid h-12 w-12 place-items-center rounded-2xl bg-red-50 text-2xl text-med-red">
                            <i class="ri-heart-pulse-line"></i>
                        </span>
                        <h3 class="mt-4 text-base font-bold text-med-navy">Diabetes Care</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-500">
                            Blood sugar control, HbA1c review, insulin titration, and lifestyle counseling.
                        </p>
                    </div>

                    <div class="rounded-3xl border border-slate-100 bg-[#fbfdfd] p-6 shadow-sm transition hover:bg-white hover:shadow-md">
                        <span class="grid h-12 w-12 place-items-center rounded-2xl bg-sky-50 text-2xl text-med-blue">
                            <i class="ri-stethoscope-line"></i>
                        </span>
                        <h3 class="mt-4 text-base font-bold text-med-navy">General Medicine</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-500">
                            Fever, viral infections, cough, digestive health, hypertension, and asthma.
                        </p>
                    </div>

                    <div class="rounded-3xl border border-slate-100 bg-[#fbfdfd] p-6 shadow-sm transition hover:bg-white hover:shadow-md">
                        <span class="grid h-12 w-12 place-items-center rounded-2xl bg-cyan-50 text-2xl text-cyan-700">
                            <i class="ri-shield-check-line"></i>
                        </span>
                        <h3 class="mt-4 text-base font-bold text-med-navy">Preventive Care</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-500">
                            Comprehensive body screenings, routine wellness, and lifelong disease prevention.
                        </p>
                    </div>
                </div>
            </div>

            <aside class="space-y-6 lg:sticky lg:top-24 lg:self-start">
                {{-- Educational Qualifications Card --}}
                <div class="rounded-3xl border border-slate-100 bg-white shadow-sm overflow-hidden">
                    <div class="border-b border-slate-100 bg-[#f8fbfd] px-6 py-5">
                        <h2 class="text-base font-bold text-med-navy">Educational Qualifications</h2>
                        <p class="mt-0.5 text-xs text-slate-400">Medical training, post-graduate education &amp; diabetology certification.</p>
                    </div>

                    <div class="divide-y divide-slate-100">
                        <div class="flex gap-4 p-5 sm:p-6">
                            <span class="grid h-11 w-11 shrink-0 place-items-center rounded-2xl bg-sky-50 text-xl text-med-blue">
                                <i class="ri-graduation-cap-line"></i>
                            </span>

                            <div>
                                <p class="text-sm font-bold text-med-navy">M.B.B.S.</p>
                                <p class="mt-1 text-sm text-slate-600">
                                    Rajiv Gandhi University of Health Sciences, Karnataka
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4 p-5 sm:p-6">
                            <span class="grid h-11 w-11 shrink-0 place-items-center rounded-2xl bg-cyan-50 text-xl text-cyan-700">
                                <i class="ri-award-line"></i>
                            </span>

                            <div>
                                <p class="text-sm font-bold text-med-navy">D.N.B. (Family Medicine)</p>
                                <p class="mt-1 text-sm text-slate-600">
                                    Maharaja Agrasen Hospital, Punjabi Bagh, New Delhi
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4 p-5 sm:p-6">
                            <span class="grid h-11 w-11 shrink-0 place-items-center rounded-2xl bg-red-50 text-xl text-med-red">
                                <i class="ri-book-open-line"></i>
                            </span>

                            <div>
                                <p class="text-sm font-bold text-med-navy">PGDGM (Geriatric Medicine)</p>
                                <p class="mt-1 text-sm text-slate-600">
                                    Maulana Azad Medical College (IGNOU), New Delhi
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4 p-5 sm:p-6">
                            <span class="grid h-11 w-11 shrink-0 place-items-center rounded-2xl bg-emerald-50 text-xl text-emerald-700">
                                <i class="ri-heart-pulse-line"></i>
                            </span>

                            <div>
                                <p class="text-sm font-bold text-med-navy">CCEBDM (Diabetology)</p>
                                <p class="mt-1 text-sm text-slate-600">
                                    Certification in Evidence-Based Diabetes Management
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Hospital Associations Card --}}
                <div class="rounded-3xl border border-sky-100 bg-gradient-to-br from-sky-50/70 to-white p-6 shadow-sm">
                    <h2 class="text-base font-bold text-med-navy">Hospital Associations</h2>

                    <ul class="mt-4 space-y-3 text-sm text-slate-600">
                        @foreach ([
                            'Yashoda Hospital &amp; Cancer Institute, Sanjay Nagar, Ghaziabad',
                            'Sarvodya Hospital, Kavi Nagar, D3 (Near Diamond Flyover)',
                            'Gargi Hospital, Sector-9, Raj Nagar, Ghaziabad',
                        ] as $association)
                            <li class="flex items-start gap-2.5">
                                <i class="ri-building-2-line mt-0.5 text-base text-med-blue shrink-0"></i>
                                <span>{!! $association !!}</span>
                            </li>
                        @endforeach
                    </ul>

                    <a href="#physician-services"
                       class="group mt-6 inline-flex items-center gap-2 border-t border-sky-100 pt-4 text-sm font-semibold text-med-blue transition hover:text-sky-800">
                        <span>Explore physician services</span>
                        <i class="ri-arrow-down-line transition-transform duration-200 group-hover:translate-y-0.5"></i>
                    </a>
                </div>
            </aside>
        </div>
    </section>

    {{-- PHYSICIAN SERVICES --}}
    <section id="physician-services" class="scroll-mt-24 border-y border-slate-100 bg-[#FAFDFE] py-12 sm:py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
                <div class="max-w-3xl">
                    <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-med-navy">
                        Medical care offered by Dr. Divya Prakash<span class="text-med-blue">.</span>
                    </h2>

                    <p class="mt-3 sm:mt-4 max-w-xl text-sm sm:text-base leading-relaxed text-slate-600">
                        From diabetes and blood pressure reviews to seasonal fevers, infections, and preventive wellness checks.
                    </p>
                </div>

                <button type="button"
                    @click="$dispatch('open-booking-modal')"
                    class="group inline-flex w-full sm:w-auto shrink-0 items-center justify-center gap-2.5 rounded-full bg-med-navy px-7 py-3.5 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:-translate-y-0.5 hover:bg-med-blue hover:shadow-lg">
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
                            </div>
                        @endif

                        <div class="flex flex-1 flex-col p-6 sm:p-7">
                            <div class="flex items-start justify-between gap-3">
                                <h3 class="text-xl font-bold leading-snug text-med-navy group-hover:text-med-blue transition-colors">
                                    {{ $service['title'] }}
                                </h3>

                                <span class="grid h-10 w-10 shrink-0 place-items-center rounded-2xl bg-sky-50 text-xl text-med-blue transition group-hover:scale-110">
                                    <i class="{{ $service['icon'] }}"></i>
                                </span>
                            </div>

                            <p class="mt-3 flex-1 text-sm leading-relaxed text-slate-600">
                                {{ $service['description'] }}
                            </p>

                            <button type="button"
                                    @click="$dispatch('open-booking-modal')"
                                    class="group/btn mt-6 inline-flex w-fit items-center gap-2 border-t border-slate-100 pt-4 text-sm font-semibold text-med-blue">
                                <span>Book this consultation</span>
                                <i class="ri-arrow-right-line transition-transform duration-200 group-hover/btn:translate-x-1"></i>
                            </button>
                        </div>
                    </article>
                @empty
                    <div class="rounded-3xl border border-slate-100 bg-white p-8 text-center text-sm leading-relaxed text-slate-500 sm:col-span-2 lg:col-span-3">
                        Physician service information is currently being updated. Please
                        <a href="{{ route('contact') }}" class="font-semibold text-med-blue underline underline-offset-2 hover:text-sky-800">contact the clinic</a>
                        to ask about a consultation.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- WHY CHOOSE & CLINIC TIMINGS --}}
    <section class="bg-white py-12 sm:py-16 lg:py-24">
        <div class="mx-auto grid max-w-7xl gap-10 px-5 sm:px-6 lg:grid-cols-[minmax(0,1fr)_minmax(340px,.8fr)] lg:items-start lg:gap-14 lg:px-8">
            <div>
                <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold leading-tight tracking-tight text-med-navy">
                    Clear medical guidance for diabetes and everyday health<span class="text-med-blue">.</span>
                </h2>

                <div class="mt-6 space-y-4 text-base leading-relaxed text-slate-600 sm:text-lg sm:leading-8">
                    <p>
                        Managing diabetes or chronic health concerns should not feel intimidating. Dr. Divya Prakash takes the time to listen, review lab tests, and explain medication plans in clear language.
                    </p>

                    <p>
                        His rich clinical background across internal medicine, diabetology, and geriatrics ensures that symptoms are assessed holistically, keeping long-term heart and kidney health safe.
                    </p>
                </div>

                <ul class="mt-8 grid gap-3.5 sm:grid-cols-2">
                    @foreach ([
                        'Over 10 years of clinical medicine and diabetology experience',
                        'Recognized M.B.B.S., D.N.B., MNAMS and CCEBDM qualifications',
                        'Comprehensive diabetes, hypertension and thyroid care',
                        'Personalized lifestyle, diet, and medication plans',
                        'Convenient appointments at MediDENT Clinic and Yashoda Hospital',
                        'Consultations available Monday to Saturday and Sunday morning',
                    ] as $reason)
                        <li class="flex items-start gap-3 rounded-2xl border border-slate-100 bg-[#fbfdfd] p-4 text-sm leading-relaxed text-slate-600 shadow-sm">
                            <i class="ri-checkbox-circle-fill mt-0.5 text-base text-med-blue shrink-0"></i>
                            <span>{{ $reason }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="space-y-6">
                {{-- Clinic Timings Card --}}
                <div class="rounded-3xl bg-med-navy p-7 text-white shadow-xl sm:p-8">
                    <p class="text-xs font-bold uppercase tracking-wider text-cyan-300">
                        Consultation Timings
                    </p>

                    <h2 class="mt-3 text-2xl font-extrabold leading-tight tracking-tight">
                        Consult Dr. Divya Prakash in Ghaziabad
                    </h2>

                    <div class="mt-5 space-y-4 text-sm leading-relaxed text-slate-300">
                        <div class="flex items-start gap-3">
                            <i class="ri-hospital-line mt-0.5 text-lg text-cyan-300 shrink-0"></i>
                            <div>
                                <p class="font-bold text-white">MediDENT Multicare Clinic</p>
                                <p class="mt-0.5 text-xs text-slate-300">{{ $settings->address }}</p>
                                <p class="mt-1 text-xs text-cyan-200">Mon–Sat: 5:00 PM–8:30 PM &bull; Sun: 10:00 AM–12:00 Noon</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 border-t border-white/10 pt-4">
                            <i class="ri-map-pin-line mt-0.5 text-lg text-cyan-300 shrink-0"></i>
                            <div>
                                <p class="font-bold text-white">Yashoda Superspeciality Hospital</p>
                                <p class="mt-0.5 text-xs text-slate-300">Sanjay Nagar, Ghaziabad</p>
                                <p class="mt-1 text-xs text-cyan-200">Mon–Sat: 11:00 AM–3:00 PM</p>
                            </div>
                        </div>

                        <div class="flex flex-wrap items-center gap-3 border-t border-white/10 pt-4">
                            <a href="tel:+918800023032" class="inline-flex items-center gap-1.5 font-bold text-white transition hover:text-cyan-200">
                                <i class="ri-phone-line text-cyan-300"></i>
                                <span>+91-8800023032</span>
                            </a>
                            <span class="text-slate-500">&bull;</span>
                            <a href="tel:+911204169996" class="inline-flex items-center gap-1.5 font-bold text-white transition hover:text-cyan-200">
                                <span>0120-4169996</span>
                            </a>
                        </div>
                    </div>

                    <div class="mt-7 flex flex-col gap-3">
                        <button type="button"
                                @click="$dispatch('open-booking-modal')"
                                class="group inline-flex w-full items-center justify-center gap-2 rounded-full bg-med-blue px-6 py-3.5 text-sm font-semibold text-white shadow-md transition hover:bg-sky-400 hover:shadow-lg">
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
                    <p class="font-bold text-med-navy">Looking for general health advice?</p>
                    <p class="mt-2 text-xs leading-5">
                        Read practical health guidance written by our physicians in the
                        <a href="{{ route('blog') }}" class="font-bold text-med-blue underline underline-offset-2 hover:text-sky-800">MediDENT health journal</a>,
                        including articles on diabetes management, hypertension, and preventive checkups.
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
                    Questions about Physician Care<span class="text-med-blue">.</span>
                </h2>

                <p class="mx-auto mt-4 max-w-2xl text-base leading-relaxed text-slate-600">
                    Helpful answers about visiting Dr. Divya Prakash at MediDENT Multicare Clinic.
                </p>
            </div>

            <div class="mt-10 space-y-3.5">
                @foreach ($faqs as $faq)
                    <details class="group rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm transition-all duration-200 hover:border-med-blue/40 hover:shadow-md sm:p-6 [&_summary::-webkit-details-marker]:hidden">
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 text-left focus:outline-none">
                            <h3 class="text-base font-bold text-med-navy transition-colors group-hover:text-med-blue">
                                {{ $faq['question'] }}
                            </h3>

                            <span class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-slate-100 text-slate-600 transition-all duration-300 group-open:rotate-45 group-open:bg-med-blue group-open:text-white">
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
            <div class="relative overflow-hidden rounded-3xl border border-sky-100 bg-gradient-to-br from-sky-50/80 via-white to-sky-50/60 p-8 sm:p-12 text-center shadow-sm">
                <h2 class="relative text-2xl font-extrabold tracking-tight text-med-navy sm:text-3xl lg:text-4xl">
                    Ready to consult a physician in Ghaziabad<span class="text-med-blue">?</span>
                </h2>

                <p class="relative mx-auto mt-3 max-w-2xl text-base leading-relaxed text-slate-600">
                    Book a consultation with Dr. Divya Prakash for diabetes management, fever, infections, thyroid concerns, blood pressure, or a family wellness check-up.
                </p>

                <div class="relative mt-7 flex flex-col justify-center gap-3.5 sm:flex-row sm:items-center">
                    <button type="button"
                            @click="$dispatch('open-booking-modal')"
                            class="group inline-flex items-center justify-center gap-2 rounded-full bg-med-navy px-7 py-3.5 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:bg-med-blue hover:shadow-lg">
                        <span>Book an Appointment</span>
                        <i class="ri-arrow-right-line transition-transform duration-200 group-hover:translate-x-1"></i>
                    </button>

                    <a href="tel:+918800023032"
                       class="inline-flex items-center justify-center gap-2 rounded-full border border-slate-200 bg-white px-7 py-3.5 text-sm font-semibold text-med-navy shadow-sm transition hover:border-med-blue hover:text-med-blue hover:shadow-md">
                        <i class="ri-phone-line text-med-blue"></i>
                        <span>Call +91-8800023032</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

