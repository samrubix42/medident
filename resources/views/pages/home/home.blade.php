<div>
    <div class="overflow-hidden">


{{-- HERO SECTION --}}
<section class="relative overflow-hidden bg-[#FAFDFE] py-8 sm:py-12 lg:py-16">

    <div class="relative mx-auto grid max-w-7xl items-center gap-10 px-5 sm:px-6 lg:grid-cols-2 lg:gap-14 lg:px-8">

        {{-- Left: Content --}}
        <div class="flex flex-col justify-center">

            <h1 class="text-3xl font-extrabold leading-[1.16] tracking-tight text-med-navy sm:text-5xl lg:text-[3.65rem]">
                Welcome to <br class="hidden sm:inline">
                <span class="text-med-blue">MediDENT Multicare Clinic</span> <br class="hidden sm:inline">
                Ghaziabad
            </h1>

            <p class="mt-4 sm:mt-6 max-w-xl text-base leading-relaxed text-slate-600 sm:text-lg sm:leading-8">
                MediDENT Multicare Clinic is a trusted destination for advanced general medicine, specialized diabetes management, and comprehensive family dental care in Shastri Nagar, Ghaziabad.
            </p>

            {{-- Action Buttons (Rounded pill design with icons as in reference) --}}
            <div class="mt-7 sm:mt-8 flex flex-col gap-3.5 sm:flex-row sm:items-center">
                <button type="button"
                   @click="$dispatch('open-booking-modal')"
                   class="group inline-flex w-full sm:w-auto items-center justify-center gap-2.5 rounded-full bg-med-navy px-7 py-3.5 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:bg-med-blue hover:shadow-lg active:translate-y-0">
                    <span>Book an Appointment</span>
                    <i class="ri-arrow-right-line text-base transition-transform duration-200 group-hover:translate-x-1"></i>
                </button>

                <a href="{{ route('about') }}"
                   class="group inline-flex w-full sm:w-auto items-center justify-center gap-2 rounded-full border border-slate-200 bg-white px-7 py-3.5 text-sm font-semibold text-med-navy shadow-sm transition-all duration-200 hover:border-med-blue hover:text-med-blue hover:shadow-md active:translate-y-0">
                    <i class="ri-shield-check-line text-med-blue text-base"></i>
                    <span>Why Choose Us</span>
                </a>
            </div>

        </div>

        {{-- Right: Hero Slider (Clean rounded card with bottom indicators as in reference) --}}
        @php
            $heroSlides = [
                [
                    'image' => asset('images/gallery/general physician/Dr.-Divya-Prakash.jpg'),
                    'alt' => 'Dr. Divya Prakash - General Physician & Diabetologist at MediDENT Clinic',
                ],
                [
                    'image' => asset('images/gallery/dental/Dr.-Ratika-Gupta.jpg'),
                    'alt' => 'Dr. Ratika Gupta - Dental Surgeon at MediDENT Clinic',
                ],
                [
                    'image' => asset('images/hero-img.jpg'),
                    'alt' => 'MediDENT Multicare Clinic Ghaziabad',
                ],
                [
                    'image' => asset('images/gallery/dental/ECG-and-medication-Room.jpg'),
                    'alt' => 'MediDENT Clinic Modern ECG & Treatment Room',
                ],
            ];
        @endphp

        <div
            x-data="{
                activeSlide: 0,
                totalSlides: {{ count($heroSlides) }},
                touchStartX: 0,
                touchEndX: 0,
                autoplayTimer: null,
                init() {
                    this.startAutoplay();
                },
                startAutoplay() {
                    this.stopAutoplay();
                    this.autoplayTimer = setInterval(() => {
                        this.next();
                    }, 5000);
                },
                stopAutoplay() {
                    if (this.autoplayTimer) {
                        clearInterval(this.autoplayTimer);
                        this.autoplayTimer = null;
                    }
                },
                next() {
                    this.activeSlide = (this.activeSlide + 1) % this.totalSlides;
                },
                prev() {
                    this.activeSlide = (this.activeSlide - 1 + this.totalSlides) % this.totalSlides;
                },
                goTo(index) {
                    this.activeSlide = index;
                },
                handleTouchStart(e) {
                    this.touchStartX = e.changedTouches[0].screenX;
                },
                handleTouchEnd(e) {
                    this.touchEndX = e.changedTouches[0].screenX;
                    if (this.touchStartX - this.touchEndX > 45) {
                        this.next();
                    } else if (this.touchEndX - this.touchStartX > 45) {
                        this.prev();
                    }
                }
            }"
            @mouseenter="stopAutoplay()"
            @mouseleave="startAutoplay()"
            @touchstart="handleTouchStart($event)"
            @touchend="handleTouchEnd($event)"
            class="group relative select-none"
        >
            {{-- Slider Card Container --}}
            <div class="relative h-[320px] w-full overflow-hidden rounded-[2rem] sm:rounded-[2.5rem] bg-slate-100 shadow-[0_20px_50px_rgba(18,50,74,0.12)] sm:h-[440px] lg:h-[500px]">

                {{-- Image Slides --}}
                @foreach ($heroSlides as $index => $slide)
                    <div
                        x-show="activeSlide === {{ $index }}"
                        x-transition:enter="transition ease-out duration-700"
                        x-transition:enter-start="opacity-0 scale-[1.02]"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-500"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-[0.98]"
                        class="absolute inset-0"
                    >
                        <img
                            src="{{ $slide['image'] }}"
                            alt="{{ $slide['alt'] }}"
                            @if ($loop->first) fetchpriority="high" @else loading="lazy" @endif
                            class="h-full w-full object-cover"
                        >
                    </div>
                @endforeach

                {{-- Bottom Subtle Gradient Vignette --}}
                <div class="pointer-events-none absolute inset-x-0 bottom-0 h-28 bg-gradient-to-t from-black/50 via-black/15 to-transparent"></div>

                {{-- Pagination Pill Indicators (Exact Match with Reference Design) --}}
                <div class="absolute bottom-5 inset-x-0 z-20 flex items-center justify-center gap-1.5">
                    @foreach ($heroSlides as $index => $slide)
                        <button
                            type="button"
                            @click.stop="goTo({{ $index }})"
                            aria-label="Go to slide {{ $index + 1 }}"
                            class="h-1.5 rounded-full transition-all duration-300 focus:outline-none"
                            :class="activeSlide === {{ $index }} ? 'w-7 bg-emerald-400' : 'w-2 bg-white/70 hover:bg-white'"
                        ></button>
                    @endforeach
                </div>

                {{-- Prev & Next Navigation Buttons (Subtle on hover) --}}
                <button
                    type="button"
                    @click.stop="prev()"
                    aria-label="Previous slide"
                    class="absolute left-4 top-1/2 z-20 grid h-10 w-10 -translate-y-1/2 place-items-center rounded-full bg-white/80 text-med-navy opacity-0 shadow-md backdrop-blur-sm transition-all duration-200 hover:bg-white hover:text-med-blue group-hover:opacity-100 focus:opacity-100 focus:outline-none">
                    <i class="ri-arrow-left-s-line text-2xl"></i>
                </button>

                <button
                    type="button"
                    @click.stop="next()"
                    aria-label="Next slide"
                    class="absolute right-4 top-1/2 z-20 grid h-10 w-10 -translate-y-1/2 place-items-center rounded-full bg-white/80 text-med-navy opacity-0 shadow-md backdrop-blur-sm transition-all duration-200 hover:bg-white hover:text-med-blue group-hover:opacity-100 focus:opacity-100 focus:outline-none">
                    <i class="ri-arrow-right-s-line text-2xl"></i>
                </button>

            </div>

        </div>

    </div>
