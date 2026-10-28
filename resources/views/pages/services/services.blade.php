<div>
    {{-- HERO SECTION --}}
    <section class="relative overflow-hidden bg-[#FAFDFE] py-10 sm:py-16 lg:py-20">
        <div class="relative mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-xs font-medium text-slate-400" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="transition hover:text-med-blue">Home</a>
                <i class="ri-arrow-right-s-line text-sm text-slate-300"></i>
                <span class="text-med-blue">Services</span>
            </nav>

            <div class="mt-5 max-w-3xl">
                <h1 class="text-3xl font-extrabold leading-[1.16] tracking-tight text-med-navy sm:text-5xl lg:text-[3.5rem]">
                    Complete care for your health and
                    <span class="text-med-blue">your smile</span><span class="text-med-blue">.</span>
                </h1>

                <p class="mt-4 sm:mt-5 text-base leading-relaxed text-slate-600 sm:text-lg sm:leading-8">
                    Find the care you need. Explore our medical, diabetes, and dental services in Shastri Nagar, Ghaziabad. Each treatment is delivered with attentive clinical care, modern equipment, and clear guidance.
                </p>

                <div class="mt-7 flex flex-col gap-3.5 sm:flex-row sm:items-center">
                    <button type="button"
                            @click="$dispatch('open-booking-modal')"
                            class="group inline-flex w-full sm:w-auto items-center justify-center gap-2.5 rounded-full bg-med-navy px-7 py-3.5 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:bg-med-blue hover:shadow-lg active:translate-y-0">
                        <span>Book an Appointment</span>
                        <i class="ri-arrow-right-line text-base transition-transform duration-200 group-hover:translate-x-1"></i>
                    </button>

                    <a href="{{ route('contact') }}"
                       class="group inline-flex w-full sm:w-auto items-center justify-center gap-2 rounded-full border border-slate-200 bg-white px-7 py-3.5 text-sm font-semibold text-med-navy shadow-sm transition-all duration-200 hover:border-med-blue hover:text-med-blue hover:shadow-md active:translate-y-0">
                        <i class="ri-phone-line text-med-blue"></i>
                        <span>Contact the Clinic</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- SERVICES LISTING --}}
    <section class="border-t border-slate-100 bg-white py-12 sm:py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
                <div class="max-w-2xl">
                    <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-med-navy">
                        Find the care you need<span class="text-med-blue">.</span>
                    </h2>

                    <p class="mt-3 sm:mt-4 max-w-xl text-sm sm:text-base leading-relaxed text-slate-600">
                        Filter by specialty or explore the full range of medical and dental treatments available at MediDENT.
                    </p>
                </div>

                {{-- Category Filter Pills --}}
                @if ($this->categories->isNotEmpty())
                    <div class="flex flex-wrap items-center gap-2" aria-label="Filter services by category">
                        <button
                            type="button"
                            wire:click="selectCategory('all')"
                            @class([
                                'rounded-full px-4 py-2 sm:px-5 sm:py-2.5 text-xs sm:text-sm font-semibold transition-all duration-200 cursor-pointer',
                                'bg-med-navy text-white shadow-md' => $category === 'all',
                                'border border-slate-200 bg-white text-slate-600 hover:border-med-blue hover:text-med-blue shadow-sm' => $category !== 'all',
                            ])>
                            All Services
                        </button>

                        @foreach ($this->categories as $serviceCategory)
                            <button
                                type="button"
                                wire:key="service-filter-{{ $serviceCategory->id }}"
                                wire:click="selectCategory(@js($serviceCategory->slug))"
                                @class([
                                    'rounded-full px-4 py-2 sm:px-5 sm:py-2.5 text-xs sm:text-sm font-semibold transition-all duration-200 cursor-pointer',
                                    'bg-med-navy text-white shadow-md' => $category === $serviceCategory->slug,
                                    'border border-slate-200 bg-white text-slate-600 hover:border-med-blue hover:text-med-blue shadow-sm' => $category !== $serviceCategory->slug,
                                ])>
                                <span>{{ $serviceCategory->title }}</span>
                                <span @class([
                                    'ml-1.5 text-xs',
                                    'text-white/70' => $category === $serviceCategory->slug,
                                    'text-slate-400' => $category !== $serviceCategory->slug,
                                ])>
                                    ({{ $serviceCategory->services_count }})
                                </span>
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            @if ($this->services->isEmpty())
                <div class="mt-10 rounded-3xl border border-slate-100 bg-gradient-to-br from-[#f8fbfd] to-white px-6 py-14 text-center shadow-sm sm:mt-12 sm:py-16">
                    <span class="mx-auto grid h-16 w-16 place-items-center rounded-2xl bg-white text-3xl text-med-blue shadow-sm">
                        <i class="ri-first-aid-kit-line"></i>
                    </span>

                    <h3 class="mt-5 text-xl font-bold text-med-navy">Service information is being updated.</h3>
                    <p class="mx-auto mt-2 max-w-md text-sm leading-relaxed text-slate-500">
                        Please contact the clinic directly to ask about available treatments or schedule a consultation.
                    </p>

                    <div class="mt-7 flex flex-col justify-center gap-3 sm:flex-row">
                        @if ($category !== 'all')
                            <button type="button"
                                    wire:click="selectCategory('all')"
                                    class="inline-flex items-center justify-center gap-2 rounded-full border border-slate-200 bg-white px-6 py-3 text-sm font-semibold text-med-navy shadow-sm transition hover:border-med-blue hover:text-med-blue">
                                <i class="ri-refresh-line"></i>
                                <span>View all services</span>
                            </button>
                        @endif

                        <a href="{{ route('contact') }}"
                           class="inline-flex items-center justify-center gap-2 rounded-full bg-med-navy px-7 py-3 text-sm font-semibold text-white shadow-md transition hover:bg-med-blue hover:shadow-lg">
                            <span>Contact the clinic</span>
                            <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                </div>
            @else
                <div class="mt-10 grid gap-6 sm:mt-12 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($this->services as $service)
                        @php($serviceImage = $service->imageUrl())

                        <article
                            wire:key="service-card-{{ $service->id }}"
                            class="group flex h-full flex-col overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-sm transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_25px_60px_rgba(18,50,74,0.12)]">

                            <a href="{{ route('services.show', $service->slug) }}"
                               class="relative block h-48 sm:h-56 overflow-hidden bg-slate-100"
                               aria-label="View {{ $service->title }}">
                                @if ($serviceImage)
                                    <img
                                        src="{{ $serviceImage }}"
                                        alt="{{ $service->title }} at MediDENT Multicare Clinic"
                                        loading="lazy"
                                        decoding="async"
                                        class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                                    >
                                @else
                                    <span class="flex h-full w-full items-center justify-center bg-gradient-to-br from-sky-50 via-white to-slate-50 text-5xl text-sky-200">
                                        <i class="ri-first-aid-kit-line"></i>
                                    </span>
                                @endif

                                <div class="absolute inset-0 bg-gradient-to-t from-med-navy/30 via-transparent to-transparent"></div>
                            </a>

                            <div class="flex flex-1 flex-col p-6 sm:p-7">
                                @if ($service->category)
                                    <p class="text-xs font-bold uppercase tracking-wider text-med-blue mb-2.5">
                                        {{ $service->category->title }}
                                    </p>
                                @endif

                                <h3 class="text-xl font-bold leading-snug tracking-tight text-med-navy transition-colors group-hover:text-med-blue">
                                    <a href="{{ route('services.show', $service->slug) }}">
                                        {{ $service->title }}
                                    </a>
                                </h3>

                                <p class="mt-3 line-clamp-3 flex-1 text-sm leading-relaxed text-slate-600">
                                    {{ $service->excerpt(180) }}
                                </p>

                                <a href="{{ route('services.show', $service->slug) }}"
                                   class="group/btn mt-6 inline-flex items-center gap-2 border-t border-slate-100 pt-4 text-sm font-semibold text-med-blue">
                                    <span>View Treatment</span>
                                    <i class="ri-arrow-right-line transition-transform duration-200 group-hover/btn:translate-x-1"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                @if ($this->services->hasPages())
                    <div class="mt-12 flex justify-center border-t border-slate-100 pt-8">
                        {{ $this->services->links() }}
                    </div>
                @endif
            @endif
        </div>
    </section>
</div>

