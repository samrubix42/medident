<div>
    <div class="overflow-hidden">


{{-- HERO SECTION --}}
<section class="relative overflow-hidden bg-gradient-to-br from-[#f5fafc] via-white to-[#f8fbfd]">

    <div class="absolute -left-40 top-20 h-80 w-80 rounded-full bg-med-blue/5 blur-3xl"></div>
    <div class="absolute -right-40 bottom-10 h-96 w-96 rounded-full bg-cyan-400/5 blur-3xl"></div>

    <div class="relative mx-auto grid max-w-7xl items-center gap-10 px-5 py-14 sm:gap-12 sm:px-6 sm:py-20 lg:grid-cols-[1.05fr_.95fr] lg:gap-16 lg:px-8 lg:py-28">

        {{-- Hero Content --}}
        <div>
            <div class="inline-flex max-w-full items-center gap-2 rounded-full border border-sky-100 bg-white px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.16em] text-med-blue shadow-sm">
                <i class="ri-hospital-line shrink-0 text-base"></i>
                MediDENT Clinic &middot; Ghaziabad
            </div>

            <h1 class="mt-6 max-w-2xl text-4xl font-bold leading-[1.12] tracking-tight text-med-navy sm:mt-8 sm:text-5xl lg:text-[3.75rem]">
                Welcome to
                <span class="bg-gradient-to-r from-med-blue to-cyan-600 bg-clip-text text-transparent">MediDENT Multicare Clinic</span>
                <br class="hidden sm:block">Ghaziabad
            </h1>

            <p class="mt-6 max-w-xl text-base leading-8 text-slate-600 sm:text-lg sm:leading-9">
                MediDENT Multicare Clinic provides medical, diabetes and dental care for patients of all ages. Our healthcare team works to deliver comprehensive services tailored to your individual needs.
            </p>

            <p class="mt-4 max-w-xl text-sm leading-7 text-slate-500 sm:text-base sm:leading-8">
                From general health check-ups and common illnesses to chronic condition management, vaccinations and preventive screenings, we offer a range of services to support your health and wellbeing.
            </p>

            {{-- Buttons --}}
            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                <button type="button"
                   @click="$dispatch('open-booking-modal')"
                   class="group inline-flex w-full items-center justify-center gap-3 rounded-full bg-gradient-to-r from-med-blue to-sky-600 px-7 py-3.5 text-sm font-semibold text-white shadow-lg shadow-med-blue/25 transition-all hover:-translate-y-0.5 hover:shadow-xl hover:shadow-med-blue/35 sm:w-auto sm:px-8">
                    Book an Appointment
                    <i class="ri-arrow-right-up-line text-lg transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5"></i>
                </button>

                <a href="{{ route('about') }}"
                   class="inline-flex w-full items-center justify-center gap-2 rounded-full border border-slate-200 bg-white px-7 py-3.5 text-sm font-semibold text-med-navy shadow-sm transition-all hover:-translate-y-0.5 hover:border-med-blue hover:text-med-blue hover:shadow-md sm:w-auto sm:px-8">
                    About Our Clinic
                    <i class="ri-arrow-right-line"></i>
                </a>
            </div>

            {{-- Service Highlights --}}
            <div class="mt-10 grid grid-cols-1 gap-4 rounded-2xl border border-slate-100 bg-white/80 p-6 shadow-sm backdrop-blur-sm sm:grid-cols-2 sm:gap-6">

                <div class="group flex items-start gap-4">
                    <div class="grid h-12 w-12 shrink-0 place-items-center rounded-xl bg-gradient-to-br from-sky-50 to-sky-100/50 text-xl text-med-blue transition group-hover:scale-105">
                        <i class="ri-stethoscope-line"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-med-navy">Medical Care</p>
                        <p class="mt-1 text-xs leading-5 text-slate-500">
                            General health and consultations
                        </p>
                    </div>
                </div>

                <div class="group flex items-start gap-4">
                    <div class="grid h-12 w-12 shrink-0 place-items-center rounded-xl bg-gradient-to-br from-red-50 to-red-100/50 text-xl text-med-red transition group-hover:scale-105">
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
            <div class="absolute -right-4 -top-4 h-28 w-28 rounded-full bg-gradient-to-br from-med-blue/10 to-transparent sm:-right-6 sm:-top-6 sm:h-36 sm:w-36"></div>
            <div class="absolute -bottom-6 -left-6 h-32 w-32 rounded-full bg-cyan-400/10 blur-2xl"></div>

            <div class="relative overflow-hidden rounded-3xl border-[6px] border-white bg-white shadow-[0_40px_80px_rgba(18,50,74,0.16)]">
                <img
                    src="{{ asset('images/hero-img.jpg') }}"
                    alt="MediDENT Multicare Clinic"
                    fetchpriority="high"
                    class="h-[320px] w-full object-cover sm:h-[440px] lg:h-[520px]"
                >
                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-med-navy/40 to-transparent p-6">
                    <p class="text-sm font-medium text-white">Compassionate care. Trusted results.</p>
                </div>
            </div>

        
        </div>

    </div>