</section>


{{-- GENERAL PHYSICIAN CONSULTATION --}}
<section id="consultation"
    class="scroll-mt-24 border-t border-slate-100 bg-white py-12 sm:py-16 lg:py-24">

    <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

        {{-- Section heading --}}
        <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">

            <div class="max-w-2xl">
                <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold leading-tight tracking-tight text-med-navy">
                    General Physician Consultation<span class="text-med-blue">.</span>
                </h2>

                <p class="mt-3 sm:mt-4 max-w-xl text-sm sm:text-base leading-relaxed text-slate-600">
                    Expert medical guidance for common illnesses, ongoing health concerns, preventive care, and your family's lifelong wellbeing.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row flex-wrap items-stretch sm:items-center gap-3">
                <a href="{{ route('services', ['category' => 'physician']) }}"
                   class="group inline-flex w-full sm:w-auto shrink-0 items-center justify-center gap-2 rounded-full border border-med-blue/20 bg-med-blue/5 px-6 py-2.5 text-sm font-semibold text-med-blue transition-all duration-200 hover:-translate-y-0.5 hover:bg-med-blue/10 text-center">
                    <span>View all medical services</span>
                    <i class="ri-arrow-right-line transition-transform duration-200 group-hover:translate-x-1"></i>
                </a>

                <button type="button"
                    @click="$dispatch('open-booking-modal')"
                    class="group inline-flex w-full sm:w-auto shrink-0 items-center justify-center gap-2 rounded-full bg-med-navy px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:bg-med-blue hover:shadow-md text-center">
                    <span>Book a Consultation</span>
                    <i class="ri-arrow-right-line transition-transform duration-200 group-hover:translate-x-1"></i>
                </button>
            </div>

        </div>

        {{-- Service cards --}}
        <div class="mt-10 grid gap-6 sm:mt-12 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($this->physicianServices as $service)
                <article
                    wire:key="home-physician-service-{{ $service['slug'] }}"
                    class="group flex h-full flex-col overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-sm transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_25px_60px_rgba(18,50,74,0.12)]">

                    <div class="relative h-56 overflow-hidden">
                        @if ($service['image'])
                            <img
                                src="{{ $service['image'] }}"
                                alt="{{ $service['alt'] }}"
                                loading="lazy"
                                class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                            >
                        @else
                            <span class="flex h-full w-full items-center justify-center bg-gradient-to-br from-sky-50 via-white to-slate-50">
                                <i class="{{ $service['icon'] }} text-6xl text-sky-200"></i>
                            </span>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-med-navy/30 via-transparent to-transparent"></div>
                    </div>

                    <div class="flex flex-1 flex-col p-6 sm:p-7">
                        <div class="flex items-start justify-between gap-3">
                            <h3 class="text-xl font-bold text-med-navy group-hover:text-med-blue transition-colors">
                                {{ $service['title'] }}
                            </h3>

                            <span class="grid h-10 w-10 shrink-0 place-items-center rounded-2xl bg-slate-50 {{ $service['accent'] }} transition group-hover:scale-110">
                                <i class="{{ $service['icon'] }} text-xl"></i>
                            </span>
                        </div>

                        <p class="mt-3 flex-1 text-sm leading-relaxed text-slate-600">
                            {{ $service['description'] }}
                        </p>

                        <a href="{{ route('services.show', $service['slug']) }}"
                            class="group/btn mt-6 inline-flex items-center gap-2 border-t border-slate-100 pt-4 text-sm font-semibold {{ $service['accent'] }}">
                            <span>View Details</span>
                            <i class="ri-arrow-right-line transition-transform duration-200 group-hover/btn:translate-x-1"></i>
                        </a>
                    </div>
                </article>
            @empty
                <div class="rounded-3xl border border-slate-100 bg-gradient-to-br from-[#f8fbfd] to-white px-6 py-12 text-center sm:col-span-2 lg:col-span-3">
                    <span class="mx-auto grid h-16 w-16 place-items-center rounded-2xl bg-white text-2xl text-med-blue shadow-sm">
                        <i class="ri-stethoscope-line"></i>
                    </span>

                    <h3 class="mt-5 text-lg font-bold text-med-navy">Medical service information is being updated.</h3>
                    <p class="mx-auto mt-2 max-w-md text-sm leading-relaxed text-slate-500">
                        Contact the clinic to ask about available consultations or book an appointment.
                    </p>
                </div>
            @endforelse
        </div>

        {{-- Bottom CTA --}}
        <div class="mt-12 flex flex-col gap-6 rounded-3xl border border-slate-100 bg-gradient-to-br from-[#f8fbfd] via-white to-sky-50/30 p-6 shadow-sm sm:flex-row sm:items-center sm:justify-between sm:p-8 lg:p-10">
            <div class="max-w-xl">
                <h3 class="text-xl font-bold text-med-navy">
                    Need help choosing the right consultation?
                </h3>

                <p class="mt-2 text-sm leading-relaxed text-slate-600">
                    Contact our clinic to discuss your concerns and available services. Our medical team will guide you to the right care.
                </p>
            </div>

            <a href="{{ route('contact') }}"
                class="group inline-flex w-full shrink-0 items-center justify-center gap-2 rounded-full bg-med-navy px-7 py-3.5 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:-translate-y-0.5 hover:bg-med-blue hover:shadow-lg sm:w-auto">
                <span>Contact the Clinic</span>
                <i class="ri-arrow-right-up-line transition-transform duration-200 group-hover:translate-x-0.5 group-hover:-translate-y-0.5"></i>
            </a>
        </div>

    </div>
