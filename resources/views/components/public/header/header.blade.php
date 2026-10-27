@php($settings = $this->settings)

<div
    x-data="{ mobileOpen: false, servicesOpen: false }"
    x-effect="document.body.classList.toggle('overflow-hidden', mobileOpen)"
    @keydown.escape.window="mobileOpen = false; servicesOpen = false"
    @resize.window.debounce.150ms="if (window.innerWidth >= 1024) { mobileOpen = false; servicesOpen = false }"
    class="relative z-50">
    {{-- Top information bar --}}
    <div class="hidden bg-med-navy text-white sm:block">
        <div class="mx-auto flex max-w-7xl flex-col justify-between gap-2 px-5 py-2 text-xs sm:flex-row sm:items-center lg:px-8">
            <p class="flex items-center justify-center gap-2 text-white/80 sm:justify-start">
                <i class="ri-heart-pulse-line text-base text-cyan-300"></i>
                Thoughtful care for your entire family
            </p>

            <div class="flex flex-wrap items-center justify-center gap-x-5 gap-y-1 text-white/80">
                @if ($settings->phone)
                    <a href="{{ $settings->phoneHref() }}" class="transition hover:text-white">
                        <i class="ri-phone-line mr-1 text-cyan-300"></i>
                        {{ $settings->phone }}
                    </a>
                @endif

                @if ($settings->secondary_phone)
                    <a href="{{ $settings->secondaryPhoneHref() }}" class="transition hover:text-white">
                        <i class="ri-phone-line mr-1 text-cyan-300"></i>
                        {{ $settings->secondary_phone }}
                    </a>
                @endif

                @if ($settings->opening_hours)
                    <span class="hidden text-white/30 sm:inline">|</span>

                    <span>
                        <i class="ri-time-line mr-1 text-cyan-300"></i>
                        {{ $settings->opening_hours }}
                    </span>
                @endif
            </div>
        </div>
    </div>

    {{-- Main navigation --}}
    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-5 px-5 py-4 lg:px-8">

            {{-- Brand logo --}}
            <a href="{{ url('/') }}" class="flex shrink-0 items-center gap-3" aria-label="MediDENT home">
                <img
                    src="{{ asset('logo.webp') }}"
                    alt="MediDENT Multicare Clinic"
                    class="h-10 w-auto object-contain sm:h-12">

                <span>
                    <span class="block text-base font-bold leading-none tracking-tight text-med-navy sm:text-lg">MediDENT</span>
                    <span class="mt-1 block text-[9px] font-semibold uppercase tracking-[0.18em] text-med-blue sm:text-[10px]">
                        Multicare Clinic
                    </span>
                </span>
            </a>

            {{-- Desktop menu --}}
            <nav class="hidden items-center gap-7 lg:flex" aria-label="Main navigation">

                <a href="{{ route('home') }}"
                    @class([
                        'text-sm font-semibold transition',
                        'text-med-blue' => request()->routeIs('home'),
                        'text-slate-600 hover:text-med-blue' => ! request()->routeIs('home'),
                    ])>
                    Home
                </a>

                <a href="{{ route('about') }}"
                    @class([
                        'text-sm font-semibold transition',
                        'text-med-blue' => request()->routeIs('about'),
                        'text-slate-600 hover:text-med-blue' => ! request()->routeIs('about'),
                    ])>
                    About Us
                </a>

                {{-- Services dropdown --}}
                <div class="relative">
                    <button
                        type="button"
                        @click="servicesOpen = !servicesOpen"
                        :aria-expanded="servicesOpen"
                        class="flex items-center gap-1.5 text-sm font-medium text-slate-600 transition hover:text-med-blue">
                        Services
                        <i class="ri-arrow-down-s-line text-lg transition"
                            :class="{ 'rotate-180': servicesOpen }"></i>
                    </button>

                    <div
                        x-cloak
                        x-show="servicesOpen"
                        x-transition.origin.top.left
                        @click.outside="servicesOpen = false"
                        class="absolute left-0 top-full mt-4 w-64 border border-slate-200 bg-white p-2 shadow-xl">
                        <a href="{{ url('/#services') }}"
                            @click="servicesOpen = false"
                            class="flex items-center gap-3 p-3 transition hover:bg-sky-50">
                            <span class="grid h-10 w-10 shrink-0 place-items-center bg-sky-50 text-xl text-med-blue">
                                <i class="ri-stethoscope-line"></i>
                            </span>
                            <span>
                                <span class="block text-sm font-semibold text-med-navy">Medical Care</span>
                                <span class="mt-1 block text-xs text-slate-500">Everyday healthcare</span>
                            </span>
                        </a>

                        <a href="{{ url('/#services') }}"
                            @click="servicesOpen = false"
                            class="flex items-center gap-3 p-3 transition hover:bg-red-50">
                            <span class="grid h-10 w-10 shrink-0 place-items-center bg-red-50 text-xl text-med-red">
                                <i class="ri-heart-pulse-line"></i>
                            </span>
                            <span>
                                <span class="block text-sm font-semibold text-med-navy">Diabetes Care</span>
                                <span class="mt-1 block text-xs text-slate-500">Ongoing health support</span>
                            </span>
                        </a>

                        <a href="{{ url('/#services') }}"
                            @click="servicesOpen = false"
                            class="flex items-center gap-3 p-3 transition hover:bg-cyan-50">
                            <span class="grid h-10 w-10 shrink-0 place-items-center bg-cyan-50 text-xl text-cyan-700">
                                <i class="ri-tooth-line"></i>
                            </span>
                            <span>
                                <span class="block text-sm font-semibold text-med-navy">Dental Care</span>
                                <span class="mt-1 block text-xs text-slate-500">Complete oral healthcare</span>
                            </span>
                        </a>
                    </div>
                </div>

                <a href="{{ url('/#testimonials') }}"
                    class="text-sm font-medium text-slate-600 transition hover:text-med-blue">
                    Testimonials
                </a>

                <a href="{{ route('contact') }}"
                    @class([
                        'text-sm font-semibold transition',
                        'text-med-blue' => request()->routeIs('contact'),
                        'text-slate-600 hover:text-med-blue' => ! request()->routeIs('contact'),
                    ])>
                    Contact
                </a>
            </nav>

            {{-- Desktop appointment button --}}
            <button type="button"
                @click="$dispatch('open-booking-modal')"
                class="hidden items-center gap-2 bg-med-red px-5 py-3 text-sm font-semibold text-white transition hover:bg-red-700 lg:inline-flex">
                Book an Appointment
                <i class="ri-arrow-right-up-line text-base"></i>
            </button>

            {{-- Mobile menu button --}}
            <button
                type="button"
                @click="mobileOpen = true; servicesOpen = false"
                :aria-expanded="mobileOpen"
                aria-label="Open navigation"
                class="grid h-10 w-10 shrink-0 place-items-center border border-slate-200 text-xl text-med-navy lg:hidden">
                <i class="ri-menu-3-line"></i>
            </button>
        </div>

        {{-- Full-screen mobile navigation --}}
        <div
            x-cloak
            x-show="mobileOpen"
            x-transition.opacity.duration.200ms
            role="dialog"
            aria-modal="true"
            aria-label="Mobile navigation"
            class="fixed inset-0 z-[70] lg:hidden">

            <div class="absolute inset-0 bg-med-navy/60 backdrop-blur-sm"
                 @click="mobileOpen = false; servicesOpen = false"></div>

            <div class="absolute inset-y-0 right-0 flex w-full flex-col bg-white shadow-2xl">
                <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4">
                    <a href="{{ route('home') }}"
                       @click="mobileOpen = false"
                       class="flex items-center gap-3"
                       aria-label="MediDENT home">
                        <img
                            src="{{ asset('logo.webp') }}"
                            alt="MediDENT Multicare Clinic"
                            class="h-10 w-auto object-contain">

                        <span>
                            <span class="block text-base font-bold leading-none tracking-tight text-med-navy">MediDENT</span>
                            <span class="mt-1 block text-[9px] font-semibold uppercase tracking-[0.18em] text-med-blue">
                                Multicare Clinic
                            </span>
                        </span>
                    </a>

                    <button type="button"
                            @click="mobileOpen = false; servicesOpen = false"
                            aria-label="Close navigation"
                            class="grid h-10 w-10 shrink-0 place-items-center border border-slate-200 text-xl text-med-navy transition hover:border-med-blue hover:text-med-blue">
                        <i class="ri-close-line"></i>
                    </button>
                </div>

                <nav class="flex-1 overflow-y-auto px-5 py-4" aria-label="Mobile navigation">

                    <a href="{{ route('home') }}"
                        @click="mobileOpen = false"
                        @class([
                            'flex items-center justify-between border-b border-slate-100 py-4 text-sm transition',
                            'font-semibold text-med-blue' => request()->routeIs('home'),
                            'font-medium text-slate-700' => ! request()->routeIs('home'),
                        ])>
                        <span class="flex items-center gap-3">
                            <i class="ri-home-5-line text-lg"></i>
                            Home
                        </span>
                        <i class="ri-arrow-right-s-line text-lg text-slate-300"></i>
                    </a>

                    <a href="{{ route('about') }}"
                        @click="mobileOpen = false"
                        @class([
                            'flex items-center justify-between border-b border-slate-100 py-4 text-sm transition',
                            'font-semibold text-med-blue' => request()->routeIs('about'),
                            'font-medium text-slate-700' => ! request()->routeIs('about'),
                        ])>
                        <span class="flex items-center gap-3">
                            <i class="ri-information-line text-lg"></i>
                            About Us
                        </span>
                        <i class="ri-arrow-right-s-line text-lg text-slate-300"></i>
                    </a>

                    <button
                        type="button"
                        @click="servicesOpen = !servicesOpen"
                        :aria-expanded="servicesOpen"
                        class="flex w-full items-center justify-between border-b border-slate-100 py-4 text-left text-sm font-medium text-slate-700">
                        <span class="flex items-center gap-3">
                            <i class="ri-stethoscope-line text-lg"></i>
                            Our Services
                        </span>
                        <i class="ri-arrow-down-s-line text-lg transition"
                            :class="{ 'rotate-180': servicesOpen }"></i>
                    </button>

                    <div x-cloak x-show="servicesOpen" x-transition class="border-b border-slate-100 bg-slate-50 px-4">
                        <a href="{{ url('/#services') }}"
                            @click="mobileOpen = false; servicesOpen = false"
                            class="flex items-center gap-3 py-3 text-sm text-slate-600 transition hover:text-med-blue">
                            <i class="ri-stethoscope-line text-med-blue"></i> Medical Care
                        </a>

                        <a href="{{ url('/#services') }}"
                            @click="mobileOpen = false; servicesOpen = false"
                            class="flex items-center gap-3 py-3 text-sm text-slate-600 transition hover:text-med-blue">
                            <i class="ri-heart-pulse-line text-med-red"></i> Diabetes Care
                        </a>

                        <a href="{{ url('/#services') }}"
                            @click="mobileOpen = false; servicesOpen = false"
                            class="flex items-center gap-3 py-3 text-sm text-slate-600 transition hover:text-med-blue">
                            <i class="ri-tooth-line text-cyan-700"></i> Dental Care
                        </a>
                    </div>

                    <a href="{{ url('/#testimonials') }}"
                        @click="mobileOpen = false"
                        class="flex items-center justify-between border-b border-slate-100 py-4 text-sm font-medium text-slate-700 transition hover:text-med-blue">
                        <span class="flex items-center gap-3">
                            <i class="ri-chat-quote-line text-lg"></i>
                            Testimonials
                        </span>
                        <i class="ri-arrow-right-s-line text-lg text-slate-300"></i>
                    </a>

                    <a href="{{ route('contact') }}"
                        @click="mobileOpen = false"
                        @class([
                            'flex items-center justify-between py-4 text-sm transition',
                            'font-semibold text-med-blue' => request()->routeIs('contact'),
                            'font-medium text-slate-700 hover:text-med-blue' => ! request()->routeIs('contact'),
                        ])>
                        <span class="flex items-center gap-3">
                            <i class="ri-map-pin-line text-lg"></i>
                            Contact
                        </span>
                        <i class="ri-arrow-right-s-line text-lg text-slate-300"></i>
                    </a>
                </nav>

                <div class="border-t border-slate-200 bg-slate-50 px-5 py-5">
                    <div class="space-y-3">
                        @if ($settings->phone)
                            <a href="{{ $settings->phoneHref() }}"
                               class="flex items-center gap-3 text-sm font-semibold text-med-navy">
                                <span class="grid h-9 w-9 shrink-0 place-items-center bg-white text-med-blue shadow-sm">
                                    <i class="ri-phone-line"></i>
                                </span>
                                {{ $settings->phone }}
                            </a>
                        @endif

                        @if ($settings->opening_hours)
                            <p class="flex items-start gap-3 text-sm leading-6 text-slate-600">
                                <span class="grid h-9 w-9 shrink-0 place-items-center bg-white text-med-blue shadow-sm">
                                    <i class="ri-time-line"></i>
                                </span>
                                <span>{{ $settings->opening_hours }}</span>
                            </p>
                        @endif
                    </div>

                    <button type="button"
                        @click="mobileOpen = false; $dispatch('open-booking-modal')"
                        class="mt-5 flex w-full items-center justify-center gap-2 bg-med-red px-5 py-3.5 text-sm font-semibold text-white transition hover:bg-red-700">
                        Book an Appointment
                        <i class="ri-arrow-right-up-line text-base"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>
</div>