</section>


{{-- GENERAL PHYSICIAN CONSULTATION --}}
<section id="consultation"
    class="scroll-mt-24 border-y border-slate-100 bg-white py-12 sm:py-16 lg:py-24">

    <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

        {{-- Section heading --}}
        <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">

            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 rounded-full bg-med-red/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.2em] text-med-red">
                    <i class="ri-stethoscope-line"></i>
                    General Healthcare
                </div>

                <h2 class="mt-5 text-3xl font-bold leading-tight tracking-tight text-med-navy sm:text-4xl lg:text-5xl">
                    General Physician Consultation
                </h2>

                <p class="mt-4 max-w-xl text-sm leading-7 text-slate-600 sm:text-base">
                    Expert medical guidance for common illnesses, ongoing health concerns, preventive care and your family's wellbeing.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('services', ['category' => 'physician']) }}"
                   class="group inline-flex w-fit shrink-0 items-center gap-2 rounded-full border border-med-blue/20 bg-med-blue/5 px-6 py-2.5 text-sm font-semibold text-med-blue transition-all hover:-translate-y-0.5 hover:bg-med-blue/10">
                    View all medical services
                    <i class="ri-arrow-right-line transition-transform group-hover:translate-x-1"></i>
                </a>

                <button type="button"
                    @click="$dispatch('open-booking-modal')"
                    class="group inline-flex w-fit shrink-0 items-center gap-2 rounded-full border border-slate-200 px-6 py-2.5 text-sm font-semibold text-slate-700 transition-all hover:-translate-y-0.5 hover:border-med-blue hover:text-med-blue">
                    Book a Consultation
                    <i class="ri-arrow-right-line transition-transform group-hover:translate-x-1"></i>
                </button>
            </div>

        </div>

        {{-- Service cards --}}
        <div class="mt-10 grid gap-6 sm:mt-12 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($this->physicianServices as $service)
                <article
                    wire:key="home-physician-service-{{ $service['slug'] }}"
                    class="group flex h-full flex-col overflow-hidden rounded-2xl border border-slate-100 bg-white transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_25px_60px_rgba(18,50,74,0.12)]">

                    <div class="relative h-52 overflow-hidden">
                        @if ($service['image'])
                            <img
                                src="{{ $service['image'] }}"
                                alt="{{ $service['alt'] }}"
                                loading="lazy"
                                class="h-full w-full object-cover transition duration-700 group-hover:scale-110"
                            >
                        @else
                            <span class="flex h-full w-full items-center justify-center bg-gradient-to-br from-sky-50 via-white to-slate-50">
                                <i class="{{ $service['icon'] }} text-6xl text-sky-200"></i>
                            </span>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-med-navy/20 to-transparent"></div>

                        <span class="absolute left-4 top-4 rounded-full bg-white/95 px-3 py-1.5 text-xs font-semibold {{ $service['accent'] }} shadow-sm backdrop-blur-sm">
                            {{ $service['tag'] }}
                        </span>
                    </div>

                    <div class="flex flex-1 flex-col p-6 sm:p-7">
                        <div class="flex items-start justify-between gap-3">
                            <h3 class="text-xl font-bold text-med-navy">
                                {{ $service['title'] }}
                            </h3>

                            <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-slate-50 {{ $service['accent'] }} transition group-hover:scale-105">
                                <i class="{{ $service['icon'] }} text-xl"></i>
                            </span>
                        </div>

                        <p class="mt-3 flex-1 text-sm leading-7 text-slate-600">
                            {{ $service['description'] }}
                        </p>

                        <a href="{{ route('services.show', $service['slug']) }}"
                            class="group/btn mt-6 inline-flex items-center gap-2 border-t border-slate-100 pt-4 text-sm font-semibold {{ $service['accent'] }}">
                            View Details
                            <i class="ri-arrow-right-line transition-transform group-hover/btn:translate-x-1"></i>
                        </a>
                    </div>
                </article>
            @empty
                <div class="rounded-2xl border border-slate-100 bg-gradient-to-br from-[#f8fbfd] to-white px-6 py-12 text-center sm:col-span-2 lg:col-span-3">
                    <span class="mx-auto grid h-16 w-16 place-items-center rounded-2xl bg-white text-2xl text-med-blue shadow-sm">
                        <i class="ri-stethoscope-line"></i>
                    </span>

                    <h3 class="mt-5 text-lg font-bold text-med-navy">Medical service information is being updated.</h3>
                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                        Contact the clinic to ask about available consultations or book an appointment.
                    </p>
                </div>
            @endforelse
        </div>

        {{-- Bottom CTA --}}
        <div class="mt-12 flex flex-col gap-6 rounded-2xl border border-slate-100 bg-gradient-to-br from-[#f8fbfd] to-white p-6 shadow-sm sm:flex-row sm:items-center sm:justify-between sm:p-8 lg:p-10">
            <div class="max-w-xl">
                <h3 class="text-xl font-bold text-med-navy">
                    Need help choosing the right consultation?
                </h3>

                <p class="mt-2 text-sm leading-6 text-slate-600">
                    Contact our clinic to discuss your concerns and available services. Our team will guide you to the right care.
                </p>
            </div>

            <a href="{{ route('contact') }}"
                class="group inline-flex w-full shrink-0 items-center justify-center gap-2 rounded-full bg-gradient-to-r from-med-blue to-sky-600 px-7 py-3.5 text-sm font-semibold text-white shadow-lg shadow-med-blue/25 transition-all hover:-translate-y-0.5 hover:shadow-xl hover:shadow-med-blue/35 sm:w-auto">
                Contact the Clinic
                <i class="ri-arrow-right-up-line transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5"></i>
            </a>
        </div>

    </div>
