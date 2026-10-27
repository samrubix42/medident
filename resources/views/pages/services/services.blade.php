<div>
    {{-- Hero --}}
    <section class="relative overflow-hidden border-b border-slate-100 bg-[#f5fafc]">
        <div class="pointer-events-none absolute -right-24 -top-24 h-80 w-80 rounded-full border-[46px] border-sky-100/70"></div>
        <div class="pointer-events-none absolute -bottom-28 left-1/4 h-64 w-64 rounded-full border-[34px] border-white"></div>

        <div class="relative mx-auto max-w-7xl px-5 py-12 sm:px-6 sm:py-20 lg:px-8 lg:py-24">
            <nav class="flex flex-wrap items-center gap-2 text-xs text-slate-400" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="transition hover:text-med-blue">Home</a>
                <i class="ri-arrow-right-s-line text-sm"></i>
                <span class="text-slate-500">Services</span>
            </nav>

            <div class="mt-6 inline-flex max-w-full items-center gap-2 border border-sky-100 bg-white px-3 py-2 text-[10px] font-semibold uppercase tracking-[0.14em] text-med-blue sm:text-xs sm:tracking-[0.16em]">
                <i class="ri-stethoscope-line shrink-0 text-base"></i>
                Medical &amp; Dental Care
            </div>

            <h1 class="mt-5 max-w-4xl text-[2rem] font-bold leading-[1.15] tracking-tight text-med-navy sm:mt-6 sm:text-5xl lg:text-[3.5rem]">
                Complete care for your health and
                <span class="text-med-blue">your smile.</span>
            </h1>

            <p class="mt-5 max-w-2xl text-sm leading-7 text-slate-600 sm:mt-6 sm:text-base sm:leading-8">
                Explore our medical, preventive, and dental services. Each treatment is delivered with clear guidance, careful assessment, and a plan tailored to your needs.
            </p>

            <div class="mt-7 flex flex-col gap-3 sm:flex-row">
                <button type="button"
                        @click="$dispatch('open-booking-modal')"
                        class="inline-flex w-full items-center justify-center gap-2 bg-med-blue px-5 py-3.5 text-sm font-semibold text-white transition hover:bg-sky-800 sm:w-auto sm:px-6">
                    Book an Appointment
                    <i class="ri-arrow-right-up-line text-lg"></i>
                </button>

                <a href="{{ route('contact') }}"
                   class="inline-flex w-full items-center justify-center gap-2 border border-slate-300 bg-white px-5 py-3.5 text-sm font-semibold text-med-navy transition hover:border-med-blue hover:text-med-blue sm:w-auto sm:px-6">
                    Contact the Clinic
                    <i class="ri-arrow-right-line"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- Service listing --}}
    <section class="py-12 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
                <div class="max-w-2xl">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-red">
                        Our Services
                    </p>

                    <h2 class="mt-3 text-3xl font-bold tracking-tight text-med-navy sm:text-4xl">
                        Find the care you need.
                    </h2>

                    <p class="mt-4 text-sm leading-7 text-slate-600 sm:text-base">
                        Browse by specialty or view the full list of treatments available at MediDENT.
                    </p>
                </div>

                @if ($this->categories->isNotEmpty())
                    <div class="flex flex-wrap gap-2" aria-label="Filter services by category">
                        <button
                            type="button"
                            wire:click="selectCategory('all')"
                            @class([
                                'border px-4 py-2 text-sm font-semibold transition',
                                'border-med-blue bg-med-blue text-white' => $category === 'all',
                                'border-slate-200 bg-white text-slate-600 hover:border-med-blue hover:text-med-blue' => $category !== 'all',
                            ])>
                            All Services
                        </button>

                        @foreach ($this->categories as $serviceCategory)
                            <button
                                type="button"
                                wire:key="service-filter-{{ $serviceCategory->id }}"
                                wire:click="selectCategory(@js($serviceCategory->slug))"
                                @class([
                                    'border px-4 py-2 text-sm font-semibold transition',
                                    'border-med-blue bg-med-blue text-white' => $category === $serviceCategory->slug,
                                    'border-slate-200 bg-white text-slate-600 hover:border-med-blue hover:text-med-blue' => $category !== $serviceCategory->slug,
                                ])>
                                {{ $serviceCategory->title }}
                                <span @class([
                                    'ml-1 text-xs',
                                    'text-white/70' => $category === $serviceCategory->slug,
                                    'text-slate-400' => $category !== $serviceCategory->slug,
                                ])>
                                    {{ $serviceCategory->services_count }}
                                </span>
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            @if ($this->services->isEmpty())
                <div class="mt-8 border border-slate-200 bg-[#f8fbfd] px-6 py-14 text-center sm:mt-10">
                    <span class="mx-auto grid h-16 w-16 place-items-center bg-white text-3xl text-med-blue shadow-sm">
                        <i class="ri-first-aid-kit-line"></i>
                    </span>

                    <h3 class="mt-4 text-lg font-bold text-med-navy">Service information is being updated.</h3>
                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                        Please contact the clinic to ask about available treatments or book a consultation.
                    </p>

                    <div class="mt-5 flex flex-col justify-center gap-3 sm:flex-row">
                        @if ($category !== 'all')
                            <button type="button"
                                    wire:click="selectCategory('all')"
                                    class="inline-flex items-center justify-center gap-2 border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-med-navy transition hover:border-med-blue hover:text-med-blue">
                                View all services
                                <i class="ri-arrow-right-line"></i>
                            </button>
                        @endif

                        <a href="{{ route('contact') }}"
                           class="inline-flex items-center justify-center gap-2 bg-med-blue px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-sky-800">
                            Contact the clinic
                            <i class="ri-arrow-right-up-line"></i>
                        </a>
                    </div>
                </div>
            @else
                <div class="mt-8 grid gap-6 sm:mt-10 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($this->services as $service)
                        @php($serviceImage = $service->imageUrl())

                        <article
                            wire:key="service-card-{{ $service->id }}"
                            class="group flex h-full flex-col overflow-hidden border border-slate-200 bg-white transition duration-300 hover:-translate-y-1 hover:border-sky-200 hover:shadow-[0_16px_40px_rgba(18,50,74,0.09)]">

                            <a href="{{ route('services.show', $service->slug) }}"
                               class="relative block aspect-[16/10] overflow-hidden bg-slate-100"
                               aria-label="View {{ $service->title }}">
                                @if ($serviceImage)
                                    <img
                                        src="{{ $serviceImage }}"
                                        alt="{{ $service->title }} at MediDENT Multicare Clinic"
                                        loading="lazy"
                                        decoding="async"
                                        class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                    >
                                @else
                                    <span class="flex h-full w-full items-center justify-center bg-gradient-to-br from-sky-50 via-white to-slate-100 text-5xl text-sky-200">
                                        <i class="ri-first-aid-kit-line"></i>
                                    </span>
                                @endif

                                @if ($service->category)
                                    <span class="absolute left-4 top-4 bg-white/95 px-3 py-1.5 text-[10px] font-bold uppercase tracking-[0.14em] text-med-blue shadow-sm backdrop-blur">
                                        {{ $service->category->title }}
                                    </span>
                                @endif
                            </a>

                            <div class="flex flex-1 flex-col p-5 sm:p-6">
                                <h3 class="text-xl font-bold leading-snug tracking-tight text-med-navy transition group-hover:text-med-blue">
                                    <a href="{{ route('services.show', $service->slug) }}">
                                        {{ $service->title }}
                                    </a>
                                </h3>

                                <p class="mt-3 line-clamp-3 flex-1 text-sm leading-6 text-slate-500">
                                    {{ $service->excerpt(180) }}
                                </p>

                                <a href="{{ route('services.show', $service->slug) }}"
                                   class="mt-5 inline-flex items-center gap-2 border-t border-slate-100 pt-4 text-sm font-semibold text-med-blue transition hover:text-sky-800">
                                    View treatment
                                    <i class="ri-arrow-right-line transition group-hover:translate-x-1"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                @if ($this->services->hasPages())
                    <div class="mt-10 border-t border-slate-200 pt-6">
                        {{ $this->services->links() }}
                    </div>
                @endif
            @endif
        </div>
    </section>
</div>
