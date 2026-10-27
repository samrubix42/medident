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
                <span class="text-slate-500">Dr. Divya Prakash</span>
            </nav>

            <div class="mt-8 grid items-center gap-10 lg:grid-cols-[minmax(0,1fr)_minmax(360px,.85fr)] lg:gap-14">
                <div>
                    <div class="inline-flex max-w-full items-center gap-2 border border-cyan-100 bg-white px-3 py-2 text-[10px] font-bold uppercase tracking-[0.14em] text-cyan-700 sm:text-xs sm:tracking-[0.16em]">
                        <i class="ri-stethoscope-line shrink-0 text-base"></i>
                        Diabetologist &amp; General Physician in Ghaziabad
                    </div>

                    <h1 class="mt-5 max-w-3xl text-[2rem] font-bold leading-[1.12] tracking-tight text-med-navy sm:mt-6 sm:text-5xl lg:text-[3.5rem]">
                        Dr. Divya Prakash
                        <span class="mt-2 block text-med-blue">Best Physician Doctor &amp; Consultant in Ghaziabad</span>
                    </h1>

                    <p class="mt-5 max-w-2xl text-sm leading-7 text-slate-600 sm:text-base sm:leading-8">
                        Dr. Divya Prakash is a diabetologist and general physician with over 10 years of experience. He is one of the best physicians in Ghaziabad and Delhi NCR, providing thoughtful medical care at MediDENT Multicare Clinic in Shastri Nagar.
                    </p>

                    <div class="mt-6 flex flex-wrap gap-2 text-xs font-semibold text-slate-600">
                        <span class="inline-flex items-center gap-1.5 border border-slate-200 bg-white px-3 py-2">
                            <i class="ri-award-line text-med-blue"></i>
                            10+ years experience
                        </span>
                        <span class="inline-flex items-center gap-1.5 border border-slate-200 bg-white px-3 py-2">
                            <i class="ri-graduation-cap-line text-med-blue"></i>
                            M.B.B.S., D.N.B., MNAMS
                        </span>
                        <span class="inline-flex items-center gap-1.5 border border-slate-200 bg-white px-3 py-2">
                            <i class="ri-heart-pulse-line text-med-red"></i>
                            Diabetes &amp; general medicine
                        </span>
                    </div>

                    <div class="mt-7 flex flex-col gap-3 sm:flex-row">
                        <button type="button"
                                @click="$dispatch('open-booking-modal')"
                                class="inline-flex w-full items-center justify-center gap-2 bg-cyan-700 px-5 py-3.5 text-sm font-semibold text-white transition hover:bg-cyan-800 sm:w-auto sm:px-6">
                            Book a physician consultation
                            <i class="ri-arrow-right-line"></i>
                        </button>

                        <a href="tel:+918800023032"
                           class="inline-flex w-full items-center justify-center gap-2 border border-slate-300 bg-white px-5 py-3.5 text-sm font-semibold text-med-navy transition hover:border-cyan-700 hover:text-cyan-700 sm:w-auto sm:px-6">
                            <i class="ri-phone-line text-lg"></i>
                            +91-8800023032
                        </a>
                    </div>
                </div>

                <div class="relative mx-auto w-full max-w-lg lg:mx-0 lg:ml-auto">
                    <div class="absolute -inset-3 border border-cyan-100 bg-white/50"></div>

                    <div class="relative overflow-hidden border-[6px] border-white bg-slate-100 shadow-[0_24px_70px_rgba(18,50,74,0.14)]">
                        <img
                            src="{{ asset('doctors/Dr.-Divya-Prakash-2.jpg') }}"
                            alt="Dr. Divya Prakash, diabetologist and general physician in Ghaziabad"
                            fetchpriority="high"
                            decoding="async"
                            class="aspect-square w-full object-cover object-top"
                        >

                        <div class="absolute inset-x-4 bottom-4 bg-white/95 p-4 shadow-sm backdrop-blur">
                            <p class="text-xs font-bold uppercase tracking-[0.16em] text-cyan-700">Diabetologist &amp; General Physician</p>
                            <p class="mt-1 text-lg font-bold text-med-navy">Dr. Divya Prakash</p>
                            <p class="mt-1 text-xs leading-5 text-slate-500">M.B.B.S., D.N.B., MNAMS, CCEBDM (Diabetology)</p>
                        </div>
                    </div>

                    <div class="absolute -left-3 top-6 hidden bg-med-navy px-4 py-3 text-white shadow-lg sm:block">
                        <p class="text-2xl font-bold leading-none">10+</p>
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
                    Meet your physician
                </p>

                <h2 class="mt-3 text-3xl font-bold leading-tight tracking-tight text-med-navy sm:text-4xl">
                    Experienced diabetes and general medicine care in Shastri Nagar
                </h2>

                <div class="mt-6 space-y-5 text-sm leading-7 text-slate-600 sm:text-base sm:leading-8">
                    <p>
                        Dr. Divya Prakash is a consultant physician and diabetologist in Ghaziabad NCR with more than 10 years of experience. At MediDENT Multicare Clinic, he provides medical consultation for diabetes, general illnesses and long-term health conditions, with a focus on clear explanations and practical treatment plans.
                    </p>

                    <p>
                        Being one of the best general physicians in Ghaziabad and Delhi NCR reflects his expertise and dedication to patient care. His approach combines careful assessment with personalised attention, so patients understand their diagnosis and the next steps in their treatment.
                    </p>

                    <p>
                        Patients can trust that they will receive high-quality care and personalised attention from Dr. Divya Prakash when they visit MediDENT Multicare Clinic in Shastri Nagar, Ghaziabad. If you are searching for a physician near me in Ghaziabad, consultations are available for adults seeking diabetes management, preventive health advice and treatment for common medical concerns.
                    </p>
                </div>

                <div class="mt-8 grid gap-4 sm:grid-cols-3">
                    <div class="border border-slate-200 bg-white p-5">
                        <i class="ri-heart-pulse-line text-2xl text-med-red"></i>
                        <h3 class="mt-3 text-sm font-bold text-med-navy">Diabetes management</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Individualised support for blood sugar control, medication review and long-term diabetes care.
                        </p>
                    </div>

                    <div class="border border-slate-200 bg-white p-5">
                        <i class="ri-stethoscope-line text-2xl text-med-blue"></i>
                        <h3 class="mt-3 text-sm font-bold text-med-navy">General medicine</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Consultation for fever, infections, digestive concerns, respiratory symptoms and everyday health problems.
                        </p>
                    </div>

                    <div class="border border-slate-200 bg-white p-5">
                        <i class="ri-shield-check-line text-2xl text-cyan-700"></i>
                        <h3 class="mt-3 text-sm font-bold text-med-navy">Preventive care</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Health-risk assessment, lifestyle guidance and vaccination advice to support long-term wellbeing.
                        </p>
                    </div>
                </div>
            </div>

            <aside class="space-y-6 lg:sticky lg:top-24 lg:self-start">
                <div class="border border-slate-200 bg-white">
                    <div class="border-b border-slate-100 bg-[#f8fbfd] px-5 py-4 sm:px-6">
                        <h2 class="text-lg font-bold text-med-navy">Educational qualifications</h2>
                        <p class="mt-1 text-xs text-slate-500">Medical training, postgraduate education and diabetes certification.</p>
                    </div>

                    <div class="divide-y divide-slate-100">
                        <div class="flex gap-4 p-5 sm:p-6">
                            <span class="grid h-11 w-11 shrink-0 place-items-center bg-sky-50 text-xl text-med-blue">
                                <i class="ri-graduation-cap-line"></i>
                            </span>

                            <div>
                                <p class="text-sm font-bold text-med-navy">M.B.B.S.</p>
                                <p class="mt-1 text-sm leading-6 text-slate-600">
                                    Rajiv Gandhi University of Health Sciences, Karnataka
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4 p-5 sm:p-6">
                            <span class="grid h-11 w-11 shrink-0 place-items-center bg-cyan-50 text-xl text-cyan-700">
                                <i class="ri-award-line"></i>
                            </span>

                            <div>
                                <p class="text-sm font-bold text-med-navy">D.N.B.</p>
                                <p class="mt-1 text-sm leading-6 text-slate-600">
                                    Maharaja Agrasen Hospital, Punjabi Bagh, New Delhi
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4 p-5 sm:p-6">
                            <span class="grid h-11 w-11 shrink-0 place-items-center bg-red-50 text-xl text-med-red">
                                <i class="ri-book-open-line"></i>
                            </span>

                            <div>
                                <p class="text-sm font-bold text-med-navy">PGDGM</p>
                                <p class="mt-1 text-sm leading-6 text-slate-600">
                                    Maulana Azad Medical College (IGNOU), New Delhi
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4 p-5 sm:p-6">
                            <span class="grid h-11 w-11 shrink-0 place-items-center bg-emerald-50 text-xl text-emerald-700">
                                <i class="ri-heart-pulse-line"></i>
                            </span>

                            <div>
                                <p class="text-sm font-bold text-med-navy">CCEBDM (Diabetology)</p>
                                <p class="mt-1 text-sm leading-6 text-slate-600">
                                    Certification in evidence-based diabetes management
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border border-cyan-100 bg-cyan-50/60 p-5 sm:p-6">
                    <h2 class="text-sm font-bold text-med-navy">Hospital associations</h2>

                    <ul class="mt-4 space-y-3 text-sm text-slate-600">
                        @foreach ([
                            'Yashoda Hospital &amp; Cancer Institute, Sanjay Nagar, Ghaziabad',
                            'Sarvodya Hospital, Kavi Nagar, D3 (Near Diamond Flyover)',
                            'Gargi Hospital, Sector-9, Raj Nagar, Ghaziabad',
                        ] as $association)
                            <li class="flex items-start gap-2">
                                <i class="ri-building-2-line mt-0.5 text-cyan-700"></i>
                                <span>{!! $association !!}</span>
                            </li>
                        @endforeach
                    </ul>

                    <a href="#physician-services"
                       class="mt-5 inline-flex items-center gap-2 border-t border-cyan-100 pt-4 text-sm font-semibold text-cyan-700 transition hover:text-cyan-900">
                        Explore physician services
                        <i class="ri-arrow-right-line"></i>
                    </a>
                </div>
            </aside>
        </div>
    </section>

    {{-- Physician services --}}
    <section id="physician-services" class="scroll-mt-24 border-y border-slate-100 bg-[#f8fbfd] py-14 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-red">
                    Physician services
                </p>

                <h2 class="mt-3 text-3xl font-bold leading-tight tracking-tight text-med-navy sm:text-4xl">
                    Medical care offered by Dr. Divya Prakash
                </h2>

                <p class="mt-4 text-sm leading-7 text-slate-600 sm:text-base">
                    From diabetes and blood pressure review to fever, infections and preventive health checks, consultations are planned around your symptoms, medical history and long-term wellbeing.
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
                        Physician service information is currently being updated. Please
                        <a href="{{ route('contact') }}" class="font-semibold text-cyan-700 underline underline-offset-2 hover:text-cyan-900">contact the clinic</a>
                        to ask about a consultation.
                    </div>
                @endforelse
            </div>

            <p class="mt-8 text-sm leading-7 text-slate-500">
                Not sure which service you need? Start with a physician consultation. Dr. Divya Prakash will review your symptoms and medical history, explain the findings, and discuss suitable next steps.
                <a href="{{ route('contact') }}" class="font-semibold text-cyan-700 underline underline-offset-2 hover:text-cyan-900">Contact the clinic</a>
                to ask a question.
            </p>
        </div>
    </section>

    {{-- Why choose and timings --}}
    <section class="py-14 sm:py-20 lg:py-24">
        <div class="mx-auto grid max-w-7xl gap-10 px-5 sm:px-6 lg:grid-cols-[minmax(0,1fr)_minmax(320px,.8fr)] lg:items-start lg:gap-14 lg:px-8">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-red">
                    Why patients choose Dr. Divya Prakash
                </p>

                <h2 class="mt-3 text-3xl font-bold leading-tight tracking-tight text-med-navy sm:text-4xl">
                    Clear medical guidance for diabetes and everyday health
                </h2>

                <div class="mt-6 space-y-5 text-sm leading-7 text-slate-600 sm:text-base sm:leading-8">
                    <p>
                        Managing diabetes or a long-term medical condition can feel overwhelming. Dr. Divya Prakash takes time to understand your concerns, review your reports and explain treatment in simple language, so you can make informed decisions about your health.
                    </p>

                    <p>
                        His experience across general medicine and diabetology allows him to look at the whole picture rather than treating a single symptom in isolation. When specialist care is needed, he can guide you toward the right next step.
                    </p>
                </div>

                <ul class="mt-7 grid gap-4 sm:grid-cols-2">
                    @foreach ([
                        'More than 10 years of experience as a diabetologist and general physician',
                        'M.B.B.S., D.N.B., MNAMS and CCEBDM (Diabetology) qualifications',
                        'Diabetes, thyroid, heart health and general medicine consultation',
                        'Care supported by clear explanations and realistic treatment plans',
                        'Consultation at MediDENT in Shastri Nagar and Yashoda in Sanjay Nagar',
                        'Appointments available Monday to Saturday and Sunday morning',
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
                        Clinic timings
                    </p>

                    <h2 class="mt-3 text-2xl font-bold leading-tight tracking-tight">
                        Consult Dr. Divya Prakash in Ghaziabad
                    </h2>

                    <div class="mt-5 space-y-5 text-sm leading-6 text-slate-300">
                        <div class="flex gap-3">
                            <i class="ri-hospital-line mt-0.5 text-lg text-cyan-300"></i>
                            <div>
                                <p class="font-semibold text-white">MediDENT Multicare Clinic</p>
                                <p class="mt-1">{{ $settings->address }}</p>
                                <p class="mt-2">Mon to Sat: 5:00 PM to 8:30 PM</p>
                                <p>Sunday: 10:00 AM to 12:00 noon</p>
                            </div>
                        </div>

                        <div class="flex gap-3 border-t border-white/10 pt-5">
                            <i class="ri-map-pin-line mt-0.5 text-lg text-cyan-300"></i>
                            <div>
                                <p class="font-semibold text-white">Yashoda Superspeciality Hospital and Cancer Institute</p>
                                <p class="mt-1">Sanjay Nagar, Ghaziabad</p>
                                <p class="mt-2">Mon to Sat: 11:00 AM to 3:00 PM</p>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-x-4 gap-y-2 border-t border-white/10 pt-5">
                            <a href="tel:+918800023032" class="inline-flex items-center gap-2 transition hover:text-white">
                                <i class="ri-phone-line text-lg text-cyan-300"></i>
                                +91-8800023032
                            </a>
                            <a href="tel:+911204169996" class="inline-flex items-center gap-2 transition hover:text-white">
                                <i class="ri-phone-line text-lg text-cyan-300"></i>
                                0120-4169996
                            </a>
                        </div>
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
                    <p class="font-semibold text-med-navy">Looking for general health advice?</p>
                    <p class="mt-2">
                        Read practical guidance from our care team in the
                        <a href="{{ route('blog') }}" class="font-semibold text-cyan-700 underline underline-offset-2 hover:text-cyan-900">MediDENT health blog</a>,
                        including articles on diabetes, heart health and preventive care.
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
                    Questions about physician care with Dr. Divya Prakash
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
                    Ready to consult a physician in Ghaziabad?
                </h2>

                <p class="relative mx-auto mt-3 max-w-2xl text-sm leading-7 text-slate-600">
                    Book a consultation with Dr. Divya Prakash for diabetes management, fever, infections, thyroid concerns, respiratory symptoms, heart health or a general medical check-up.
                </p>

                <div class="relative mt-6 flex flex-col justify-center gap-3 sm:flex-row">
                    <button type="button"
                            @click="$dispatch('open-booking-modal')"
                            class="inline-flex items-center justify-center gap-2 bg-cyan-700 px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-cyan-800">
                        Book an appointment
                        <i class="ri-arrow-right-line"></i>
                    </button>

                    <a href="tel:+918800023032"
                       class="inline-flex items-center justify-center gap-2 border border-cyan-200 bg-white px-6 py-3.5 text-sm font-semibold text-med-navy transition hover:border-cyan-700 hover:text-cyan-700">
                        <i class="ri-phone-line"></i>
                        Call +91-8800023032
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
