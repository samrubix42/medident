<div>
    @php
        $settings = $this->settings;
        $services = $this->services;
        $faqs = $this->faqs;
    @endphp

    {{-- Hero --}}
    <section class="relative overflow-hidden border-b border-slate-100 bg-[#f5fafc]">
        <div class="pointer-events-none absolute -right-24 -top-24 h-80 w-80 rounded-full border-[46px] border-sky-100/70"></div>
        <div class="pointer-events-none absolute -bottom-28 left-1/3 h-64 w-64 rounded-full border-[34px] border-white"></div>

        <div class="relative mx-auto max-w-7xl px-5 py-10 sm:px-6 sm:py-16 lg:px-8 lg:py-20">
            <nav class="flex flex-wrap items-center gap-2 text-xs text-slate-400" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="transition hover:text-med-blue">Home</a>
                <i class="ri-arrow-right-s-line text-sm"></i>
                <a href="{{ route('about') }}" class="transition hover:text-med-blue">About Us</a>
                <i class="ri-arrow-right-s-line text-sm"></i>
                <span class="text-slate-500">Dr. Ratika Gupta</span>
            </nav>

            <div class="mt-8 grid items-center gap-10 lg:grid-cols-[minmax(0,1fr)_minmax(360px,.85fr)] lg:gap-14">
                <div>
                    <div class="inline-flex max-w-full items-center gap-2 border border-cyan-100 bg-white px-3 py-2 text-[10px] font-bold uppercase tracking-[0.14em] text-cyan-700 sm:text-xs sm:tracking-[0.16em]">
                        <i class="ri-tooth-line shrink-0 text-base"></i>
                        Dental Surgeon in Shastri Nagar
                    </div>

                    <h1 class="mt-5 max-w-3xl text-[2rem] font-bold leading-[1.12] tracking-tight text-med-navy sm:mt-6 sm:text-5xl lg:text-[3.5rem]">
                        Dr. Ratika Gupta
                        <span class="mt-2 block text-med-blue">Best Dentist in Shastri Nagar, Ghaziabad</span>
                    </h1>

                    <p class="mt-5 max-w-2xl text-sm leading-7 text-slate-600 sm:text-base sm:leading-8">
                        Dr. Ratika Gupta is an experienced dental surgeon providing thoughtful, family-friendly dental care at MediDENT Multicare Clinic in Shastri Nagar, Ghaziabad. With over 12 years of clinical experience, she helps children and adults protect their oral health through preventive, cosmetic, and restorative dentistry.
                    </p>

                    <div class="mt-6 flex flex-wrap gap-2 text-xs font-semibold text-slate-600">
                        <span class="inline-flex items-center gap-1.5 border border-slate-200 bg-white px-3 py-2">
                            <i class="ri-award-line text-med-blue"></i>
                            12+ years experience
                        </span>
                        <span class="inline-flex items-center gap-1.5 border border-slate-200 bg-white px-3 py-2">
                            <i class="ri-graduation-cap-line text-med-blue"></i>
                            B.D.S., M.D.S.
                        </span>
                        <span class="inline-flex items-center gap-1.5 border border-slate-200 bg-white px-3 py-2">
                            <i class="ri-parent-line text-med-blue"></i>
                            Pediatric &amp; preventive care
                        </span>
                    </div>

                    <div class="mt-7 flex flex-col gap-3 sm:flex-row">
                        <button type="button"
                                @click="$dispatch('open-booking-modal')"
                                class="inline-flex w-full items-center justify-center gap-2 bg-cyan-700 px-5 py-3.5 text-sm font-semibold text-white transition hover:bg-cyan-800 sm:w-auto sm:px-6">
                            Book a dental appointment
                            <i class="ri-arrow-right-line"></i>
                        </button>

                        <a href="tel:+918290582582"
                           class="inline-flex w-full items-center justify-center gap-2 border border-slate-300 bg-white px-5 py-3.5 text-sm font-semibold text-med-navy transition hover:border-cyan-700 hover:text-cyan-700 sm:w-auto sm:px-6">
                            <i class="ri-phone-line text-lg"></i>
                            +91-8290582582
                        </a>
                    </div>
                </div>

                <div class="relative mx-auto w-full max-w-lg lg:mx-0 lg:ml-auto">
                    <div class="absolute -inset-3 border border-cyan-100 bg-white/50"></div>

                    <div class="relative overflow-hidden border-[6px] border-white bg-slate-100 shadow-[0_24px_70px_rgba(18,50,74,0.14)]">
                        <img
                            src="{{ asset('dental/Dr.-Ratika-Gupta-4.jpg') }}"
                            alt="Dr. Ratika Gupta, dentist in Shastri Nagar, Ghaziabad"
                            fetchpriority="high"
                            decoding="async"
                            class="aspect-square w-full object-cover object-center"
                        >

                        <div class="absolute inset-x-4 bottom-4 bg-white/95 p-4 shadow-sm backdrop-blur">
                            <p class="text-xs font-bold uppercase tracking-[0.16em] text-cyan-700">Dental Surgeon</p>
                            <p class="mt-1 text-lg font-bold text-med-navy">Dr. Ratika Gupta</p>
                            <p class="mt-1 text-xs leading-5 text-slate-500">B.D.S., M.D.S. · MediDENT Multicare Clinic</p>
                        </div>
                    </div>

                    <div class="absolute -left-3 top-6 hidden bg-med-navy px-4 py-3 text-white shadow-lg sm:block">
                        <p class="text-2xl font-bold leading-none">12+</p>
                        <p class="mt-1 text-[10px] font-semibold uppercase tracking-[0.14em] text-cyan-200">Years of care</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Introduction and qualifications --}}
    <section class="py-14 sm:py-20 lg:py-24">
        <div class="mx-auto grid max-w-7xl gap-10 px-5 sm:px-6 lg:grid-cols-[minmax(0,1.15fr)_minmax(320px,.85fr)] lg:gap-14 lg:px-8">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-red">
                    Meet your dentist
                </p>

                <h2 class="mt-3 text-3xl font-bold leading-tight tracking-tight text-med-navy sm:text-4xl">
                    Personalised dental care for children and adults
                </h2>

                <div class="mt-6 space-y-5 text-sm leading-7 text-slate-600 sm:text-base sm:leading-8">
                    <p>
                        Dr. Ratika Gupta practises at MediDENT Multicare Clinic, a family healthcare centre in Shastri Nagar, Ghaziabad. Her approach combines careful diagnosis with clear explanations, so patients understand what is happening, why treatment is recommended, and what they can do to care for their teeth at home.
                    </p>

                    <p>
                        She has more than 12 years of experience as a dental surgeon in Ghaziabad and Delhi NCR. Her clinical interests include pediatric and preventive dentistry, general dentistry, cosmetic dentistry, and dental implants. This range allows her to support families through different stages of dental care, from a child’s first dental visit to complex restorative treatment.
                    </p>

                    <p>
                        Patients appreciate her calm manner and practical guidance. Whether you need a routine check-up, help with tooth pain, or advice about improving your smile, the goal is the same: comfortable care, healthy teeth, and a treatment plan that fits your needs.
                    </p>
                </div>

                <div class="mt-8 grid gap-4 sm:grid-cols-2">
                    <div class="border border-slate-200 bg-white p-5">
                        <i class="ri-shield-check-line text-2xl text-cyan-700"></i>
                        <h3 class="mt-3 text-sm font-bold text-med-navy">Prevention-first approach</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Regular check-ups and early treatment help reduce the risk of pain, infection, and more complex dental work.
                        </p>
                    </div>

                    <div class="border border-slate-200 bg-white p-5">
                        <i class="ri-parent-line text-2xl text-cyan-700"></i>
                        <h3 class="mt-3 text-sm font-bold text-med-navy">Care for the whole family</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Gentle dental care for children, adults, and older family members, with treatment explained at every step.
                        </p>
                    </div>
                </div>
            </div>

            <aside class="space-y-6 lg:sticky lg:top-24 lg:self-start">
                <div class="border border-slate-200 bg-white">
                    <div class="border-b border-slate-100 bg-[#f8fbfd] px-5 py-4 sm:px-6">
                        <h2 class="text-lg font-bold text-med-navy">Educational qualifications</h2>
                        <p class="mt-1 text-xs text-slate-500">Formal dental training and postgraduate education.</p>
                    </div>

                    <div class="divide-y divide-slate-100">
                        <div class="flex gap-4 p-5 sm:p-6">
                            <span class="grid h-11 w-11 shrink-0 place-items-center bg-sky-50 text-xl text-med-blue">
                                <i class="ri-graduation-cap-line"></i>
                            </span>

                            <div>
                                <p class="text-sm font-bold text-med-navy">B.D.S.</p>
                                <p class="mt-1 text-sm leading-6 text-slate-600">
                                    Bankey Bihari Dental College, Ghaziabad
                                </p>
                                <p class="mt-1 text-xs leading-5 text-slate-400">
                                    CCS University, Meerut
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4 p-5 sm:p-6">
                            <span class="grid h-11 w-11 shrink-0 place-items-center bg-cyan-50 text-xl text-cyan-700">
                                <i class="ri-award-line"></i>
                            </span>

                            <div>
                                <p class="text-sm font-bold text-med-navy">M.D.S.</p>
                                <p class="mt-1 text-sm leading-6 text-slate-600">
                                    Jaipur Dental College
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border border-cyan-100 bg-cyan-50/60 p-5 sm:p-6">
                    <h2 class="text-sm font-bold text-med-navy">Areas of dental expertise</h2>

                    <ul class="mt-4 space-y-2.5 text-sm text-slate-600">
                        @foreach (['Pediatric and preventive dentistry', 'General dentistry', 'Cosmetic dentistry', 'Dental implants', 'Root canal treatment', 'Orthodontic guidance'] as $expertise)
                            <li class="flex items-start gap-2">
                                <i class="ri-checkbox-circle-fill mt-0.5 text-cyan-700"></i>
                                {{ $expertise }}
                            </li>
                        @endforeach
                    </ul>

                    <a href="#dental-services"
                       class="mt-5 inline-flex items-center gap-2 border-t border-cyan-100 pt-4 text-sm font-semibold text-cyan-700 transition hover:text-cyan-900">
                        Explore dental services
                        <i class="ri-arrow-right-line"></i>
                    </a>
                </div>
            </aside>
        </div>
    </section>

    {{-- Dental services --}}
    <section id="dental-services" class="scroll-mt-24 border-y border-slate-100 bg-[#f8fbfd] py-14 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-red">
                    Dental services
                </p>

                <h2 class="mt-3 text-3xl font-bold leading-tight tracking-tight text-med-navy sm:text-4xl">
                    Dental treatments offered by Dr. Ratika Gupta
                </h2>

                <p class="mt-4 text-sm leading-7 text-slate-600 sm:text-base">
                    From routine dental checks to cosmetic and restorative care, treatment is planned around your oral health, comfort, and long-term needs.
                </p>
            </div>

            <div class="mt-9 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($services as $service)
                    <article class="group flex h-full flex-col overflow-hidden border border-slate-200 bg-white transition duration-300 hover:-translate-y-1 hover:border-cyan-200 hover:shadow-[0_16px_40px_rgba(18,50,74,0.08)]">
                        @if ($service['image'])
                            <div class="relative h-44 overflow-hidden bg-slate-100">
                                <img
                                    src="{{ $service['image'] }}"
                                    alt="{{ $service['alt'] }}"
                                    loading="lazy"
                                    class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                >

                                <span class="absolute left-4 top-4 grid h-9 w-9 place-items-center bg-white/95 text-lg text-cyan-700 shadow-sm">
                                    <i class="{{ $service['icon'] }}"></i>
                                </span>
                            </div>
                        @endif

                        <div class="flex flex-1 flex-col p-5 sm:p-6">
                            @if (! $service['image'])
                                <span class="grid h-11 w-11 place-items-center bg-cyan-50 text-xl text-cyan-700 transition group-hover:bg-cyan-700 group-hover:text-white">
                                    <i class="{{ $service['icon'] }}"></i>
                                </span>
                            @endif

                            <h3 @class([
                                'text-lg font-bold leading-snug text-med-navy',
                                'mt-4' => ! $service['image'],
                            ])>
                                {{ $service['title'] }}
                            </h3>

                            <p class="mt-2 flex-1 text-sm leading-6 text-slate-500">
                                {{ $service['description'] }}
                            </p>

                            <button type="button"
                                    @click="$dispatch('open-booking-modal')"
                                    class="mt-5 inline-flex w-fit items-center gap-2 border-t border-slate-100 pt-4 text-sm font-semibold text-cyan-700 transition hover:text-cyan-900">
                                Book this consultation
                                <i class="ri-arrow-right-line"></i>
                            </button>
                        </div>
                    </article>
                @empty
                    <div class="border border-slate-200 bg-white p-6 text-sm leading-7 text-slate-500 sm:col-span-2 lg:col-span-3">
                        Dental service information is currently being updated. Please
                        <a href="{{ route('contact') }}" class="font-semibold text-cyan-700 underline underline-offset-2 hover:text-cyan-900">contact the clinic</a>
                        to ask about a treatment or book a consultation.
                    </div>
                @endforelse
            </div>

            <p class="mt-8 text-sm leading-7 text-slate-500">
                Not sure which treatment you need? Start with a dental consultation. Dr. Ratika Gupta will assess your teeth and gums, explain the findings, and discuss suitable options.
                <a href="{{ route('contact') }}" class="font-semibold text-cyan-700 underline underline-offset-2 hover:text-cyan-900">Contact the clinic</a>
                to ask a question.
            </p>
        </div>
    </section>

    {{-- Why choose --}}
    <section class="py-14 sm:py-20 lg:py-24">
        <div class="mx-auto grid max-w-7xl gap-10 px-5 sm:px-6 lg:grid-cols-[minmax(0,1fr)_minmax(320px,.8fr)] lg:items-start lg:gap-14 lg:px-8">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-red">
                    Why patients choose Dr. Ratika Gupta
                </p>

                <h2 class="mt-3 text-3xl font-bold leading-tight tracking-tight text-med-navy sm:text-4xl">
                    Experienced dentistry with a calm, practical approach
                </h2>

                <div class="mt-6 space-y-5 text-sm leading-7 text-slate-600 sm:text-base sm:leading-8">
                    <p>
                        Dental visits can feel stressful, especially for children or anyone who has had a difficult experience in the past. Dr. Ratika Gupta takes time to listen, explain treatment in simple language, and help patients feel comfortable before care begins.
                    </p>

                    <p>
                        Her experience across preventive, pediatric, cosmetic, and restorative dentistry means she can look at the whole picture rather than treating a single symptom in isolation. When specialist care is needed, she can guide you toward the right next step.
                    </p>
                </div>

                <ul class="mt-7 grid gap-4 sm:grid-cols-2">
                    @foreach ([
                        'More than 12 years of dental experience in Ghaziabad and Delhi NCR',
                        'B.D.S. and M.D.S. qualifications from recognised dental colleges',
                        'Gentle care for children, adults, and nervous patients',
                        'Preventive, cosmetic, restorative, and implant dentistry',
                        'Clear treatment explanations and realistic expectations',
                        'Convenient Shastri Nagar location at MediDENT Multicare Clinic',
                    ] as $reason)
                        <li class="flex items-start gap-3 border border-slate-200 bg-white p-4 text-sm leading-6 text-slate-600">
                            <i class="ri-checkbox-circle-fill mt-0.5 text-lg text-cyan-700"></i>
                            {{ $reason }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="space-y-6">
                <div class="bg-med-navy p-6 text-white sm:p-7">
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-cyan-300">
                        Visit the clinic
                    </p>

                    <h2 class="mt-3 text-2xl font-bold leading-tight tracking-tight">
                        Dental care in Shastri Nagar, Ghaziabad
                    </h2>

                    <div class="mt-5 space-y-4 text-sm leading-6 text-slate-300">
                        <p class="flex gap-3">
                            <i class="ri-map-pin-line mt-0.5 text-lg text-cyan-300"></i>
                            <span>{{ $settings->address }}</span>
                        </p>

                        <div class="flex gap-3">
                            <i class="ri-time-line mt-0.5 text-lg text-cyan-300"></i>
                            <div>
                                <p>Monday–Saturday: 11:00 AM–1:00 PM and 5:00 PM–8:00 PM</p>
                                <p>Sunday: Closed</p>
                            </div>
                        </div>

                        <p class="flex gap-3">
                            <i class="ri-phone-line mt-0.5 text-lg text-cyan-300"></i>
                            <a href="tel:+918290582582" class="transition hover:text-white">+91-8290582582</a>
                        </p>
                    </div>

                    <div class="mt-6 flex flex-col gap-2">
                        <button type="button"
                                @click="$dispatch('open-booking-modal')"
                                class="inline-flex w-full items-center justify-center gap-2 bg-cyan-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-cyan-700">
                            Book an appointment
                            <i class="ri-arrow-right-line"></i>
                        </button>

                        <a href="{{ route('contact') }}"
                           class="inline-flex w-full items-center justify-center gap-2 border border-white/20 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/10">
                            Contact MediDENT
                        </a>
                    </div>
                </div>

                <div class="border border-slate-200 bg-[#f8fbfd] p-5 text-sm leading-6 text-slate-500 sm:p-6">
                    <p class="font-semibold text-med-navy">Looking for dental health advice?</p>
                    <p class="mt-2">
                        Read practical guidance from our care team in the
                        <a href="{{ route('blog') }}" class="font-semibold text-cyan-700 underline underline-offset-2 hover:text-cyan-900">MediDENT health blog</a>,
                        including articles on children’s dental care and root canal treatment.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    <section id="faq" class="scroll-mt-24 border-t border-slate-100 bg-[#f8fbfd] py-14 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-4xl px-5 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-red">
                    Frequently asked questions
                </p>

                <h2 class="mt-3 text-3xl font-bold leading-tight tracking-tight text-med-navy sm:text-4xl">
                    Questions about dental care with Dr. Ratika Gupta
                </h2>
            </div>

            <div class="mt-8 divide-y divide-slate-200 border border-slate-200 bg-white">
                @foreach ($faqs as $faq)
                    <details class="group p-5 sm:p-6">
                        <summary class="flex cursor-pointer list-none items-start justify-between gap-4 text-left">
                            <h3 class="text-sm font-semibold leading-6 text-med-navy sm:text-base">
                                {{ $faq['question'] }}
                            </h3>

                            <i class="ri-add-line mt-0.5 text-xl text-cyan-700 transition group-open:rotate-45"></i>
                        </summary>

                        <p class="mt-3 max-w-3xl text-sm leading-7 text-slate-600">
                            {{ $faq['answer'] }}
                        </p>
                    </details>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Final CTA --}}
    <section class="bg-white py-14 sm:py-16">
        <div class="mx-auto max-w-5xl px-5 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden border border-cyan-100 bg-cyan-50/70 px-6 py-10 text-center sm:px-10 sm:py-12">
                <div class="pointer-events-none absolute -right-12 -top-12 h-40 w-40 rounded-full border-[24px] border-white/70"></div>

                <h2 class="relative text-2xl font-bold tracking-tight text-med-navy sm:text-3xl">
                    Ready to see a dentist in Shastri Nagar, Ghaziabad?
                </h2>

                <p class="relative mx-auto mt-3 max-w-2xl text-sm leading-7 text-slate-600">
                    Book a consultation with Dr. Ratika Gupta for preventive care, dental pain, cosmetic dentistry, implants, or a child’s first dental visit.
                </p>

                <div class="relative mt-6 flex flex-col justify-center gap-3 sm:flex-row">
                    <button type="button"
                            @click="$dispatch('open-booking-modal')"
                            class="inline-flex items-center justify-center gap-2 bg-cyan-700 px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-cyan-800">
                        Book an appointment
                        <i class="ri-arrow-right-line"></i>
                    </button>

                    <a href="tel:+918290582582"
                       class="inline-flex items-center justify-center gap-2 border border-cyan-200 bg-white px-6 py-3.5 text-sm font-semibold text-med-navy transition hover:border-cyan-700 hover:text-cyan-700">
                        <i class="ri-phone-line"></i>
                        Call +91-8290582582
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
