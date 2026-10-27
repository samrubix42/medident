@php($settings = $this->settings)

<div
    x-data="{ mobileOpen: false, servicesOpen: false }"
    x-effect="document.body.classList.toggle('overflow-hidden', mobileOpen)"
    @keydown.escape.window="mobileOpen = false; servicesOpen = false"
    @resize.window.debounce.150ms="if (window.innerWidth >= 1024) { mobileOpen = false; servicesOpen = false }"
    class="sticky top-0 z-50 py-3 sm:py-4 transition-all">

    {{-- Main navigation --}}
    <header class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between gap-5 rounded-full border border-slate-200/80 bg-white/95 px-4 py-2.5 shadow-[0_10px_35px_rgba(18,50,74,0.06)] backdrop-blur-xl sm:px-6 lg:px-8">

            {{-- Brand logo --}}
            <a href="{{ url('/') }}" class="group flex shrink-0 items-center gap-3" aria-label="MediDENT home">
                <img
                    src="{{ asset('logo.webp') }}"
                    alt="MediDENT Multicare Clinic"
                    class="h-10 w-auto object-contain transition group-hover:scale-105 sm:h-12">

                <span>
                    <span class="block text-base font-bold leading-none tracking-tight text-med-navy transition group-hover:text-med-blue sm:text-lg">MediDENT</span>
                    <span class="mt-1 block text-[9px] font-semibold uppercase tracking-[0.2em] text-med-blue sm:text-[10px]">
                        Multicare Clinic
                    </span>
                </span>
            </a>

            {{-- Desktop menu --}}
            <nav class="hidden items-center gap-1 xl:gap-2 lg:flex" aria-label="Main navigation">

                <a href="{{ route('home') }}"
                    @class([
                        'rounded-full px-4 py-2 text-sm font-semibold transition-all',
                        'bg-med-blue/5 text-med-blue' => request()->routeIs('home'),
                        'text-slate-700 hover:bg-slate-50 hover:text-med-blue' => ! request()->routeIs('home'),
                    ])>
                    Home
                </a>

                <a href="{{ route('about') }}"
                    @class([
                        'rounded-full px-4 py-2 text-sm font-semibold transition-all',
                        'bg-med-blue/5 text-med-blue' => request()->routeIs('about'),
                        'text-slate-700 hover:bg-slate-50 hover:text-med-blue' => ! request()->routeIs('about'),
                    ])>
                    About Us
                </a>

                {{-- Services dropdown --}}
                <div class="relative"
                     @mouseenter="servicesOpen = true"
                     @mouseleave="servicesOpen = false">
                    <button
                        type="button"
                        @click="servicesOpen = !servicesOpen"
                        :aria-expanded="servicesOpen"
                        @class([
                            'flex items-center gap-1.5 rounded-full px-4 py-2 text-sm font-semibold transition-all',
                            'bg-med-blue/5 text-med-blue' => request()->routeIs('services', 'services.show'),
                            'text-slate-700 hover:bg-slate-50 hover:text-med-blue' => ! request()->routeIs('services', 'services.show'),
                        ])>
                        Services
                        <i class="ri-arrow-down-s-line text-lg transition-transform"
                            :class="{ 'rotate-180': servicesOpen }"></i>
                    </button>

                    <div
                        x-cloak
                        x-show="servicesOpen"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-1"
                        @click.outside="servicesOpen = false"
                        class="absolute left-0 top-full w-72 pt-2">
                        <div class="overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-[0_20px_60px_rgba(18,50,74,0.12)]">
                            <div class="p-2">
                                <a href="{{ route('services', ['category' => 'physician']) }}"
                                    @click="servicesOpen = false"
                                    class="group flex items-center gap-3 rounded-xl p-3 transition hover:bg-sky-50/70">
                                    <span class="grid h-11 w-11 shrink-0 place-items-center rounded-xl bg-gradient-to-br from-sky-50 to-sky-100/50 text-xl text-med-blue transition group-hover:scale-105">
                                        <i class="ri-stethoscope-line"></i>
                                    </span>
                                    <span>
                                        <span class="block text-sm font-semibold text-med-navy">Medical Care</span>
                                        <span class="mt-0.5 block text-xs text-slate-500">Everyday healthcare</span>
                                    </span>
                                </a>

                                <a href="{{ route('services') }}"
                                    @click="servicesOpen = false"
                                    class="group flex items-center gap-3 rounded-xl p-3 transition hover:bg-red-50/70">
                                    <span class="grid h-11 w-11 shrink-0 place-items-center rounded-xl bg-gradient-to-br from-red-50 to-red-100/50 text-xl text-med-red transition group-hover:scale-105">
                                        <i class="ri-heart-pulse-line"></i>
                                    </span>
                                    <span>
                                        <span class="block text-sm font-semibold text-med-navy">Diabetes Care</span>
                                        <span class="mt-0.5 block text-xs text-slate-500">Ongoing health support</span>
                                    </span>
                                </a>

                                <a href="{{ route('services', ['category' => 'dental']) }}"
                                    @click="servicesOpen = false"
                                    class="group flex items-center gap-3 rounded-xl p-3 transition hover:bg-cyan-50/70">
                                    <span class="grid h-11 w-11 shrink-0 place-items-center rounded-xl bg-gradient-to-br from-cyan-50 to-cyan-100/50 text-xl text-cyan-700 transition group-hover:scale-105">
                                        <i class="ri-tooth-line"></i>
                                    </span>
                                    <span>
                                        <span class="block text-sm font-semibold text-med-navy">Dental Care</span>
                                        <span class="mt-0.5 block text-xs text-slate-500">Complete oral healthcare</span>
                                    </span>
                                </a>
                            </div>
                            <a href="{{ route('services') }}"
                                @click="servicesOpen = false"
                                class="flex items-center justify-between border-t border-slate-100 px-5 py-3.5 text-sm font-semibold text-med-blue transition hover:bg-slate-50/50">
                                View all services
                                <i class="ri-arrow-right-line"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <a href="{{ route('gallery') }}"
                    @class([
                        'rounded-full px-4 py-2 text-sm font-semibold transition-all',
                        'bg-med-blue/5 text-med-blue' => request()->routeIs('gallery'),
                        'text-slate-700 hover:bg-slate-50 hover:text-med-blue' => ! request()->routeIs('gallery'),
                    ])>
                    Gallery
                </a>

                <a href="{{ route('blog') }}"
                    @class([
                        'rounded-full px-4 py-2 text-sm font-semibold transition-all',
                        'bg-med-blue/5 text-med-blue' => request()->routeIs('blog', 'blog.show'),
                        'text-slate-700 hover:bg-slate-50 hover:text-med-blue' => ! request()->routeIs('blog', 'blog.show'),
                    ])>
                    Blog
                </a>

                <a href="{{ url('/#testimonials') }}"
                    class="rounded-full px-4 py-2 text-sm font-semibold text-slate-700 transition-all hover:bg-slate-50 hover:text-med-blue">
                    Testimonials
                </a>

                <a href="{{ route('contact') }}"
                    @class([
                        'rounded-full px-4 py-2 text-sm font-semibold transition-all',
                        'bg-med-blue/5 text-med-blue' => request()->routeIs('contact'),
                        'text-slate-700 hover:bg-slate-50 hover:text-med-blue' => ! request()->routeIs('contact'),
                    ])>
                    Contact
                </a>
            </nav>

            {{-- Desktop appointment button --}}
            <button type="button"
                @click="$dispatch('open-booking-modal')"
                class="group hidden items-center gap-2 rounded-full bg-gradient-to-r from-med-red to-red-600 px-6 py-2.5 text-sm font-semibold text-white shadow-lg shadow-red-500/20 transition-all hover:-translate-y-0.5 hover:shadow-xl hover:shadow-red-500/30 lg:inline-flex">
                Book Appointment
                <i class="ri-arrow-right-up-line text-base transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5"></i>
            </button>

            {{-- Mobile menu button --}}
            <button
                type="button"
                @click="mobileOpen = true; servicesOpen = false"
                :aria-expanded="mobileOpen"
                aria-label="Open navigation"
                class="grid h-10 w-10 shrink-0 place-items-center rounded-full border border-slate-200 text-xl text-med-navy transition hover:border-med-blue hover:bg-slate-50 lg:hidden">
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
                        <a href="{{ route('services', ['category' => 'physician']) }}"
                            @click="mobileOpen = false; servicesOpen = false"
                            class="flex items-center gap-3 py-3 text-sm text-slate-600 transition hover:text-med-blue">
                            <i class="ri-stethoscope-line text-med-blue"></i> Medical Care
                        </a>

                        <a href="{{ route('services') }}"
                            @click="mobileOpen = false; servicesOpen = false"
                            class="flex items-center gap-3 py-3 text-sm text-slate-600 transition hover:text-med-blue">
                            <i class="ri-heart-pulse-line text-med-red"></i> Diabetes Care
                        </a>

                        <a href="{{ route('services', ['category' => 'dental']) }}"
                            @click="mobileOpen = false; servicesOpen = false"
                            class="flex items-center gap-3 py-3 text-sm text-slate-600 transition hover:text-med-blue">
                            <i class="ri-tooth-line text-cyan-700"></i> Dental Care
                        </a>

                        <a href="{{ route('services') }}"
                            @click="mobileOpen = false; servicesOpen = false"
                            class="flex items-center justify-between border-t border-slate-200 py-3 text-sm font-semibold text-med-blue">
                            View all services
                            <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>

                    <a href="{{ route('gallery') }}"
                        @click="mobileOpen = false"
                        @class([
                            'flex items-center justify-between border-b border-slate-100 py-4 text-sm transition',
                            'font-semibold text-med-blue' => request()->routeIs('gallery'),
                            'font-medium text-slate-700 hover:text-med-blue' => ! request()->routeIs('gallery'),
                        ])>
                        <span class="flex items-center gap-3">
                            <i class="ri-gallery-line text-lg"></i>
                            Gallery
                        </span>
                        <i class="ri-arrow-right-s-line text-lg text-slate-300"></i>
                    </a>

                    <a href="{{ route('blog') }}"
                        @click="mobileOpen = false"
                        @class([
                            'flex items-center justify-between border-b border-slate-100 py-4 text-sm transition',
                            'font-semibold text-med-blue' => request()->routeIs('blog', 'blog.show'),
                            'font-medium text-slate-700 hover:text-med-blue' => ! request()->routeIs('blog', 'blog.show'),
                        ])>
                        <span class="flex items-center gap-3">
                            <i class="ri-article-line text-lg"></i>
                            Blog
                        </span>
                        <i class="ri-arrow-right-s-line text-lg text-slate-300"></i>
                    </a>

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
                        class="mt-5 flex w-full items-center justify-center gap-2 rounded-full bg-gradient-to-r from-med-red to-red-600 px-5 py-3.5 text-sm font-semibold text-white transition hover:shadow-lg">
                        Book Appointment
                        <i class="ri-arrow-right-up-line text-base"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>
</div>