</section>



    {{-- SERVICES --}}
    <section id="services" class="scroll-mt-24 py-12 sm:py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

            <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
                <div class="max-w-2xl">
                    <div class="inline-flex items-center gap-2 rounded-full bg-med-blue/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.2em] text-med-blue">
                        <i class="ri-hospital-line"></i>
                        Our Healthcare Services
                    </div>

                    <h2 class="mt-5 text-3xl font-bold tracking-tight text-med-navy sm:text-4xl lg:text-5xl">
                        Complete care. One trusted clinic.
                    </h2>

                    <p class="mt-4 max-w-xl leading-7 text-slate-600 sm:text-base">
                        Focused care for your everyday health, long-term wellbeing and confident smile under one roof.
                    </p>
                </div>

                <button type="button"
                    @click="$dispatch('open-booking-modal')"
                    class="group inline-flex w-fit items-center gap-2 rounded-full border border-med-blue/20 bg-med-blue/5 px-6 py-2.5 text-sm font-semibold text-med-blue transition-all hover:-translate-y-0.5 hover:bg-med-blue/10">
                    Book a Consultation <i class="ri-arrow-right-line transition-transform group-hover:translate-x-1"></i>
                </button>
            </div>

            <div class="mt-10 grid gap-6 sm:mt-12 md:grid-cols-3">

                {{-- Medical --}}
                <article class="group relative overflow-hidden rounded-2xl border border-slate-100 bg-white p-7 transition-all hover:-translate-y-2 hover:shadow-[0_25px_60px_rgba(18,50,74,0.12)] sm:p-8">
                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-sky-50/50 transition group-hover:scale-150"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between">
                            <div class="grid h-16 w-16 place-items-center rounded-2xl bg-gradient-to-br from-sky-50 to-sky-100/50 text-2xl text-med-blue transition group-hover:scale-110">
                                <i class="ri-stethoscope-line"></i>
                            </div>

                            <span class="grid h-10 w-10 place-items-center rounded-full border border-slate-200 text-xl text-slate-400 transition group-hover:border-med-blue group-hover:text-med-blue">
                                <i class="ri-arrow-up-right-line"></i>
                            </span>
                        </div>

                        <h3 class="mt-8 text-xl font-bold text-med-navy">Medical Care</h3>

                        <p class="mt-3 text-sm leading-7 text-slate-600">
                            Medical consultations and guidance for everyday health concerns and your family's general healthcare needs.
                        </p>

                        <a href="{{ route('services', ['category' => 'physician']) }}"
                            class="group/link mt-6 inline-flex items-center gap-2 text-sm font-semibold text-med-blue">
                            Learn More <i class="ri-arrow-right-line transition-transform group-hover/link:translate-x-1"></i>
                        </a>
                    </div>
                </article>

                {{-- Diabetes --}}
                <article class="group relative overflow-hidden rounded-2xl border border-slate-100 bg-white p-7 transition-all hover:-translate-y-2 hover:shadow-[0_25px_60px_rgba(18,50,74,0.12)] sm:p-8">
                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-red-50/50 transition group-hover:scale-150"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between">
                            <div class="grid h-16 w-16 place-items-center rounded-2xl bg-gradient-to-br from-red-50 to-red-100/50 text-2xl text-med-red transition group-hover:scale-110">
                                <i class="ri-heart-pulse-line"></i>
                            </div>

                            <span class="grid h-10 w-10 place-items-center rounded-full border border-slate-200 text-xl text-slate-400 transition group-hover:border-med-red group-hover:text-med-red">
                                <i class="ri-arrow-up-right-line"></i>
                            </span>
                        </div>

                        <h3 class="mt-8 text-xl font-bold text-med-navy">Diabetes Care</h3>

                        <p class="mt-3 text-sm leading-7 text-slate-600">
                            Support with diabetes monitoring, ongoing management and guidance to help you care for your health effectively.
                        </p>

                        <a href="{{ route('services') }}"
                            class="group/link mt-6 inline-flex items-center gap-2 text-sm font-semibold text-med-red">
                            Learn More <i class="ri-arrow-right-line transition-transform group-hover/link:translate-x-1"></i>
                        </a>
                    </div>
                </article>

                {{-- Dental --}}
                <article class="group relative overflow-hidden rounded-2xl border border-slate-100 bg-white p-7 transition-all hover:-translate-y-2 hover:shadow-[0_25px_60px_rgba(18,50,74,0.12)] sm:p-8">
                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-cyan-50/50 transition group-hover:scale-150"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between">
                            <div class="grid h-16 w-16 place-items-center rounded-2xl bg-gradient-to-br from-cyan-50 to-cyan-100/50 text-2xl text-cyan-700 transition group-hover:scale-110">
                                <i class="ri-tooth-line"></i>
                            </div>

                            <span class="grid h-10 w-10 place-items-center rounded-full border border-slate-200 text-xl text-slate-400 transition group-hover:border-cyan-700 group-hover:text-cyan-700">
                                <i class="ri-arrow-up-right-line"></i>
                            </span>
                        </div>

                        <h3 class="mt-8 text-xl font-bold text-med-navy">Dental Care</h3>

                        <p class="mt-3 text-sm leading-7 text-slate-600">
                            Oral health consultations, preventive dental care and treatment options to help maintain a healthy, confident smile.
                        </p>

                        <a href="{{ route('services', ['category' => 'dental']) }}"
                            class="group/link mt-6 inline-flex items-center gap-2 text-sm font-semibold text-cyan-700">
                            Learn More <i class="ri-arrow-right-line transition-transform group-hover/link:translate-x-1"></i>
                        </a>
                    </div>
                </article>

            </div>
        </div>
    </section>

    <section id="dental-services" class="scroll-mt-24 border-t border-slate-100 bg-gradient-to-b from-white to-slate-50/30 py-12 sm:py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

            <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
                <div class="max-w-2xl">
                    <div class="inline-flex items-center gap-2 rounded-full bg-cyan-50 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.2em] text-cyan-700">
                        <i class="ri-tooth-line"></i>
                        Dental Services
                    </div>

                    <h2 class="mt-5 text-3xl font-bold tracking-tight text-med-navy sm:text-4xl lg:text-5xl">
                        Complete care for every smile.
                    </h2>

                    <p class="mt-4 max-w-xl leading-7 text-slate-600 sm:text-base">
                        From preventive check-ups to restorative treatments, our dental services are designed to keep your smile healthy and comfortable.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <a href="{{ route('services', ['category' => 'dental']) }}"
                       class="group inline-flex w-fit items-center gap-2 rounded-full border border-cyan-700/20 bg-cyan-50 px-6 py-2.5 text-sm font-semibold text-cyan-700 transition-all hover:-translate-y-0.5 hover:bg-cyan-100/70">
                        View all dental services <i class="ri-arrow-right-line transition-transform group-hover:translate-x-1"></i>
                    </a>

                    <button type="button"
                        @click="$dispatch('open-booking-modal')"
                        class="group inline-flex w-fit items-center gap-2 rounded-full border border-slate-200 px-6 py-2.5 text-sm font-semibold text-slate-700 transition-all hover:-translate-y-0.5 hover:border-med-blue hover:text-med-blue">
                        Book a Dental Visit <i class="ri-arrow-right-line transition-transform group-hover:translate-x-1"></i>
                    </button>
                </div>
            </div>

            <div class="mt-10 grid gap-6 sm:mt-12 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($this->dentalServices as $service)
                    <article
                        wire:key="home-dental-service-{{ $service['slug'] }}"
                        class="group flex h-full flex-col overflow-hidden rounded-2xl border border-slate-100 bg-white transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_25px_60px_rgba(18,50,74,0.12)]">
                        <div class="relative h-52 overflow-hidden">
                            @if ($service['image'])
                                <img
                                    src="{{ $service['image'] }}"
                                    alt="{{ $service['alt'] }}"
                                    loading="lazy"
                                    class="h-full w-full object-cover transition duration-700 group-hover:scale-110"
                                >
                            @else
                                <span class="flex h-full w-full items-center justify-center bg-gradient-to-br from-cyan-50 via-white to-slate-50">
                                    <i class="{{ $service['icon'] }} text-6xl text-cyan-200"></i>
                                </span>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-med-navy/20 to-transparent"></div>

                            <span class="absolute left-4 top-4 rounded-full bg-white/95 px-3 py-1.5 text-xs font-semibold {{ $service['accent'] }} shadow-sm backdrop-blur-sm">
                                {{ $service['tag'] }}
                            </span>
                        </div>

                        <div class="flex flex-1 flex-col p-6 sm:p-7">
                            <div class="flex items-start justify-between gap-3">
                                <h3 class="text-xl font-bold text-med-navy">
                                    {{ $service['title'] }}
                                </h3>

                                <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-slate-50 {{ $service['accent'] }} transition group-hover:scale-105">
                                    <i class="{{ $service['icon'] }} text-xl"></i>
                                </span>
                            </div>

                            <p class="mt-3 flex-1 text-sm leading-7 text-slate-600">
                                {{ $service['description'] }}
                            </p>

                            <a href="{{ route('services.show', $service['slug']) }}"
                                class="group/btn mt-6 inline-flex items-center gap-2 border-t border-slate-100 pt-4 text-sm font-semibold {{ $service['accent'] }}">
                                View Details
                                <i class="ri-arrow-right-line transition-transform group-hover/btn:translate-x-1"></i>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="rounded-2xl border border-slate-100 bg-gradient-to-br from-[#f8fbfd] to-white px-6 py-12 text-center sm:col-span-2 lg:col-span-3">
                        <span class="mx-auto grid h-16 w-16 place-items-center rounded-2xl bg-white text-2xl text-cyan-700 shadow-sm">
                            <i class="ri-tooth-line"></i>
                        </span>

                        <h3 class="mt-5 text-lg font-bold text-med-navy">Dental service information is being updated.</h3>
                        <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
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
                <div class="inline-flex items-center gap-2 rounded-full bg-med-red/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.2em] text-med-red">
                    <i class="ri-hospital-line"></i>
                    About MediDENT
                </div>

                <h2 class="mt-5 text-3xl font-bold leading-tight tracking-tight text-med-navy sm:text-4xl lg:text-5xl">
                    Healthcare should feel personal, not complicated.
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
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-red">
                        Google Reviews
                    </p>

                    <h2 class="mt-3 text-3xl font-bold tracking-tight text-med-navy sm:text-4xl">
                        What our patients say.
                    </h2>

                    <p class="mt-4 leading-7 text-slate-600">
                        Read genuine feedback from patients who visited MediDENT Multicare Clinic.
                    </p>

                    @if ($googleReviewsUrl)
                        <a href="{{ $googleReviewsUrl }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-med-blue transition hover:text-sky-800">
                            <img src="{{ asset('google-img.png') }}"
                                 alt=""
                                 class="h-4 w-4"
                                 decoding="async">
                            View all Google reviews
                            <i class="ri-arrow-right-up-line"></i>
                        </a>
                    @endif
                </div>

                @if ($reviews->count() > 1)
                    <div class="flex gap-2">
                        <button
                            type="button"
                            @click="prev()"
                            aria-label="Previous review"
                            class="grid h-11 w-11 place-items-center border border-slate-300 text-xl text-med-navy transition hover:border-med-blue hover:text-med-blue">
                            <i class="ri-arrow-left-line"></i>
                        </button>

                        <button
                            type="button"
                            @click="next()"
                            aria-label="Next review"
                            class="grid h-11 w-11 place-items-center bg-med-blue text-xl text-white transition hover:bg-sky-800">
                            <i class="ri-arrow-right-line"></i>
                        </button>
                    </div>
                @endif
            </div>

            @if ($reviews->isEmpty())
                <div class="mt-9 border border-slate-200 bg-white p-8 text-center">
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
                     class="mt-8 flex snap-x snap-mandatory gap-5 overflow-x-auto scroll-smooth pb-3 sm:mt-9 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                    @foreach ($reviews as $review)
                        @php($authorName = $review->author_title ?: 'Google user')
                        @php($rating = (float) $review->review_rating)

                        <article
                            role="group"
                            aria-roledescription="slide"
                            aria-label="Review {{ $loop->iteration }} of {{ $reviews->count() }}"
                            class="flex w-[86%] shrink-0 snap-start flex-col border border-slate-200 bg-white p-6 shadow-sm transition hover:border-sky-200 hover:shadow-md sm:w-[calc(50%-0.625rem)] sm:p-7 lg:w-[calc(33.333%-0.834rem)]">
                            <div class="flex items-start justify-between gap-3">
                                <div class="flex items-center gap-1 text-amber-500" aria-label="{{ number_format($rating, 1) }} out of 5 stars">
                                    @for ($star = 1; $star <= 5; $star++)
                                        @if ($rating >= $star)
                                            <i class="ri-star-fill"></i>
                                        @elseif ($rating >= $star - 0.5)
                                            <i class="ri-star-half-fill"></i>
                                        @else
                                            <i class="ri-star-line"></i>
                                        @endif
                                    @endfor
                                </div>

                                <span class="inline-flex items-center gap-1 text-[11px] font-semibold uppercase tracking-[0.1em] text-slate-400">
                                    <img src="{{ asset('google-img.png') }}"
                                         alt=""
                                         class="h-4 w-4"
                                         loading="lazy"
                                         decoding="async">
                                    Google
                                </span>
                            </div>

                            <p class="mt-5 flex-1 line-clamp-6 text-sm leading-7 text-slate-600">
                                {{ $review->review_text }}
                            </p>

                            <div class="mt-6 flex items-center gap-3 border-t border-slate-100 pt-5">
                                @if ($review->author_image)
                                    <img src="{{ $review->author_image }}"
                                         alt="{{ $authorName }}"
                                         loading="lazy"
                                         decoding="async"
                                         referrerpolicy="no-referrer"
                                         class="h-10 w-10 shrink-0 rounded-full object-cover">
                                @else
                                    <div class="grid h-10 w-10 shrink-0 place-items-center rounded-full bg-sky-50 text-sm font-bold text-med-blue">
                                        {{ mb_substr($authorName, 0, 1) }}
                                    </div>
                                @endif

                                <div class="min-w-0">
                                    <p class="truncate text-sm font-bold text-med-navy">{{ $authorName }}</p>
                                    <p class="mt-0.5 text-xs text-slate-500">
                                        {{ $review->review_datetime_utc?->format('M j, Y') ?? 'Google review' }}
                                    </p>
                                </div>

                                @if ($review->review_link)
                                    <a href="{{ $review->review_link }}"
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       aria-label="Read {{ $authorName }}'s review on Google"
                                       class="ml-auto inline-flex shrink-0 items-center gap-1 text-xs font-semibold text-med-blue transition hover:text-sky-800">
                                        Read
                                        <i class="ri-arrow-right-up-line"></i>
                                    </a>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>

                @if ($reviews->count() > 1)
                    <div class="mt-6 flex flex-wrap items-center justify-center gap-2">
                        <template x-for="index in total" :key="index">
                            <button
                                type="button"
                                @click="goTo(index - 1)"
                                :aria-label="`Show review ${index}`"
                                :aria-current="active === index - 1 ? 'true' : 'false'"
                                class="h-2.5 rounded-full transition-all duration-300"
                                :class="active === index - 1 ? 'w-8 bg-med-blue' : 'w-2.5 bg-slate-300 hover:bg-slate-400'">
                            </button>
                        </template>
                    </div>
                @endif
            @endif

            <p class="mt-4 text-center text-xs text-slate-400">
                Showing Google reviews rated 4.5 stars and above.
            </p>
        </div>
    </section>

    {{-- FAQ --}}
    @php($faqs = $this->faqs)

    <section id="faqs" class="scroll-mt-24 border-t border-slate-100 bg-[#f5fafc] py-12 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-4xl px-5 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-red">
                    Frequently asked questions
                </p>

                <h2 class="mt-3 text-3xl font-bold tracking-tight text-med-navy sm:text-4xl">
                    Before you visit MediDENT
                </h2>

                <p class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-slate-600 sm:text-base">
                    Quick answers about appointments, clinic timings, services, and what to expect at your visit.
                </p>
            </div>

            <div class="mt-8 divide-y divide-slate-200 border border-slate-200 bg-white">
                @foreach ($faqs as $faq)
                    <details class="group p-5 sm:p-6">
                        <summary class="flex cursor-pointer list-none items-start justify-between gap-4 text-left">
                            <h3 class="text-sm font-semibold leading-6 text-med-navy sm:text-base">
                                {{ $faq['question'] }}
                            </h3>

                            <i class="ri-add-line mt-0.5 text-xl text-med-blue transition group-open:rotate-45"></i>
                        </summary>

                        <p class="mt-3 max-w-3xl text-sm leading-7 text-slate-600">
                            {{ $faq['answer'] }}
                        </p>
                    </details>
                @endforeach
            </div>

            <div class="mt-6 flex flex-col items-center justify-between gap-3 border border-sky-100 bg-white px-5 py-4 text-center sm:flex-row sm:text-left">
                <p class="text-sm text-slate-600">
                    Still have a question about your care?
                </p>

                <a href="{{ route('contact') }}"
                   class="inline-flex items-center gap-2 text-sm font-semibold text-med-blue transition hover:text-sky-800">
                    Contact the clinic
                    <i class="ri-arrow-right-line"></i>
                </a>
            </div>
        </div>
    </section>

</div>
</div>