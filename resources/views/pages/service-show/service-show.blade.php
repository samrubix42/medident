@php
    $settings = $this->settings;
    $serviceImage = $service->imageUrl();
@endphp

<div>
    {{-- SERVICE HEADER --}}
    <section class="relative overflow-hidden bg-[#FAFDFE] py-10 sm:py-16">
        <div class="relative mx-auto max-w-5xl px-5 sm:px-6 lg:px-8">
            <nav class="flex flex-wrap items-center gap-2 text-xs font-medium text-slate-400" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="transition hover:text-med-blue">Home</a>
                <i class="ri-arrow-right-s-line text-sm text-slate-300"></i>
                <a href="{{ route('services') }}" class="transition hover:text-med-blue">Services</a>

                @if ($service->category)
                    <i class="ri-arrow-right-s-line text-sm text-slate-300"></i>
                    <span class="text-med-blue">{{ $service->category->title }}</span>
                @endif
            </nav>

            @if ($service->category)
                <p class="mt-5 text-xs font-bold uppercase tracking-[0.2em] text-med-blue">
                    {{ $service->category->title }}
                </p>
            @endif

            <h1 class="mt-4 text-3xl font-extrabold leading-[1.16] tracking-tight text-med-navy sm:text-5xl lg:text-[3.25rem]">
                {{ $service->title }}<span class="text-med-blue">.</span>
            </h1>

            @if ($service->excerpt() !== '')
                <p class="mt-4 max-w-3xl text-base leading-relaxed text-slate-600 sm:text-lg sm:leading-8">
                    {{ $service->excerpt(240) }}
                </p>
            @endif

            <div class="mt-7 flex flex-col gap-3.5 sm:flex-row sm:items-center">
                <button type="button"
                        @click="$dispatch('open-booking-modal')"
                        class="group inline-flex w-full sm:w-auto items-center justify-center gap-2.5 rounded-full bg-med-navy px-7 py-3.5 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:bg-med-blue hover:shadow-lg active:translate-y-0">
                    <span>Book an Appointment</span>
                    <i class="ri-arrow-right-line text-base transition-transform duration-200 group-hover:translate-x-1"></i>
                </button>

                @if ($settings->phone)
                    <a href="{{ $settings->phoneHref() }}"
                       class="group inline-flex w-full sm:w-auto items-center justify-center gap-2 rounded-full border border-slate-200 bg-white px-7 py-3.5 text-sm font-semibold text-med-navy shadow-sm transition-all duration-200 hover:border-med-blue hover:text-med-blue hover:shadow-md active:translate-y-0">
                        <i class="ri-phone-line text-med-blue"></i>
                        <span>{{ $settings->phone }}</span>
                    </a>
                @endif
            </div>
        </div>
    </section>

    @if ($serviceImage)
        <div class="bg-[#FAFDFE] pb-10 sm:pb-14">
            <div class="mx-auto max-w-5xl px-5 sm:px-6 lg:px-8">
                <div class="overflow-hidden rounded-3xl border-4 border-white bg-slate-100 shadow-[0_20px_60px_rgba(18,50,74,0.12)]">
                    <img
                        src="{{ $serviceImage }}"
                        alt="{{ $service->title }} at MediDENT Multicare Clinic"
                        fetchpriority="high"
                        class="aspect-[16/9] w-full object-cover"
                    >
                </div>
            </div>
        </div>
    @endif

    {{-- SERVICE BODY & SIDEBAR --}}
    <section class="border-t border-slate-100 bg-white py-12 sm:py-16 lg:py-20">
        <div class="mx-auto grid max-w-7xl gap-10 px-5 sm:px-6 lg:grid-cols-[minmax(0,1fr)_340px] lg:gap-14 lg:px-8">

            <article class="min-w-0">
                <div class="text-[15px] leading-8 text-slate-600
                    [&_h2]:mb-3 [&_h2]:mt-9 [&_h2]:scroll-mt-28 [&_h2]:text-2xl [&_h2]:font-bold [&_h2]:leading-tight [&_h2]:tracking-tight [&_h2]:text-med-navy
                    [&_h3]:mb-2 [&_h3]:mt-7 [&_h3]:scroll-mt-28 [&_h3]:text-xl [&_h3]:font-bold [&_h3]:text-med-navy
                    [&_h4]:mb-2 [&_h4]:mt-6 [&_h4]:text-lg [&_h4]:font-bold [&_h4]:text-med-navy
                    [&_p]:mb-5
                    [&_ul]:mb-5 [&_ul]:list-disc [&_ul]:space-y-2 [&_ul]:pl-5
                    [&_ol]:mb-5 [&_ol]:list-decimal [&_ol]:space-y-2 [&_ol]:pl-5
                    [&_li]:pl-1
                    [&_a]:font-semibold [&_a]:text-med-blue [&_a]:underline [&_a]:underline-offset-2 hover:[&_a]:text-sky-800
                    [&_strong]:font-semibold [&_strong]:text-med-navy
                    [&_em]:italic
                    [&_blockquote]:my-6 [&_blockquote]:rounded-2xl [&_blockquote]:border-l-4 [&_blockquote]:border-med-blue [&_blockquote]:bg-sky-50/60 [&_blockquote]:px-5 [&_blockquote]:py-4 [&_blockquote]:text-slate-600
                    [&_hr]:my-8 [&_hr]:border-slate-100
                    [&_img]:my-6 [&_img]:h-auto [&_img]:max-w-full [&_img]:rounded-2xl [&_img]:border [&_img]:border-slate-100 [&_img]:shadow-sm
                    [&_figure]:my-6
                    [&_figcaption]:mt-2 [&_figcaption]:text-center [&_figcaption]:text-xs [&_figcaption]:text-slate-400
                    [&_table]:my-6 [&_table]:w-full [&_table]:border-collapse [&_table]:overflow-hidden [&_table]:rounded-2xl [&_table]:text-sm
                    [&_thead]:bg-slate-50
                    [&_th]:border [&_th]:border-slate-100 [&_th]:px-4 [&_th]:py-3 [&_th]:text-left [&_th]:font-semibold [&_th]:text-med-navy
                    [&_td]:border [&_td]:border-slate-100 [&_td]:px-4 [&_td]:py-3 [&_td]:align-top
                    [&_iframe]:my-6 [&_iframe]:aspect-video [&_iframe]:h-auto [&_iframe]:w-full [&_iframe]:rounded-2xl
                    [&_code]:rounded-md [&_code]:bg-slate-100 [&_code]:px-1.5 [&_code]:py-0.5 [&_code]:text-sm [&_code]:text-med-navy
                    [&_h2:first-child]:mt-0 [&_h3:first-child]:mt-0">
                    {!! $service->content !!}
                </div>

                {{-- General notice box --}}
                <div class="mt-10 flex flex-col gap-4 rounded-3xl border border-sky-100 bg-gradient-to-br from-sky-50/70 to-white p-6 sm:flex-row sm:items-start sm:p-7 shadow-sm">
                    <span class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-white text-2xl text-med-blue shadow-sm">
                        <i class="ri-information-line"></i>
                    </span>

                    <div>
                        <h2 class="text-base font-bold text-med-navy">This information is a clinical guide</h2>
                        <p class="mt-1.5 text-sm leading-relaxed text-slate-600">
                            Specific treatment recommendations depend on your symptoms, medical history, and clinical evaluation. Please book an in-person consultation with our healthcare team for personalized guidance.
                        </p>
                    </div>
                </div>

                <div class="mt-8 border-t border-slate-100 pt-6">
                    <a href="{{ route('services') }}"
                       class="group inline-flex items-center gap-2 text-sm font-semibold text-med-blue transition hover:text-sky-800">
                        <i class="ri-arrow-left-line transition-transform duration-200 group-hover:-translate-x-1"></i>
                        <span>Back to all services</span>
                    </a>
                </div>
            </article>

            <aside class="space-y-6">
                {{-- Clinic CTA Card --}}
                <div class="relative overflow-hidden rounded-3xl bg-med-navy p-7 text-white shadow-xl">
                    <div class="pointer-events-none absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/[0.04]"></div>

                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-cyan-300">
                        MediDENT Multicare Clinic
                    </p>

                    <h2 class="mt-3 text-2xl font-extrabold leading-tight tracking-tight">
                        Ready to book your visit?
                    </h2>

                    <p class="mt-3 text-sm leading-relaxed text-slate-300">
                        Our medical and dental staff will answer your questions and arrange an appointment for {{ $service->title }}.
                    </p>

                    <button type="button"
                            @click="$dispatch('open-booking-modal')"
                            class="group mt-6 inline-flex w-full items-center justify-center gap-2 rounded-full bg-med-blue px-6 py-3.5 text-sm font-semibold text-white shadow-md transition hover:bg-sky-400 hover:shadow-lg">
                        <span>Book an Appointment</span>
                        <i class="ri-arrow-right-line text-base transition-transform duration-200 group-hover:translate-x-1"></i>
                    </button>

                    @if ($settings->phone)
                        <a href="{{ $settings->phoneHref() }}"
                           class="mt-3 inline-flex w-full items-center justify-center gap-2 rounded-full border border-white/20 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/10">
                            <i class="ri-phone-line"></i>
                            <span>{{ $settings->phone }}</span>
                        </a>
                    @endif
                </div>

                {{-- Related services --}}
                @if ($this->relatedServices->isNotEmpty())
                    <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-sm">
                        <div class="flex items-center justify-between gap-3 border-b border-slate-100 pb-4">
                            <h2 class="text-base font-bold text-med-navy">Related services</h2>
                            <i class="ri-first-aid-kit-line text-lg text-med-blue"></i>
                        </div>

                        <div class="mt-5 space-y-4">
                            @foreach ($this->relatedServices as $relatedService)
                                @php($relatedServiceImage = $relatedService->imageUrl())

                                <a href="{{ route('services.show', $relatedService->slug) }}"
                                   wire:key="related-service-{{ $relatedService->id }}"
                                   class="group flex gap-3.5 rounded-2xl p-2.5 transition hover:bg-slate-50">
                                    <span class="h-16 w-20 shrink-0 overflow-hidden rounded-xl bg-slate-100">
                                        @if ($relatedServiceImage)
                                            <img
                                                src="{{ $relatedServiceImage }}"
                                                alt="{{ $relatedService->title }}"
                                                loading="lazy"
                                                class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                                            >
                                        @else
                                            <span class="flex h-full w-full items-center justify-center text-2xl text-sky-200">
                                                <i class="ri-first-aid-kit-line"></i>
                                            </span>
                                        @endif
                                    </span>

                                    <span class="min-w-0 flex-1">
                                        @if ($relatedService->category)
                                            <span class="block text-[10px] font-bold uppercase tracking-wider text-med-blue">
                                                {{ $relatedService->category->title }}
                                            </span>
                                        @endif

                                        <span class="mt-0.5 line-clamp-2 block text-sm font-bold text-med-navy transition group-hover:text-med-blue">
                                            {{ $relatedService->title }}
                                        </span>

                                        <span class="mt-1 inline-flex items-center gap-1 text-xs font-semibold text-med-blue">
                                            <span>View</span>
                                            <i class="ri-arrow-right-line text-xs"></i>
                                        </span>
                                    </span>
                                </a>
                            @endforeach
                        </div>

                        <a href="{{ route('services') }}"
                           class="mt-5 inline-flex items-center gap-2 border-t border-slate-100 pt-4 text-xs font-semibold text-med-blue transition hover:text-sky-800">
                            <span>View all services</span>
                            <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                @endif

                {{-- Clinic details --}}
                <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-sm">
                    <h2 class="text-base font-bold text-med-navy">Clinic details</h2>

                    <div class="mt-4 space-y-3.5 text-sm leading-relaxed text-slate-600">
                        @if ($settings->address)
                            <div class="flex items-start gap-3">
                                <span class="grid h-8 w-8 shrink-0 place-items-center rounded-xl bg-sky-50 text-med-blue">
                                    <i class="ri-map-pin-line text-sm"></i>
                                </span>
                                <span class="text-xs leading-5 text-slate-600">{{ $settings->address }}</span>
                            </div>
                        @endif

                        @if ($settings->opening_hours)
                            <div class="flex items-start gap-3">
                                <span class="grid h-8 w-8 shrink-0 place-items-center rounded-xl bg-sky-50 text-med-blue">
                                    <i class="ri-time-line text-sm"></i>
                                </span>
                                <span class="text-xs leading-5 text-slate-600">
                                    @foreach ($settings->openingHoursLines() as $hours)
                                        {{ $hours }}@if (! $loop->last)<br>@endif
                                    @endforeach
                                </span>
                            </div>
                        @endif
                    </div>

                    <a href="{{ route('contact') }}"
                       class="mt-5 inline-flex items-center gap-2 border-t border-slate-100 pt-4 text-xs font-semibold text-med-blue transition hover:text-sky-800">
                        <span>Contact the clinic</span>
                        <i class="ri-arrow-right-line"></i>
                    </a>
                </div>
            </aside>
        </div>
    </section>
</div>

