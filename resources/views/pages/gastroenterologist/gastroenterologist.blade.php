<div>
    @php
        $settings = $this->settings;
        $areas = $this->areasOfExpertise;
        $experience = $this->experience;
        $publications = $this->publications;
        $conferences = $this->conferences;
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
                <span class="text-med-blue">Dr. Megha Rustagi</span>
            </nav>

            <div class="mt-8 grid items-center gap-10 lg:grid-cols-[minmax(0,1fr)_minmax(360px,.85fr)] lg:gap-14">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-med-blue">Pediatric Gastroenterology, Hepatology &amp; Nutrition</span>

                    <h1 class="mt-3 text-3xl font-extrabold leading-[1.12] tracking-tight text-med-navy sm:text-5xl lg:text-[3.5rem]">
                        Dr. Megha Rustagi<span class="text-med-blue">.</span>
                        <span class="mt-2 block text-2xl sm:text-3xl lg:text-4xl font-bold text-med-blue">Pediatric Gastroenterologist &amp; Hepatologist in Ghaziabad</span>
                    </h1>

                    <p class="mt-5 max-w-2xl text-base leading-relaxed text-slate-600 sm:text-lg sm:leading-8">
                        Dr. Megha Rustagi is an experienced pediatrician and pediatric gastroenterologist and hepatologist. With over 10 years of experience in pediatrics, she specialises in the diagnosis and management of digestive, intestinal and liver disorders in infants, children and adolescents.
                    </p>

                    <div class="mt-6 flex flex-wrap items-center gap-y-2 gap-x-5 text-sm font-medium text-slate-600">
                        <span class="inline-flex items-center gap-2">
                            <i class="ri-award-line text-med-blue text-base"></i>
                            <strong class="text-med-navy font-semibold">10+ years</strong> in pediatrics
                        </span>
                        <span class="h-1 w-1 rounded-full bg-slate-300"></span>
                        <span class="inline-flex items-center gap-2">
                            <i class="ri-graduation-cap-line text-med-blue text-base"></i>
                            <strong class="text-med-navy font-semibold">M.B.B.S., M.D. Pediatrics</strong>
                        </span>
                        <span class="h-1 w-1 rounded-full bg-slate-300"></span>
                        <span class="inline-flex items-center gap-2">
                            <i class="ri-microscope-line text-med-blue text-base"></i>
                            <span>ISPGHAN &amp; M.U.H.S. fellowships</span>
                        </span>
                    </div>

                    <div class="mt-8 flex flex-col gap-3.5 sm:flex-row sm:items-center">
                        <button type="button"
                                @click="$dispatch('open-booking-modal')"
                                class="group inline-flex w-full sm:w-auto items-center justify-center gap-2.5 rounded-full bg-med-navy px-7 py-3.5 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:bg-med-blue hover:shadow-lg active:translate-y-0">
                            <span>Book a Consultation</span>
                            <i class="ri-arrow-right-line text-base transition-transform duration-200 group-hover:translate-x-1"></i>
                        </button>

                        <a href="{{ $settings->phoneHref() }}"
                           class="group inline-flex w-full sm:w-auto items-center justify-center gap-2 rounded-full border border-slate-200 bg-white px-7 py-3.5 text-sm font-semibold text-med-navy shadow-sm transition-all duration-200 hover:border-med-blue hover:text-med-blue hover:shadow-md active:translate-y-0">
                            <i class="ri-phone-line text-med-blue text-base"></i>
                            <span>{{ $settings->phone }}</span>
                        </a>
                    </div>
                </div>

                {{-- Doctor Profile Photo Card --}}
                <div class="relative mx-auto w-full max-w-md lg:mx-0 lg:ml-auto">
                    <div class="relative overflow-hidden rounded-[2.5rem] border-4 border-white bg-slate-100 shadow-[0_25px_60px_rgba(18,50,74,0.14)]">
                        <img
                            src="{{ asset('doctors/Dr.-Megha-Rustagi.jpeg') }}"
                            alt="Dr. Megha Rustagi, pediatric gastroenterologist and hepatologist in Ghaziabad"
                            fetchpriority="high"
                            decoding="async"
                            class="aspect-[4/5] w-full object-cover object-top"
                        >

                        <div class="pointer-events-none absolute inset-x-0 bottom-0 h-36 bg-gradient-to-t from-med-navy/60 via-med-navy/20 to-transparent"></div>

                        <div class="absolute inset-x-5 bottom-5 rounded-2xl border border-white/60 bg-white/95 p-4 shadow-lg backdrop-blur-md">
                            <p class="text-xs font-bold uppercase tracking-wider text-med-blue">Pediatric Gastroenterology &amp; Hepatology</p>
                            <p class="mt-0.5 text-lg font-bold text-med-navy">Dr. Megha Rustagi</p>
                            <p class="mt-0.5 text-xs text-slate-500">M.B.B.S., M.D. Pediatrics · MediDENT Multicare Clinic</p>
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
                    Compassionate, evidence-based care for children’s digestive and liver health<span class="text-med-blue">.</span>
                </h2>

                <div class="mt-6 space-y-4 text-base leading-relaxed text-slate-600 sm:text-lg sm:leading-8">
                    <p>
                        Dr. Megha Rustagi is an experienced pediatrician and pediatric gastroenterologist and hepatologist with specialised fellowship training in pediatric gastroenterology and hepatology. With over 10 years of experience in pediatrics, she specialises in the diagnosis and management of digestive, intestinal and liver disorders in infants, children and adolescents.
                    </p>

                    <p>
                        Her areas of expertise include recurrent abdominal pain, constipation, GERD, chronic vomiting, food allergies, celiac disease, inflammatory bowel disease, childhood liver diseases, jaundice and gastrointestinal bleeding. She is also trained in pediatric gastrointestinal endoscopic procedures.
                    </p>

                    <p>
                        Dr. Megha believes in providing compassionate, evidence-based and child-friendly care, with a focus on accurate diagnosis, effective treatment and helping children lead healthier lives.
                    </p>
                </div>

                <div class="mt-8 grid gap-4 sm:grid-cols-3">
                    <div class="rounded-3xl border border-slate-100 bg-[#fbfdfd] p-6 shadow-sm transition hover:bg-white hover:shadow-md">
                        <span class="grid h-12 w-12 place-items-center rounded-2xl bg-sky-50 text-2xl text-med-blue">
                            <i class="ri-user-heart-line"></i>
                        </span>
                        <h3 class="mt-4 text-base font-bold text-med-navy">Child-Friendly Care</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-500">
                            A calm, reassuring approach that puts children and parents at ease.
                        </p>
                    </div>

                    <div class="rounded-3xl border border-slate-100 bg-[#fbfdfd] p-6 shadow-sm transition hover:bg-white hover:shadow-md">
                        <span class="grid h-12 w-12 place-items-center rounded-2xl bg-sky-50 text-2xl text-med-blue">
                            <i class="ri-file-search-line"></i>
                        </span>
                        <h3 class="mt-4 text-base font-bold text-med-navy">Accurate Diagnosis</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-500">
                            Structured assessment of symptoms, growth and nutrition before treatment.
                        </p>
                    </div>

                    <div class="rounded-3xl border border-slate-100 bg-[#fbfdfd] p-6 shadow-sm transition hover:bg-white hover:shadow-md">
                        <span class="grid h-12 w-12 place-items-center rounded-2xl bg-sky-50 text-2xl text-med-blue">
                            <i class="ri-microscope-line"></i>
                        </span>
                        <h3 class="mt-4 text-base font-bold text-med-navy">Endoscopy Expertise</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-500">
                            Fellowship-trained pediatric upper and lower gastrointestinal endoscopy.
                        </p>
                    </div>
                </div>
            </div>

            <aside class="space-y-6 lg:sticky lg:top-24 lg:self-start">
                {{-- Educational Qualifications Card --}}
                <div class="rounded-3xl border border-slate-100 bg-white shadow-sm overflow-hidden">
                    <div class="border-b border-slate-100 bg-[#f8fbfd] px-6 py-5">
                        <h2 class="text-base font-bold text-med-navy">Educational Qualifications</h2>
                        <p class="mt-0.5 text-xs text-slate-400">Pediatric training, fellowships and certifications.</p>
                    </div>

                    <div class="divide-y divide-slate-100">
                        <div class="flex gap-4 p-5 sm:p-6">
                            <span class="grid h-11 w-11 shrink-0 place-items-center rounded-2xl bg-sky-50 text-xl text-med-blue">
                                <i class="ri-award-line"></i>
                            </span>

                            <div>
                                <p class="text-sm font-bold text-med-navy">ISPGHAN Fellowship</p>
                                <p class="mt-1 text-sm text-slate-600">
                                    Pediatric Gastroenterology, Hepatology &amp; Nutrition · 2023–2024
                                </p>
                                <p class="mt-0.5 text-xs text-slate-400">
                                    Indraprastha Apollo Hospital, New Delhi
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4 p-5 sm:p-6">
                            <span class="grid h-11 w-11 shrink-0 place-items-center rounded-2xl bg-sky-50 text-xl text-med-blue">
                                <i class="ri-award-line"></i>
                            </span>

                            <div>
                                <p class="text-sm font-bold text-med-navy">M.U.H.S. Fellowship</p>
                                <p class="mt-1 text-sm text-slate-600">
                                    Pediatric Gastroenterology, Hepatology &amp; Nutrition · 2022–2023
                                </p>
                                <p class="mt-0.5 text-xs text-slate-400">
                                    Bai Jerbai Wadia Hospital, Mumbai
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4 p-5 sm:p-6">
                            <span class="grid h-11 w-11 shrink-0 place-items-center rounded-2xl bg-sky-50 text-xl text-med-blue">
                                <i class="ri-graduation-cap-line"></i>
                            </span>

                            <div>
                                <p class="text-sm font-bold text-med-navy">M.D. Pediatrics</p>
                                <p class="mt-1 text-sm text-slate-600">2017–2020</p>
                                <p class="mt-0.5 text-xs text-slate-400">
                                    Krishna Institute of Medical Sciences, Karad, Maharashtra
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4 p-5 sm:p-6">
                            <span class="grid h-11 w-11 shrink-0 place-items-center rounded-2xl bg-slate-100 text-xl text-slate-600">
                                <i class="ri-book-open-line"></i>
                            </span>

                            <div>
                                <p class="text-sm font-bold text-med-navy">M.B.B.S.</p>
                                <p class="mt-1 text-sm text-slate-600">2010–2015</p>
                                <p class="mt-0.5 text-xs text-slate-400">
                                    Jhalawar Medical College, Jhalawar, Rajasthan (Rajasthan University of Health Sciences)
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Areas of Expertise Card --}}
                <div class="rounded-3xl border border-sky-100 bg-gradient-to-br from-sky-50/70 to-white p-6 shadow-sm">
                    <h2 class="text-base font-bold text-med-navy">Areas of Expertise</h2>

                    <ul class="mt-4 space-y-2.5 text-sm text-slate-600">
                        @foreach (['Recurrent abdominal pain', 'Constipation &amp; chronic vomiting', 'GERD and reflux', 'Food allergies &amp; celiac disease', 'Inflammatory bowel disease', 'Childhood liver diseases &amp; jaundice', 'Gastrointestinal bleeding', 'Pediatric gastrointestinal endoscopy'] as $expertise)
                            <li class="flex items-start gap-2.5">
                                <i class="ri-checkbox-circle-fill mt-0.5 text-base text-med-blue"></i>
                                <span>{!! $expertise !!}</span>
                            </li>
                        @endforeach
                    </ul>

                    <a href="#expertise"
                       class="group mt-6 inline-flex items-center gap-2 border-t border-sky-100 pt-4 text-sm font-semibold text-med-blue transition hover:text-sky-900">
                        <span>Explore areas of care</span>
                        <i class="ri-arrow-down-line transition-transform duration-200 group-hover:translate-y-0.5"></i>
                    </a>
                </div>
            </aside>
        </div>
    </section>

    {{-- AREAS OF EXPERTISE --}}
    <section id="expertise" class="scroll-mt-24 border-y border-slate-100 bg-[#FAFDFE] py-12 sm:py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
                <div class="max-w-3xl">
                    <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-med-navy">
                        Digestive and liver care for children<span class="text-med-blue">.</span>
                    </h2>

                    <p class="mt-3 sm:mt-4 max-w-xl text-sm sm:text-base leading-relaxed text-slate-600">
                        From tummy pain and growth concerns to complex liver conditions, each child receives a clear, family-centred care plan.
                    </p>
                </div>

                <button type="button"
                    @click="$dispatch('open-booking-modal')"
                    class="group inline-flex w-full sm:w-auto shrink-0 items-center justify-center gap-2.5 rounded-full bg-med-navy px-7 py-3.5 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:-translate-y-0.5 hover:bg-med-blue hover:shadow-lg">
                    <span>Book a Consultation</span>
                    <i class="ri-arrow-right-line transition-transform duration-200 group-hover:translate-x-1"></i>
                </button>
            </div>

            <div class="mt-10 grid gap-6 sm:mt-12 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($areas as $area)
                    <article class="group flex h-full flex-col rounded-3xl border border-slate-100 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_20px_50px_rgba(18,50,74,0.10)]">
                        <span class="grid h-11 w-11 place-items-center rounded-2xl bg-sky-50 text-xl text-med-blue transition group-hover:scale-110">
                            <i class="{{ $area['icon'] }}"></i>
                        </span>

                        <h3 class="mt-4 text-base font-bold leading-snug text-med-navy">
                            {{ $area['title'] }}
                        </h3>

                        <p class="mt-2 text-sm leading-relaxed text-slate-500">
                            {{ $area['description'] }}
                        </p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- PROFESSIONAL EXPERIENCE --}}
    <section id="experience" class="scroll-mt-24 bg-white py-12 sm:py-16 lg:py-24">
        <div class="mx-auto max-w-5xl px-5 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-med-navy">
                    Professional experience<span class="text-med-blue">.</span>
                </h2>

                <p class="mx-auto mt-4 max-w-2xl text-base leading-relaxed text-slate-600">
                    Fellowship training and senior residency across pediatric gastroenterology and general pediatrics.
                </p>
            </div>

            <div class="mt-10 space-y-5 sm:mt-12">
                @foreach ($experience as $index => $item)
                    <article class="relative rounded-3xl border border-slate-100 bg-white p-6 shadow-sm sm:p-8">
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-start">
                            <span class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-sky-50 text-xl font-extrabold text-med-blue">
                                {{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}
                            </span>

                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-med-navy sm:text-xl">
                                    {{ $item['role'] }}
                                </h3>

                                <p class="mt-1 text-sm font-semibold text-med-blue">
                                    {{ $item['organisation'] }}
                                </p>

                                <p class="mt-1 text-xs font-medium tracking-wide text-slate-400">
                                    {{ $item['duration'] }}
                                </p>

                                <ul class="mt-4 space-y-2 text-sm leading-relaxed text-slate-600">
                                    @foreach ($item['highlights'] as $highlight)
                                        <li class="flex items-start gap-2.5">
                                            <i class="ri-checkbox-circle-line mt-0.5 text-base text-med-blue"></i>
                                            <span>{{ $highlight }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- RESEARCH, PUBLICATIONS & AWARDS --}}
    <section id="research" class="scroll-mt-24 border-y border-slate-100 bg-[#FAFDFE] py-12 sm:py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-med-navy">
                    Research, publications and awards<span class="text-med-blue">.</span>
                </h2>

                <p class="mt-3 sm:mt-4 max-w-2xl text-sm sm:text-base leading-relaxed text-slate-600">
                    Contributions to pediatric gastroenterology research, medical education and national conferences.
                </p>
            </div>

            <div class="mt-10 grid gap-6 lg:grid-cols-2 lg:gap-8">
                {{-- Publications --}}
                <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-sm sm:p-8">
                    <div class="flex items-center gap-3">
                        <span class="grid h-11 w-11 place-items-center rounded-2xl bg-sky-50 text-xl text-med-blue">
                            <i class="ri-file-text-line"></i>
                        </span>
                        <h3 class="text-xl font-bold text-med-navy">Publications</h3>
                    </div>

                    <ol class="mt-6 space-y-4">
                        @foreach ($publications as $publication)
                            <li class="flex gap-3 rounded-2xl border border-slate-100 bg-[#fbfdfd] p-4">
                                <span class="grid h-7 w-7 shrink-0 place-items-center rounded-full bg-med-navy text-xs font-bold text-white">
                                    {{ $loop->iteration }}
                                </span>

                                <div>
                                    <p class="text-sm font-semibold leading-relaxed text-med-navy">
                                        {{ $publication['title'] }}
                                    </p>
                                    <p class="mt-1 text-xs font-medium text-slate-500">
                                        {{ $publication['journal'] }}
                                    </p>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                </div>

                {{-- Conferences & Awards --}}
                <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-sm sm:p-8">
                    <div class="flex items-center gap-3">
                        <span class="grid h-11 w-11 place-items-center rounded-2xl bg-sky-50 text-xl text-med-blue">
                            <i class="ri-trophy-line"></i>
                        </span>
                        <h3 class="text-xl font-bold text-med-navy">Conferences &amp; Awards</h3>
                    </div>

                    <ul class="mt-6 space-y-3">
                        @foreach ($conferences as $conference)
                            <li class="rounded-2xl border border-slate-100 bg-[#fbfdfd] p-4">
                                <div class="flex items-start justify-between gap-3">
                                    <p class="text-sm font-semibold leading-relaxed text-med-navy">
                                        {{ $conference['title'] }}
                                    </p>

                                    <span class="shrink-0 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-bold text-slate-600">
                                        {{ $conference['year'] }}
                                    </span>
                                </div>

                                <p class="mt-1 text-xs font-medium text-slate-500">
                                    {{ $conference['event'] }}
                                </p>

                                @if ($conference['recognition'])
                                    <p class="mt-2 inline-flex items-center gap-1.5 rounded-full bg-sky-50 px-3 py-1 text-xs font-bold text-med-blue">
                                        <i class="ri-medal-line"></i>
                                        {{ $conference['recognition'] }}
                                    </p>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- WHY CHOOSE & CLINIC CARD --}}
    <section class="bg-white py-12 sm:py-16 lg:py-24">
        <div class="mx-auto grid max-w-7xl gap-10 px-5 sm:px-6 lg:grid-cols-[minmax(0,1fr)_minmax(340px,.8fr)] lg:items-start lg:gap-14 lg:px-8">
            <div>
                <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold leading-tight tracking-tight text-med-navy">
                    Clear answers for worried parents<span class="text-med-blue">.</span>
                </h2>

                <div class="mt-6 space-y-4 text-base leading-relaxed text-slate-600 sm:text-lg sm:leading-8">
                    <p>
                        Digestive symptoms in children can be worrying for the whole family. Dr. Megha listens carefully to the history, reviews growth and nutrition, and explains what is happening in simple language before discussing tests or treatment.
                    </p>

                    <p>
                        Her fellowship training in pediatric gastroenterology, hepatology and nutrition supports a thorough, evidence-based approach, from common concerns such as constipation and reflux to complex conditions such as inflammatory bowel disease and childhood liver disease.
                    </p>
                </div>

                <ul class="mt-8 grid gap-3.5 sm:grid-cols-2">
                    @foreach ([
                        'Over 10 years of experience in pediatrics',
                        'ISPGHAN and M.U.H.S. fellowship training',
                        'Specialist care for digestive, liver and nutrition concerns',
                        'Fellowship-trained in pediatric gastrointestinal endoscopy',
                        'Compassionate, child-friendly consultations',
                        'Evidence-based diagnosis and treatment plans',
                    ] as $reason)
                        <li class="flex items-start gap-3 rounded-2xl border border-slate-100 bg-[#fbfdfd] p-4 text-sm leading-relaxed text-slate-600 shadow-sm">
                            <i class="ri-checkbox-circle-fill mt-0.5 text-base text-med-blue shrink-0"></i>
                            <span>{{ $reason }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="space-y-6">
                {{-- Clinic Card --}}
                <div class="rounded-3xl bg-med-navy p-7 text-white shadow-xl sm:p-8">
                    <p class="text-xs font-bold uppercase tracking-wider text-sky-300">
                        Consult Dr. Megha Rustagi
                    </p>

                    <h2 class="mt-3 text-2xl font-extrabold leading-tight tracking-tight">
                        Pediatric gastroenterology care in Shastri Nagar, Ghaziabad
                    </h2>

                    <div class="mt-5 space-y-3.5 text-sm leading-relaxed text-slate-300">
                        <p class="flex items-start gap-3">
                            <i class="ri-map-pin-line mt-0.5 text-lg text-sky-300 shrink-0"></i>
                            <span>{{ $settings->address }}</span>
                        </p>

                        <p class="flex items-center gap-3">
                            <i class="ri-phone-line text-lg text-sky-300 shrink-0"></i>
                            <a href="{{ $settings->phoneHref() }}" class="font-bold text-white transition hover:text-sky-200">{{ $settings->phone }}</a>
                        </p>

                        <p class="flex items-center gap-3">
                            <i class="ri-calendar-check-line text-lg text-sky-300 shrink-0"></i>
                            <span>Consultations by appointment. Please call the clinic to confirm a suitable time.</span>
                        </p>
                    </div>

                    <div class="mt-7 flex flex-col gap-3">
                        <button type="button"
                                @click="$dispatch('open-booking-modal')"
                                class="group inline-flex w-full items-center justify-center gap-2 rounded-full bg-med-blue px-6 py-3.5 text-sm font-semibold text-white shadow-md transition hover:bg-sky-500 hover:shadow-lg">
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
                    <p class="font-bold text-med-navy">Looking for child health guidance?</p>
                    <p class="mt-2 text-xs leading-5">
                        Read practical health guidance in the
                        <a href="{{ route('blog') }}" class="font-bold text-med-blue underline underline-offset-2 hover:text-sky-900">MediDENT health journal</a>,
                        including everyday advice on nutrition, digestion and preventive care.
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
                    Questions about Pediatric Gastroenterology<span class="text-med-blue">.</span>
                </h2>

                <p class="mx-auto mt-4 max-w-2xl text-base leading-relaxed text-slate-600">
                    Helpful answers about visiting Dr. Megha Rustagi at MediDENT Multicare Clinic.
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
                    Ready to consult a pediatric gastroenterologist in Ghaziabad<span class="text-med-blue">?</span>
                </h2>

                <p class="relative mx-auto mt-3 max-w-2xl text-base leading-relaxed text-slate-600">
                    Book a consultation with Dr. Megha Rustagi for tummy pain, constipation, reflux, food allergies, liver concerns, or your child’s digestive and nutritional health.
                </p>

                <div class="relative mt-7 flex flex-col justify-center gap-3.5 sm:flex-row sm:items-center">
                    <button type="button"
                            @click="$dispatch('open-booking-modal')"
                            class="group inline-flex items-center justify-center gap-2 rounded-full bg-med-navy px-7 py-3.5 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:bg-med-blue hover:shadow-lg">
                        <span>Book an Appointment</span>
                        <i class="ri-arrow-right-line transition-transform duration-200 group-hover:translate-x-1"></i>
                    </button>

                    <a href="{{ $settings->phoneHref() }}"
                       class="inline-flex items-center justify-center gap-2 rounded-full border border-slate-200 bg-white px-7 py-3.5 text-sm font-semibold text-med-navy shadow-sm transition hover:border-med-blue hover:text-med-blue hover:shadow-md">
                        <i class="ri-phone-line text-med-blue"></i>
                        <span>Call {{ $settings->phone }}</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
