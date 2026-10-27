<div>
    <div class="overflow-hidden">


{{-- HERO SECTION --}}
<section class="relative overflow-hidden bg-[#f5fafc]">

    <div class="mx-auto grid max-w-7xl items-center gap-8 px-5 py-12 sm:gap-10 sm:px-6 sm:py-20 lg:grid-cols-[1.05fr_.95fr] lg:gap-16 lg:px-8 lg:py-24">

        {{-- Hero Content --}}
        <div>
            <div class="inline-flex max-w-full items-center gap-2 border border-sky-100 bg-white px-3 py-2 text-[10px] font-semibold uppercase tracking-[0.14em] text-med-blue sm:text-xs sm:tracking-[0.16em]">
                <i class="ri-hospital-line shrink-0 text-base"></i>
                MediDENT Clinic &middot; Ghaziabad
            </div>

            <h1 class="mt-5 max-w-2xl text-[2rem] font-bold leading-[1.15] tracking-tight text-med-navy sm:mt-6 sm:text-5xl lg:text-[3.5rem]">
                Welcome to
                <span class="text-med-blue">MediDENT Multicare Clinic</span>
                Ghaziabad
            </h1>

            <p class="mt-5 max-w-xl text-sm leading-7 text-slate-600 sm:mt-6 sm:text-base sm:leading-8">
                MediDENT Multicare Clinic provides medical, diabetes and dental care for patients of all ages. Our healthcare team works to deliver comprehensive services tailored to your individual needs.
            </p>

            <p class="mt-4 max-w-xl text-sm leading-7 text-slate-500 sm:text-base sm:leading-8">
                From general health check-ups and common illnesses to chronic condition management, vaccinations and preventive screenings, we offer a range of services to support your health and wellbeing.
            </p>

            {{-- Buttons --}}
            <div class="mt-7 flex flex-col gap-3 sm:flex-row">
                <button type="button"
                   @click="$dispatch('open-booking-modal')"
                   class="inline-flex w-full items-center justify-center gap-3 bg-med-blue px-5 py-3.5 text-sm font-semibold text-white transition hover:bg-sky-800 sm:w-auto sm:px-6">
                    Book an Appointment
                    <i class="ri-arrow-right-up-line text-lg"></i>
                </button>

                <a href="{{ route('about') }}"
                   class="inline-flex w-full items-center justify-center gap-2 border border-slate-300 bg-white px-5 py-3.5 text-sm font-semibold text-med-navy transition hover:border-med-blue hover:text-med-blue sm:w-auto sm:px-6">
                    About Our Clinic
                    <i class="ri-arrow-right-line"></i>
                </a>
            </div>

            {{-- Service Highlights --}}
            <div class="mt-8 grid grid-cols-1 gap-4 border-t border-slate-200 pt-6 sm:grid-cols-2 sm:gap-6">

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
                    class="h-[280px] w-full object-cover sm:h-[400px] lg:h-[470px]"
                >
            </div>

        
        </div>

    </div>
</section>


