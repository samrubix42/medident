@php
    $settings = $this->settings;
    $serviceImage = $service->imageUrl();
@endphp

<div>
    {{-- Service header --}}
    <section class="relative overflow-hidden border-b border-slate-100 bg-[#f5fafc]">
        <div class="pointer-events-none absolute -right-24 -top-24 h-80 w-80 rounded-full border-[46px] border-sky-100/70"></div>
        <div class="pointer-events-none absolute -bottom-28 left-1/4 h-64 w-64 rounded-full border-[34px] border-white"></div>

        <div class="relative mx-auto max-w-5xl px-5 py-10 sm:px-6 sm:py-16 lg:px-8 lg:py-20">
            <nav class="flex flex-wrap items-center gap-2 text-xs text-slate-400" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="transition hover:text-med-blue">Home</a>
                <i class="ri-arrow-right-s-line text-sm"></i>
                <a href="{{ route('services') }}" class="transition hover:text-med-blue">Services</a>

                @if ($service->category)
                    <i class="ri-arrow-right-s-line text-sm"></i>
                    <span class="text-slate-500">{{ $service->category->title }}</span>
                @endif
            </nav>

            @if ($service->category)
                <div class="mt-6 inline-flex items-center gap-2 border border-sky-100 bg-white px-3 py-2 text-[10px] font-bold uppercase tracking-[0.14em] text-med-blue sm:text-xs sm:tracking-[0.16em]">
                    <i class="ri-first-aid-kit-line text-base"></i>
                    {{ $service->category->title }} Service
                </div>
            @endif

            <h1 class="mt-5 max-w-4xl text-[2rem] font-bold leading-[1.15] tracking-tight text-med-navy sm:mt-6 sm:text-5xl lg:text-[3.25rem]">
                {{ $service->title }}
            </h1>

            @if ($service->excerpt() !== '')
                <p class="mt-5 max-w-3xl text-sm leading-7 text-slate-600 sm:mt-6 sm:text-base sm:leading-8">
                    {{ $service->excerpt(240) }}
                </p>
            @endif

            <div class="mt-7 flex flex-col gap-3 sm:flex-row">
                <button type="button"
                        @click="$dispatch('open-booking-modal')"
                        class="inline-flex w-full items-center justify-center gap-2 bg-med-blue px-5 py-3.5 text-sm font-semibold text-white transition hover:bg-sky-800 sm:w-auto sm:px-6">
                    Book an Appointment
                    <i class="ri-arrow-right-up-line text-lg"></i>
                </button>

                @if ($settings->phone)
                    <a href="{{ $settings->phoneHref() }}"
                       class="inline-flex w-full items-center justify-center gap-2 border border-slate-300 bg-white px-5 py-3.5 text-sm font-semibold text-med-navy transition hover:border-med-blue hover:text-med-blue sm:w-auto sm:px-6">
                        <i class="ri-phone-line"></i>
                        {{ $settings->phone }}
                    </a>
                @endif
            </div>
        </div>
    </section>

    @if ($serviceImage)
        <div class="bg-[#f5fafc] pb-10 sm:pb-14">
            <div class="mx-auto max-w-5xl px-5 sm:px-6 lg:px-8">
                <img
                    src="{{ $serviceImage }}"
                    alt="{{ $service->title }} at MediDENT Multicare Clinic"
                    fetchpriority="high"
                    class="aspect-[16/9] w-full border-[6px] border-white object-cover shadow-[0_20px_60px_rgba(18,50,74,0.12)]"
                >
            </div>
        </div>
    @endif

    {{-- Service body and sidebar --}}
    <section class="py-12 sm:py-16 lg:py-20">
        <div class="mx-auto grid max-w-7xl gap-10 px-5 sm:px-6 lg:grid-cols-[minmax(0,1fr)_320px] lg:gap-14 lg:px-8">

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
                    [&_blockquote]:my-6 [&_blockquote]:border-l-4 [&_blockquote]:border-med-blue [&_blockquote]:bg-sky-50/60 [&_blockquote]:px-5 [&_blockquote]:py-4 [&_blockquote]:text-slate-600
                    [&_hr]:my-8 [&_hr]:border-slate-200
                    [&_img]:my-6 [&_img]:h-auto [&_img]:max-w-full [&_img]:border [&_img]:border-slate-200
                    [&_figure]:my-6
                    [&_figcaption]:mt-2 [&_figcaption]:text-center [&_figcaption]:text-xs [&_figcaption]:text-slate-400
                    [&_table]:my-6 [&_table]:w-full [&_table]:border-collapse [&_table]:text-sm
                    [&_thead]:bg-slate-50
                    [&_th]:border [&_th]:border-slate-200 [&_th]:px-4 [&_th]:py-3 [&_th]:text-left [&_th]:font-semibold [&_th]:text-med-navy
                    [&_td]:border [&_td]:border-slate-200 [&_td]:px-4 [&_td]:py-3 [&_td]:align-top
                    [&_iframe]:my-6 [&_iframe]:aspect-video [&_iframe]:h-auto [&_iframe]:w-full
                    [&_code]:bg-slate-100 [&_code]:px-1.5 [&_code]:py-0.5 [&_code]:text-sm [&_code]:text-med-navy
                    [&_h2:first-child]:mt-0 [&_h3:first-child]:mt-0">
                    {!! $service->content !!}
                </div>

                <div class="mt-10 flex flex-col gap-5 border border-sky-100 bg-sky-50/60 p-5 sm:flex-row sm:items-start sm:p-6">
                    <span class="grid h-11 w-11 shrink-0 place-items-center bg-white text-xl text-med-blue shadow-sm">
                        <i class="ri-information-line"></i>
                    </span>

                    <div>
                        <h2 class="text-base font-bold text-med-navy">This information is a general guide</h2>
                        <p class="mt-2 text-sm leading-6 text-slate-600">
                            Treatment recommendations depend on your symptoms, medical history, and clinical examination. Please book a consultation with our team for advice specific to your health.
                        </p>
                    </div>
                </div>

                <div class="mt-8 border-t border-slate-200 pt-6">
                    <a href="{{ route('services') }}"
                       class="inline-flex items-center gap-2 text-sm font-semibold text-med-blue transition hover:text-sky-800">
                        <i class="ri-arrow-left-line"></i>
                        Back to all services
                    </a>
                </div>
            </article>

            <aside class="space-y-6">
                {{-- Clinic CTA --}}
                <div class="relative overflow-hidden bg-med-navy p-6 text-white">
                    <div class="pointer-events-none absolute -right-10 -top-10 h-32 w-32 rounded-full border-[20px] border-white/[0.05]"></div>

                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-cyan-300">
                        MediDENT Clinic
                    </p>

                    <h2 class="mt-3 text-2xl font-bold leading-tight tracking-tight">
                        Ready to book your visit?
                    </h2>

                    <p class="mt-3 text-sm leading-6 text-slate-300">
                        Our team can answer your questions and arrange a consultation for {{ $service->title }}.
                    </p>

                    <button type="button"
                            @click="$dispatch('open-booking-modal')"
                            class="mt-5 inline-flex w-full items-center justify-center gap-2 bg-med-red px-5 py-3 text-sm font-semibold text-white transition hover:bg-red-700">
                        Book an Appointment
                        <i class="ri-arrow-right-up-line"></i>
                    </button>

                    @if ($settings->phone)
                        <a href="{{ $settings->phoneHref() }}"
                           class="mt-3 inline-flex w-full items-center justify-center gap-2 border border-white/20 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/10">
                            <i class="ri-phone-line"></i>
                            {{ $settings->phone }}
                        </a>
                    @endif
                </div>

                {{-- Related services --}}
                @if ($this->relatedServices->isNotEmpty())
                    <div class="border border-slate-200 bg-white p-5 sm:p-6">
                        <div class="flex items-center justify-between gap-3">
                            <h2 class="text-base font-bold text-med-navy">Related services</h2>
                            <i class="ri-first-aid-kit-line text-lg text-med-blue"></i>
                        </div>

                        <div class="mt-5 space-y-5">
                            @foreach ($this->relatedServices as $relatedService)
                                @php($relatedServiceImage = $relatedService->imageUrl())

                                <a href="{{ route('services.show', $relatedService->slug) }}"
                                   wire:key="related-service-{{ $relatedService->id }}"
                                   class="group flex gap-3">
                                    <span class="h-16 w-20 shrink-0 overflow-hidden border border-slate-200 bg-slate-100">
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

                                    <span class="min-w-0">
                                        @if ($relatedService->category)
                                            <span class="block text-[10px] font-bold uppercase tracking-[0.12em] text-med-blue">
                                                {{ $relatedService->category->title }}
                                            </span>
                                        @endif

                                        <span class="mt-1 line-clamp-2 block text-sm font-semibold leading-5 text-med-navy transition group-hover:text-med-blue">
                                            {{ $relatedService->title }}
                                        </span>

                                        <span class="mt-1 block text-[11px] text-slate-400">
                                            View treatment
                                        </span>
                                    </span>
                                </a>
                            @endforeach
                        </div>

                        <a href="{{ route('services') }}"
                           class="mt-5 inline-flex items-center gap-2 border-t border-slate-100 pt-4 text-xs font-semibold text-med-blue transition hover:text-sky-800">
                            View all services
                            <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                @endif

                {{-- Clinic details --}}
                <div class="border border-slate-200 bg-white p-5 sm:p-6">
                    <h2 class="text-base font-bold text-med-navy">Clinic details</h2>

                    <div class="mt-4 space-y-3 text-sm leading-6 text-slate-500">
                        @if ($settings->address)
                            <p class="flex items-start gap-3">
                                <i class="ri-map-pin-line mt-0.5 text-lg text-med-blue"></i>
                                <span>{{ $settings->address }}</span>
                            </p>
                        @endif

                        @if ($settings->opening_hours)
                            <p class="flex items-start gap-3">
                                <i class="ri-time-line mt-0.5 text-lg text-med-blue"></i>
                                <span>
                                    @foreach ($settings->openingHoursLines() as $hours)
                                        {{ $hours }}@if (! $loop->last)<br>@endif
                                    @endforeach
                                </span>
                            </p>
                        @endif
                    </div>

                    <a href="{{ route('contact') }}"
                       class="mt-5 inline-flex items-center gap-2 border-t border-slate-100 pt-4 text-xs font-semibold text-med-blue transition hover:text-sky-800">
                        Contact the clinic
                        <i class="ri-arrow-right-line"></i>
                    </a>
                </div>
            </aside>
        </div>
    </section>
</div>