</section>



    {{-- SERVICES --}}
    <section id="services" class="scroll-mt-24 py-12 sm:py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

            <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
                <div class="max-w-2xl">
                    <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-med-navy">
                        Complete care<span class="text-med-blue">.</span> One trusted clinic<span class="text-med-blue">.</span>
                    </h2>

                    <p class="mt-3 sm:mt-4 max-w-xl text-sm sm:text-base leading-relaxed text-slate-600">
                        Focused care for your everyday health, long-term diabetes management, and confident family smiles all under one roof.
                    </p>
                </div>

                <button type="button"
                    @click="$dispatch('open-booking-modal')"
                    class="group inline-flex w-full sm:w-auto shrink-0 items-center justify-center gap-2.5 rounded-full bg-med-navy px-7 py-3.5 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:-translate-y-0.5 hover:bg-med-blue hover:shadow-lg">
                    <span>Book a Consultation</span>
                    <i class="ri-arrow-right-line transition-transform duration-200 group-hover:translate-x-1"></i>
                </button>
            </div>

            <div class="mt-10 grid gap-6 sm:mt-12 sm:grid-cols-2 lg:grid-cols-3 sm:[&>*:last-child]:col-span-2 lg:[&>*:last-child]:col-span-1">

                {{-- Medical --}}
                <article class="group relative flex flex-col justify-between overflow-hidden rounded-3xl border border-slate-100 bg-white p-7 shadow-sm transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_25px_60px_rgba(18,50,74,0.12)] sm:p-8">
                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-sky-50/50 transition duration-500 group-hover:scale-150"></div>
                    
                    <div class="relative">
                        <div class="flex items-center justify-between">
                            <div class="grid h-16 w-16 place-items-center rounded-2xl bg-gradient-to-br from-sky-50 to-sky-100/50 text-2xl text-med-blue transition duration-300 group-hover:scale-110">
                                <i class="ri-stethoscope-line"></i>
                            </div>

                            <span class="text-xs font-mono font-bold tracking-widest text-slate-300 uppercase">
                                01 / MED
                            </span>
                        </div>

                        <h3 class="mt-8 text-2xl font-bold text-med-navy group-hover:text-med-blue transition-colors">
                            Medical Care
                        </h3>

                        <p class="mt-3 text-sm leading-relaxed text-slate-600">
                            Comprehensive consultations and diagnosis for everyday health concerns, infections, fever, and preventive wellness.
                        </p>

                        <ul class="mt-6 space-y-2.5 text-xs font-medium text-slate-600">
                            <li class="flex items-center gap-2">
                                <i class="ri-check-line text-sm text-med-blue"></i>
                                <span>General physician consultations</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <i class="ri-check-line text-sm text-med-blue"></i>
                                <span>Viral illness, cough & pain management</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <i class="ri-check-line text-sm text-med-blue"></i>
                                <span>Preventive health checkups</span>
                            </li>
                        </ul>
                    </div>

                    <a href="{{ route('services', ['category' => 'physician']) }}"
                        class="group/link mt-8 inline-flex items-center gap-2 text-sm font-semibold text-med-navy transition-colors group-hover:text-med-blue">
                        <span>Learn More</span>
                        <i class="ri-arrow-right-line transition-transform duration-200 group-hover/link:translate-x-1"></i>
                    </a>
                </article>

                {{-- Diabetes --}}
                <article class="group relative flex flex-col justify-between overflow-hidden rounded-3xl border border-slate-100 bg-white p-7 shadow-sm transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_25px_60px_rgba(18,50,74,0.12)] sm:p-8">
                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-red-50/50 transition duration-500 group-hover:scale-150"></div>
                    
                    <div class="relative">
                        <div class="flex items-center justify-between">
                            <div class="grid h-16 w-16 place-items-center rounded-2xl bg-gradient-to-br from-red-50 to-red-100/50 text-2xl text-med-red transition duration-300 group-hover:scale-110">
                                <i class="ri-heart-pulse-line"></i>
                            </div>

                            <span class="text-xs font-mono font-bold tracking-widest text-slate-300 uppercase">
                                02 / DIAB
                            </span>
                        </div>

                        <h3 class="mt-8 text-2xl font-bold text-med-navy group-hover:text-med-red transition-colors">
                            Diabetes Care
                        </h3>

                        <p class="mt-3 text-sm leading-relaxed text-slate-600">
                            Expert blood sugar monitoring, personalized diet guidance, and proactive care to prevent long-term diabetic complications.
                        </p>

                        <ul class="mt-6 space-y-2.5 text-xs font-medium text-slate-600">
                            <li class="flex items-center gap-2">
                                <i class="ri-check-line text-sm text-med-red"></i>
                                <span>HbA1c & blood glucose tracking</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <i class="ri-check-line text-sm text-med-red"></i>
                                <span>Dietary & lifestyle counseling</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <i class="ri-check-line text-sm text-med-red"></i>
                                <span>Diabetic foot & nerve health</span>
                            </li>
                        </ul>
                    </div>

                    <a href="{{ route('services') }}"
                        class="group/link mt-8 inline-flex items-center gap-2 text-sm font-semibold text-med-navy transition-colors group-hover:text-med-red">
                        <span>Learn More</span>
                        <i class="ri-arrow-right-line transition-transform duration-200 group-hover/link:translate-x-1"></i>
                    </a>
                </article>

                {{-- Dental --}}
                <article class="group relative flex flex-col justify-between overflow-hidden rounded-3xl border border-slate-100 bg-white p-7 shadow-sm transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_25px_60px_rgba(18,50,74,0.12)] sm:p-8">
                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-cyan-50/50 transition duration-500 group-hover:scale-150"></div>
                    
                    <div class="relative">
                        <div class="flex items-center justify-between">
                            <div class="grid h-16 w-16 place-items-center rounded-2xl bg-gradient-to-br from-cyan-50 to-cyan-100/50 text-2xl text-cyan-700 transition duration-300 group-hover:scale-110">
                                <i class="ri-tooth-line"></i>
                            </div>

                            <span class="text-xs font-mono font-bold tracking-widest text-slate-300 uppercase">
                                03 / DENT
                            </span>
                        </div>

                        <h3 class="mt-8 text-2xl font-bold text-med-navy group-hover:text-cyan-700 transition-colors">
                            Dental Care
                        </h3>

                        <p class="mt-3 text-sm leading-relaxed text-slate-600">
                            Modern dentistry with painless treatments, hygiene cleanings, root canal therapy, and aesthetic smile enhancements.
                        </p>

                        <ul class="mt-6 space-y-2.5 text-xs font-medium text-slate-600">
                            <li class="flex items-center gap-2">
                                <i class="ri-check-line text-sm text-cyan-700"></i>
                                <span>Painless fillings & root canals</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <i class="ri-check-line text-sm text-cyan-700"></i>
                                <span>Teeth cleaning & polishing</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <i class="ri-check-line text-sm text-cyan-700"></i>
                                <span>Dental crowns & smile styling</span>
                            </li>
                        </ul>
                    </div>

                    <a href="{{ route('services', ['category' => 'dental']) }}"
                        class="group/link mt-8 inline-flex items-center gap-2 text-sm font-semibold text-med-navy transition-colors group-hover:text-cyan-700">
                        <span>Learn More</span>
                        <i class="ri-arrow-right-line transition-transform duration-200 group-hover/link:translate-x-1"></i>
                    </a>
                </article>

            </div>
        </div>
    </section>

    <section id="dental-services" class="scroll-mt-24 border-t border-slate-100 bg-gradient-to-b from-white to-slate-50/30 py-12 sm:py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

            <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
                <div class="max-w-2xl">
                    <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-med-navy">
                        Complete care for every smile<span class="text-cyan-600">.</span>
                    </h2>

                    <p class="mt-3 sm:mt-4 max-w-xl text-sm sm:text-base leading-relaxed text-slate-600">
                        From preventive check-ups to restorative treatments, our dental services are designed to keep your smile healthy, bright, and comfortable.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row flex-wrap items-stretch sm:items-center gap-3">
                    <a href="{{ route('services', ['category' => 'dental']) }}"
                       class="group inline-flex w-full sm:w-auto shrink-0 items-center justify-center gap-2 rounded-full border border-cyan-700/20 bg-cyan-50 px-6 py-2.5 text-sm font-semibold text-cyan-700 transition-all duration-200 hover:-translate-y-0.5 hover:bg-cyan-100/70 text-center">
                        <span>View all dental services</span>
                        <i class="ri-arrow-right-line transition-transform duration-200 group-hover:translate-x-1"></i>
                    </a>

                    <button type="button"
                        @click="$dispatch('open-booking-modal')"
                        class="group inline-flex w-full sm:w-auto shrink-0 items-center justify-center gap-2 rounded-full bg-med-navy px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:bg-cyan-700 hover:shadow-md text-center">
                        <span>Book a Dental Visit</span>
                        <i class="ri-arrow-right-line transition-transform duration-200 group-hover:translate-x-1"></i>
                    </button>
                </div>
            </div>

            <div class="mt-10 grid gap-6 sm:mt-12 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($this->dentalServices as $service)
                    <article
                        wire:key="home-dental-service-{{ $service['slug'] }}"
                        class="group flex h-full flex-col overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-sm transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_25px_60px_rgba(18,50,74,0.12)]">
                        <div class="relative h-56 overflow-hidden">
                            @if ($service['image'])
                                <img
                                    src="{{ $service['image'] }}"
                                    alt="{{ $service['alt'] }}"
                                    loading="lazy"
                                    class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                                >
                            @else
                                <span class="flex h-full w-full items-center justify-center bg-gradient-to-br from-cyan-50 via-white to-slate-50">
                                    <i class="{{ $service['icon'] }} text-6xl text-cyan-200"></i>
                                </span>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-med-navy/30 via-transparent to-transparent"></div>
                        </div>

                        <div class="flex flex-1 flex-col p-6 sm:p-7">
                            <div class="flex items-start justify-between gap-3">
                                <h3 class="text-xl font-bold text-med-navy group-hover:text-cyan-700 transition-colors">
                                    {{ $service['title'] }}
                                </h3>

                                <span class="grid h-10 w-10 shrink-0 place-items-center rounded-2xl bg-slate-50 {{ $service['accent'] }} transition group-hover:scale-110">
                                    <i class="{{ $service['icon'] }} text-xl"></i>
                                </span>
                            </div>

                            <p class="mt-3 flex-1 text-sm leading-relaxed text-slate-600">
                                {{ $service['description'] }}
                            </p>

                            <a href="{{ route('services.show', $service['slug']) }}"
                                class="group/btn mt-6 inline-flex items-center gap-2 border-t border-slate-100 pt-4 text-sm font-semibold {{ $service['accent'] }}">
                                <span>View Details</span>
                                <i class="ri-arrow-right-line transition-transform duration-200 group-hover/btn:translate-x-1"></i>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="rounded-3xl border border-slate-100 bg-gradient-to-br from-[#f8fbfd] to-white px-6 py-12 text-center sm:col-span-2 lg:col-span-3">
                        <span class="mx-auto grid h-16 w-16 place-items-center rounded-2xl bg-white text-2xl text-cyan-700 shadow-sm">
                            <i class="ri-tooth-line"></i>
                        </span>

                        <h3 class="mt-5 text-lg font-bold text-med-navy">Dental service information is being updated.</h3>
                        <p class="mx-auto mt-2 max-w-md text-sm leading-relaxed text-slate-500">
                            Contact the clinic to ask about available dental treatments or book a consultation.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>


    {{-- ABOUT --}}
    <section id="about" class="scroll-mt-24 border-y border-slate-100 bg-gradient-to-br from-[#f5fafc] via-white to-[#f8fbfd] py-12 sm:py-16 lg:py-24">
        <div class="mx-auto grid max-w-7xl items-center gap-10 px-5 sm:gap-12 sm:px-6 lg:grid-cols-2 lg:gap-16 lg:px-8">

            <div class="relative">
                <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-med-blue/10 sm:-right-6 sm:-top-6 sm:h-32 sm:w-32"></div>
                <div class="absolute -bottom-6 -left-6 h-28 w-28 rounded-full bg-cyan-400/10 blur-2xl"></div>
                <div class="relative overflow-hidden rounded-3xl border-[6px] border-white shadow-[0_40px_80px_rgba(18,50,74,0.14)]">
                    <img
                        src="{{ asset('images/photo-1576091160399-112ba8d25d1d.avif') }}"
                        alt="Healthcare professional consulting a patient"
                        loading="lazy"
                        class="h-[320px] w-full object-cover sm:h-[450px]">
                    <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-med-navy/40 to-transparent p-6">
                        <p class="text-sm font-medium text-white">Patient-first care at every step</p>
                    </div>
                </div>

              
            </div>

            <div class="pt-3 lg:pt-0">
                <h2 class="text-3xl font-extrabold leading-tight tracking-tight text-med-navy sm:text-4xl lg:text-5xl">
                    Healthcare should feel personal, not complicated<span class="text-med-blue">.</span>
                </h2>

                <p class="mt-6 text-base leading-8 text-slate-600">
                    We believe better healthcare begins with listening. Our approach focuses on understanding your concerns, explaining your options clearly and helping you make informed decisions about your wellbeing in a warm, welcoming environment.
                </p>

                <div class="mt-8 space-y-5">

                    <div class="group flex gap-4 rounded-2xl p-4 transition hover:bg-white hover:shadow-sm">
                        <span class="grid h-11 w-11 shrink-0 place-items-center rounded-xl bg-gradient-to-br from-med-blue/10 to-med-blue/5 text-xl text-med-blue">
                            <i class="ri-heart-2-line"></i>
                        </span>
                        <div>
                            <h3 class="font-semibold text-med-navy">A patient-first approach</h3>
                            <p class="mt-1 text-sm leading-6 text-slate-600">
                                Your questions and concerns deserve time, respect and attention from our caring team.
                            </p>
                        </div>
                    </div>

                    <div class="group flex gap-4 rounded-2xl p-4 transition hover:bg-white hover:shadow-sm">
                        <span class="grid h-11 w-11 shrink-0 place-items-center rounded-xl bg-gradient-to-br from-cyan-500/10 to-cyan-500/5 text-xl text-cyan-700">
                            <i class="ri-hospital-line"></i>
                        </span>
                        <div>
                            <h3 class="font-semibold text-med-navy">Multiple care services</h3>
                            <p class="mt-1 text-sm leading-6 text-slate-600">
                                Medical, diabetes and dental services all in one convenient, trusted location.
                            </p>
                        </div>
                    </div>

                    <div class="group flex gap-4 rounded-2xl p-4 transition hover:bg-white hover:shadow-sm">
                        <span class="grid h-11 w-11 shrink-0 place-items-center rounded-xl bg-gradient-to-br from-med-red/10 to-med-red/5 text-xl text-med-red">
                            <i class="ri-chat-3-line"></i>
                        </span>
                        <div>
                            <h3 class="font-semibold text-med-navy">Clear, thoughtful guidance</h3>
                            <p class="mt-1 text-sm leading-6 text-slate-600">
                                Understand your care options and the next steps to consider for better health outcomes.
                            </p>
                        </div>
                    </div>

                </div>

                <a href="{{ route('contact') }}"
                    class="group mt-8 inline-flex w-full items-center justify-center gap-3 rounded-full bg-gradient-to-r from-med-navy to-[#0f2a3d] px-7 py-3.5 text-sm font-semibold text-white shadow-lg shadow-med-navy/25 transition-all hover:-translate-y-0.5 hover:shadow-xl hover:shadow-med-navy/35 sm:w-auto sm:justify-start">
                    Get in Touch <i class="ri-arrow-right-up-line text-lg transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5"></i>
                </a>
            </div>
        </div>
    </section>


    {{-- TESTIMONIALS --}}
    @php($reviews = $this->reviews)
    @php($googleReviewsUrl = $reviews->first()?->reviews_link)

    <section
        id="testimonials"
        role="region"
        aria-roledescription="carousel"
        aria-label="Google reviews"
        x-data="{
            active: 0,
            total: {{ $reviews->count() }},
            timer: null,
            resizeHandler: null,
            visibilityHandler: null,
            get visible() {
                return window.innerWidth >= 1024 ? 3 : (window.innerWidth >= 640 ? 2 : 1);
            },
            get maxIndex() {
                return Math.max(0, this.total - this.visible);
            },
            init() {
                this.resizeHandler = () => {
                    if (this.active > this.maxIndex) this.goTo(this.maxIndex);
                };
                this.visibilityHandler = () => document.hidden ? this.stop() : this.start();
                window.addEventListener('resize', this.resizeHandler);
                document.addEventListener('visibilitychange', this.visibilityHandler);
                this.start();
            },
            destroy() {
                this.stop();
                window.removeEventListener('resize', this.resizeHandler);
                document.removeEventListener('visibilitychange', this.visibilityHandler);
            },
            start() {
                this.stop();

                if (this.total < 2 || document.hidden) {
                    return;
                }

                this.timer = setInterval(() => this.next(), 5000);
            },
            stop() {
                if (this.timer) clearInterval(this.timer);
                this.timer = null;
            },
            next() {
                this.goTo(this.active >= this.maxIndex ? 0 : this.active + 1);
            },
            prev() {
                this.goTo(this.active <= 0 ? this.maxIndex : this.active - 1);
            },
            goTo(index) {
                this.active = Math.min(Math.max(index, 0), this.maxIndex);
                const track = this.$refs.track;
                const first = track?.children[0];
                const card = track?.children[this.active];

                if (first && card) {
                    track.scrollTo({ left: card.offsetLeft - first.offsetLeft, behavior: 'smooth' });
                }
            },
            syncActive() {
                const track = this.$refs.track;

                if (! track || track.children.length === 0) {
                    return;
                }

                const first = track.children[0];
                let closest = 0;
                let distance = Infinity;

                Array.from(track.children).forEach((card, index) => {
                    const current = Math.abs(card.offsetLeft - first.offsetLeft - track.scrollLeft);

                    if (current < distance) {
                        distance = current;
                        closest = index;
                    }
                });

                this.active = Math.min(closest, this.maxIndex);
            }
        }"
        class="scroll-mt-24 py-12 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

            <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
                <div class="max-w-2xl">
                    <h2 class="text-3xl font-extrabold tracking-tight text-med-navy sm:text-4xl lg:text-5xl">
                        What our patients say<span class="text-med-blue">.</span>
                    </h2>

                    <p class="mt-4 max-w-xl text-base leading-relaxed text-slate-600">
                        Authentic patient stories and reviews from individuals and families treated at MediDENT Multicare Clinic.
                    </p>

                    {{-- Clean Trust Metric Lockup (No badge pill) --}}
                    <div class="mt-6 flex flex-wrap items-center gap-4">
                        <div class="flex items-center gap-2">
                            <div class="flex text-base text-amber-400">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                            </div>
                            <span class="text-base font-extrabold text-med-navy">4.9</span>
                            <span class="text-xs font-semibold text-slate-400">/ 5.0</span>
                        </div>

                        <span class="h-3.5 w-px bg-slate-200"></span>

                        <div class="flex items-center gap-1.5 text-xs font-semibold text-slate-600">
                            <img src="{{ asset('google-img.png') }}" alt="" class="h-4 w-4" loading="lazy" decoding="async">
                            <span>Google Reviews</span>
                        </div>

                        @if ($googleReviewsUrl)
                            <span class="h-3.5 w-px bg-slate-200"></span>
                            <a href="{{ $googleReviewsUrl }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="group/link inline-flex items-center gap-1 text-xs font-semibold text-med-blue transition hover:text-sky-800">
                                <span>View all on Google</span>
                                <i class="ri-arrow-right-up-line transition-transform duration-200 group-hover/link:translate-x-0.5 group-hover/link:-translate-y-0.5"></i>
                            </a>
                        @endif
                    </div>
                </div>

                @if ($reviews->count() > 1)
                    <div class="flex items-center gap-3">
                        <button
                            type="button"
                            @click="prev()"
                            aria-label="Previous review"
                            class="grid h-12 w-12 place-items-center rounded-full border border-slate-200 bg-white text-med-navy shadow-sm transition-all duration-200 hover:border-med-blue hover:text-med-blue hover:shadow-md active:scale-95">
                            <i class="ri-arrow-left-line text-lg"></i>
                        </button>

                        <button
                            type="button"
                            @click="next()"
                            aria-label="Next review"
                            class="grid h-12 w-12 place-items-center rounded-full bg-med-navy text-white shadow-md transition-all duration-200 hover:bg-med-blue hover:shadow-lg active:scale-95">
                            <i class="ri-arrow-right-line text-lg"></i>
                        </button>
                    </div>
                @endif
            </div>

            @if ($reviews->isEmpty())
                <div class="mt-9 rounded-3xl border border-slate-100 bg-white p-8 text-center shadow-sm">
                    <img src="{{ asset('google-img.png') }}"
                         alt=""
                         class="mx-auto h-10 w-10"
                         loading="lazy"
                         decoding="async">
                    <p class="mt-3 font-semibold text-med-navy">Google reviews are on the way.</p>
                    <p class="mt-1 text-sm text-slate-500">Our latest patient reviews will appear here soon.</p>
                </div>
            @else
                <div x-ref="track"
                     @scroll.debounce.300ms="syncActive()"
                     class="mt-8 flex snap-x snap-mandatory gap-5 overflow-x-auto scroll-smooth pb-3 sm:mt-10 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                    @foreach ($reviews as $review)
                        @php($authorName = $review->author_title ?: 'Google user')
                        @php($rating = (float) $review->review_rating)

                        <article
                            role="group"
                            aria-roledescription="slide"
                            aria-label="Review {{ $loop->iteration }} of {{ $reviews->count() }}"
                            class="group relative flex w-[86%] shrink-0 snap-start flex-col justify-between overflow-hidden rounded-3xl border border-slate-100 bg-white p-7 shadow-[0_10px_35px_rgba(18,50,74,0.05)] transition-all duration-300 hover:-translate-y-1.5 hover:border-sky-200 hover:shadow-[0_20px_50px_rgba(18,50,74,0.10)] sm:w-[calc(50%-0.625rem)] sm:p-8 lg:w-[calc(33.333%-0.834rem)]">
                            
                            {{-- Decorative quotation watermark --}}
                            <div class="pointer-events-none absolute right-6 top-5 select-none font-serif text-6xl text-slate-100 transition-colors duration-300 group-hover:text-sky-100/70">&ldquo;</div>

                            <div class="relative">
                                <div class="flex items-center justify-between gap-3">
                                    <div class="flex items-center gap-1 text-sm text-amber-400" aria-label="{{ number_format($rating, 1) }} out of 5 stars">
                                        @for ($star = 1; $star <= 5; $star++)
                                            @if ($rating >= $star)
                                                <i class="ri-star-fill"></i>
                                            @elseif ($rating >= $star - 0.5)
                                                <i class="ri-star-half-fill"></i>
                                            @else
                                                <i class="ri-star-line text-slate-200"></i>
                                            @endif
                                        @endfor
                                    </div>

                                    <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-slate-400">
                                        <img src="{{ asset('google-img.png') }}"
                                             alt=""
                                             class="h-4 w-4"
                                             loading="lazy"
                                             decoding="async">
                                        Google
                                    </span>
                                </div>

                                <p class="relative z-10 mt-5 flex-1 line-clamp-6 text-sm leading-relaxed text-slate-600">
                                    &ldquo;{{ $review->review_text }}&rdquo;
                                </p>
                            </div>

                            <div class="relative z-10 mt-6 flex items-center gap-3 border-t border-slate-100 pt-5">
                                @if ($review->author_image)
                                    <img src="{{ $review->author_image }}"
                                         alt="{{ $authorName }}"
                                         loading="lazy"
                                         decoding="async"
                                         referrerpolicy="no-referrer"
                                         class="h-11 w-11 shrink-0 rounded-full object-cover ring-2 ring-slate-100">
                                @else
                                    <div class="grid h-11 w-11 shrink-0 place-items-center rounded-full bg-gradient-to-br from-sky-50 to-med-blue/15 text-sm font-bold text-med-navy ring-2 ring-slate-100">
                                        {{ mb_substr($authorName, 0, 1) }}
                                    </div>
                                @endif

                                <div class="min-w-0 flex-1">
                                    <p class="truncate text-sm font-bold text-med-navy">{{ $authorName }}</p>
                                </div>

                                @if ($review->review_link)
                                    <a href="{{ $review->review_link }}"
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       aria-label="Read {{ $authorName }}'s review on Google"
                                       class="grid h-8 w-8 place-items-center rounded-full bg-slate-50 text-slate-400 transition hover:bg-med-blue hover:text-white">
                                        <i class="ri-arrow-right-up-line text-sm"></i>
                                    </a>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>

                @if ($reviews->count() > 1)
                    <div class="mt-8 flex flex-wrap items-center justify-center gap-2">
                        <template x-for="index in total" :key="index">
                            <button
                                type="button"
                                @click="goTo(index - 1)"
                                :aria-label="`Show review ${index}`"
                                :aria-current="active === index - 1 ? 'true' : 'false'"
                                class="h-2 rounded-full transition-all duration-300 focus:outline-none"
                                :class="active === index - 1 ? 'w-8 bg-med-blue' : 'w-2 bg-slate-300 hover:bg-slate-400'">
                            </button>
                        </template>
                    </div>
                @endif
            @endif

            <p class="mt-6 text-center text-xs text-slate-400">
                Showing Google reviews rated 4.5 stars and above.
            </p>
        </div>
    </section>

    {{-- FAQ --}}
    @php($faqs = $this->faqs)

    <section id="faqs" class="scroll-mt-24 border-t border-slate-100 bg-[#FAFDFE] py-12 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-4xl px-5 sm:px-6 lg:px-8">
            <div class="text-center">
                <span class="text-xs font-bold uppercase tracking-widest text-med-blue">Before you visit MediDENT</span>
                <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-med-navy sm:text-4xl lg:text-5xl">
                    Frequently asked questions<span class="text-med-blue">.</span>
                </h2>

                <p class="mx-auto mt-4 max-w-2xl text-base leading-relaxed text-slate-600">
                    Quick answers about appointments, clinic timings, treatments, and visiting MediDENT Multicare Clinic.
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

            <div class="mt-8 flex flex-col items-stretch sm:items-center justify-between gap-4 rounded-3xl border border-sky-100 bg-gradient-to-r from-sky-50/80 via-white to-sky-50/60 p-6 text-center shadow-sm sm:flex-row sm:p-8 sm:text-left">
                <div>
                    <h4 class="text-base font-bold text-med-navy">Still have questions about your visit?</h4>
                    <p class="mt-1 text-sm text-slate-600">Our medical and dental staff will be glad to assist you.</p>
                </div>

                <a href="{{ route('contact') }}"
                   class="inline-flex w-full sm:w-auto shrink-0 items-center justify-center gap-2 rounded-full bg-med-navy px-6 py-3 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:-translate-y-0.5 hover:bg-med-blue hover:shadow-lg">
                    <span>Contact the Clinic</span>
                    <i class="ri-arrow-right-line"></i>
                </a>
            </div>
        </div>
    </section>

</div>
</div>