{{-- GENERAL PHYSICIAN CONSULTATION --}}
<section id="consultation"
    class="scroll-mt-24 border-y border-slate-100 bg-white py-12 sm:py-20 lg:py-24">

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

            <div class="flex flex-wrap items-center gap-x-5 gap-y-3">
                <a href="{{ route('services', ['category' => 'physician']) }}"
                   class="inline-flex w-fit shrink-0 items-center gap-2 border-b border-med-blue pb-1 text-sm font-semibold text-med-blue transition hover:text-sky-800">
                    View all medical services
                    <i class="ri-arrow-right-line"></i>
                </a>

                <button type="button"
                    @click="$dispatch('open-booking-modal')"
                    class="inline-flex w-fit shrink-0 items-center gap-2 border-b border-slate-300 pb-1 text-sm font-semibold text-slate-600 transition hover:border-med-blue hover:text-med-blue">
                    Book a Consultation
                    <i class="ri-arrow-right-line"></i>
                </button>
            </div>

        </div>

        {{-- Service cards --}}
        <div class="mt-8 grid gap-5 sm:mt-10 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($this->physicianServices as $service)
                <article
                    wire:key="home-physician-service-{{ $service['slug'] }}"
                    class="group flex h-full flex-col overflow-hidden border border-slate-200 bg-white transition duration-300 hover:-translate-y-1 {{ $service['hover'] }} hover:shadow-[0_16px_40px_rgba(18,50,74,0.08)]">

                    <div class="relative h-52 overflow-hidden bg-slate-100">
                        @if ($service['image'])
                            <img
                                src="{{ $service['image'] }}"
                                alt="{{ $service['alt'] }}"
                                loading="lazy"
                                class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                            >
                        @else
                            <span class="flex h-full w-full items-center justify-center bg-gradient-to-br from-sky-50 via-white to-slate-100">
                                <i class="{{ $service['icon'] }} text-5xl text-sky-200"></i>
                            </span>
                        @endif

                        <span class="absolute left-4 top-4 bg-white px-3 py-1.5 text-xs font-semibold {{ $service['accent'] }} shadow-sm">
                            {{ $service['tag'] }}
                        </span>
                    </div>

                    <div class="flex flex-1 flex-col p-6 sm:p-7">
                        <div class="flex items-start justify-between gap-3">
                            <h3 class="text-xl font-bold text-med-navy">
                                {{ $service['title'] }}
                            </h3>

                            <i class="{{ $service['icon'] }} text-2xl {{ $service['accent'] }}"></i>
                        </div>

                        <p class="mt-3 flex-1 text-sm leading-7 text-slate-600">
                            {{ $service['description'] }}
                        </p>

                        <a href="{{ route('services.show', $service['slug']) }}"
                            class="mt-6 inline-flex items-center gap-2 border-t border-slate-100 pt-4 text-sm font-semibold {{ $service['accent'] }}">
                            View Details
                            <i class="ri-arrow-right-line transition group-hover:translate-x-1"></i>
                        </a>
                    </div>
                </article>
            @empty
                <div class="border border-slate-200 bg-[#f8fbfd] px-6 py-12 text-center sm:col-span-2 lg:col-span-3">
                    <span class="mx-auto grid h-14 w-14 place-items-center bg-white text-2xl text-med-blue shadow-sm">
                        <i class="ri-stethoscope-line"></i>
                    </span>

                    <h3 class="mt-4 text-lg font-bold text-med-navy">Medical service information is being updated.</h3>
                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                        Contact the clinic to ask about available consultations or book an appointment.
                    </p>
                </div>
            @endforelse
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

            <a href="{{ route('contact') }}"
                class="inline-flex w-full shrink-0 items-center justify-center gap-2 bg-med-blue px-5 py-3 text-sm font-semibold text-white transition hover:bg-sky-800 sm:w-auto">
                Contact the Clinic
                <i class="ri-arrow-right-up-line"></i>
            </a>
        </div>

    </div>
</section>



    {{-- SERVICES --}}
    <section id="services" class="scroll-mt-24 py-12 sm:py-20 lg:py-24">
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

                <button type="button"
                    @click="$dispatch('open-booking-modal')"
                    class="inline-flex w-fit items-center gap-2 border-b border-med-blue pb-1 text-sm font-semibold text-med-blue hover:text-sky-800">
                    Book a Consultation <i class="ri-arrow-right-line"></i>
                </button>
            </div>

            <div class="mt-8 grid gap-5 sm:mt-10 md:grid-cols-3">

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

                    <a href="{{ route('services', ['category' => 'physician']) }}"
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

                    <a href="{{ route('services') }}"
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

                    <a href="{{ route('services', ['category' => 'dental']) }}"
                        class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-cyan-700">
                        Learn More <i class="ri-arrow-right-line transition group-hover:translate-x-1"></i>
                    </a>
                </article>

            </div>
        </div>
    </section>

    <section id="dental-services" class="scroll-mt-24 border-t border-slate-100 py-12 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

            <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                <div class="max-w-2xl">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-red">
                        Dental Services
                    </p>

                    <h2 class="mt-3 text-3xl font-bold tracking-tight text-med-navy sm:text-4xl">
                        Complete care for every smile.
                    </h2>

                    <p class="mt-4 max-w-xl leading-7 text-slate-600">
                        From preventive check-ups to restorative treatments, our dental services are designed to keep your smile healthy and comfortable.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-x-5 gap-y-3">
                    <a href="{{ route('services', ['category' => 'dental']) }}"
                       class="inline-flex w-fit items-center gap-2 border-b border-cyan-700 pb-1 text-sm font-semibold text-cyan-700 hover:text-cyan-900">
                        View all dental services <i class="ri-arrow-right-line"></i>
                    </a>

                    <button type="button"
                        @click="$dispatch('open-booking-modal')"
                        class="inline-flex w-fit items-center gap-2 border-b border-slate-300 pb-1 text-sm font-semibold text-slate-600 hover:border-med-blue hover:text-med-blue">
                        Book a Dental Visit <i class="ri-arrow-right-line"></i>
                    </button>
                </div>
            </div>

            <div class="mt-8 grid gap-5 sm:mt-10 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($this->dentalServices as $service)
                    <article
                        wire:key="home-dental-service-{{ $service['slug'] }}"
                        class="group flex h-full flex-col overflow-hidden border border-slate-200 bg-white transition duration-300 hover:-translate-y-1 {{ $service['hover'] }} hover:shadow-[0_16px_40px_rgba(18,50,74,0.08)]">
                        <div class="relative h-52 overflow-hidden bg-slate-100">
                            @if ($service['image'])
                                <img
                                    src="{{ $service['image'] }}"
                                    alt="{{ $service['alt'] }}"
                                    loading="lazy"
                                    class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                >
                            @else
                                <span class="flex h-full w-full items-center justify-center bg-gradient-to-br from-cyan-50 via-white to-slate-100">
                                    <i class="{{ $service['icon'] }} text-5xl text-cyan-200"></i>
                                </span>
                            @endif

                            <span class="absolute left-4 top-4 bg-white px-3 py-1.5 text-xs font-semibold {{ $service['accent'] }} shadow-sm">
                                {{ $service['tag'] }}
                            </span>
                        </div>

                        <div class="flex flex-1 flex-col p-6 sm:p-7">
                            <div class="flex items-start justify-between gap-3">
                                <h3 class="text-xl font-bold text-med-navy">
                                    {{ $service['title'] }}
                                </h3>

                                <i class="{{ $service['icon'] }} text-2xl {{ $service['accent'] }}"></i>
                            </div>

                            <p class="mt-3 flex-1 text-sm leading-7 text-slate-600">
                                {{ $service['description'] }}
                            </p>

                            <a href="{{ route('services.show', $service['slug']) }}"
                                class="mt-6 inline-flex items-center gap-2 border-t border-slate-100 pt-4 text-sm font-semibold {{ $service['accent'] }}">
                                View Details
                                <i class="ri-arrow-right-line transition group-hover:translate-x-1"></i>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="border border-slate-200 bg-[#f8fbfd] px-6 py-12 text-center sm:col-span-2 lg:col-span-3">
                        <span class="mx-auto grid h-14 w-14 place-items-center bg-white text-2xl text-cyan-700 shadow-sm">
                            <i class="ri-tooth-line"></i>
                        </span>

                        <h3 class="mt-4 text-lg font-bold text-med-navy">Dental service information is being updated.</h3>
                        <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                            Contact the clinic to ask about available dental treatments or book a consultation.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>


    {{-- ABOUT --}}
    <section id="about" class="scroll-mt-24 border-y border-slate-100 bg-[#f5fafc] py-12 sm:py-20 lg:py-24">
        <div class="mx-auto grid max-w-7xl items-center gap-8 px-5 sm:gap-12 sm:px-6 lg:grid-cols-2 lg:gap-16 lg:px-8">

            <div class="relative">
                <img
                    src="{{ asset('images/photo-1576091160399-112ba8d25d1d.avif') }}"
                    alt="Healthcare professional consulting a patient"
                    loading="lazy"
                    class="h-[280px] w-full object-cover sm:h-[430px]">

              
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

                <a href="{{ route('contact') }}"
                    class="mt-8 inline-flex w-full items-center justify-center gap-3 bg-med-navy px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-slate-800 sm:w-auto sm:justify-start">
                    Get in Touch <i class="ri-arrow-right-up-line text-lg"></i>
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