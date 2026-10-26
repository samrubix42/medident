<div
    x-data="{ mobileOpen: false, servicesOpen: false }"
    @keydown.escape.window="mobileOpen = false; servicesOpen = false"
    class="relative z-50">
    {{-- Top information bar --}}
    <div class="bg-med-navy text-white">
        <div class="mx-auto flex max-w-7xl flex-col justify-between gap-2 px-5 py-2 text-xs sm:flex-row sm:items-center lg:px-8">
            <p class="flex items-center justify-center gap-2 text-white/80 sm:justify-start">
                <i class="ri-heart-pulse-line text-base text-cyan-300"></i>
                Thoughtful care for your entire family
            </p>

            <div class="flex flex-wrap items-center justify-center gap-x-5 gap-y-1 text-white/80">
                <a href="tel:+910000000000" class="transition hover:text-white">
                    <i class="ri-phone-line mr-1 text-cyan-300"></i>
                    +91 00000 00000
                </a>

                <span class="hidden text-white/30 sm:inline">|</span>

                <span>
                    <i class="ri-time-line mr-1 text-cyan-300"></i>
                    Mon–Sat, 9 AM–8 PM
                </span>
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

                <a href="{{ url('/#contact') }}"
                    class="text-sm font-medium text-slate-600 transition hover:text-med-blue">
                    Contact
                </a>
            </nav>

            {{-- Desktop appointment button --}}
            <a href="{{ url('/#contact') }}"
                class="hidden items-center gap-2 bg-med-red px-5 py-3 text-sm font-semibold text-white transition hover:bg-red-700 lg:inline-flex">
                Book an Appointment
                <i class="ri-arrow-right-up-line text-base"></i>
            </a>

            {{-- Mobile menu button --}}
            <button
                type="button"
                @click="mobileOpen = !mobileOpen"
                :aria-expanded="mobileOpen"
                aria-label="Toggle navigation"
                class="grid h-10 w-10 shrink-0 place-items-center border border-slate-200 text-xl text-med-navy lg:hidden">
                <i :class="mobileOpen ? 'ri-close-line' : 'ri-menu-3-line'"></i>
            </button>
        </div>

        {{-- Mobile navigation --}}
        <div
            x-cloak
            x-show="mobileOpen"
            x-transition
            class="border-t border-slate-200 bg-white px-5 py-4 shadow-lg lg:hidden">
            <nav class="mx-auto flex max-w-7xl flex-col" aria-label="Mobile navigation">

                <a href="{{ route('home') }}"
                    @click="mobileOpen = false"
                    @class([
                        'border-b border-slate-100 py-3 text-sm',
                        'font-semibold text-med-blue' => request()->routeIs('home'),
                        'font-medium text-slate-700' => ! request()->routeIs('home'),
                    ])>
                    Home
                </a>

                <a href="{{ route('about') }}"
                    @click="mobileOpen = false"
                    @class([
                        'border-b border-slate-100 py-3 text-sm',
                        'font-semibold text-med-blue' => request()->routeIs('about'),
                        'font-medium text-slate-700' => ! request()->routeIs('about'),
                    ])>
                    About Us
                </a>

                <button
                    type="button"
                    @click="servicesOpen = !servicesOpen"
                    :aria-expanded="servicesOpen"
                    class="flex items-center justify-between border-b border-slate-100 py-3 text-left text-sm font-medium text-slate-700">
                    Our Services
                    <i class="ri-arrow-down-s-line text-lg"
                        :class="{ 'rotate-180': servicesOpen }"></i>
                </button>

                <div x-cloak x-show="servicesOpen" x-transition class="bg-slate-50 px-4">
                    <a href="{{ url('/#services') }}"
                        @click="mobileOpen = false; servicesOpen = false"
                        class="block py-3 text-sm text-slate-600">
                        <i class="ri-stethoscope-line mr-2 text-med-blue"></i> Medical Care
                    </a>

                    <a href="{{ url('/#services') }}"
                        @click="mobileOpen = false; servicesOpen = false"
                        class="block py-3 text-sm text-slate-600">
                        <i class="ri-heart-pulse-line mr-2 text-med-red"></i> Diabetes Care
                    </a>

                    <a href="{{ url('/#services') }}"
                        @click="mobileOpen = false; servicesOpen = false"
                        class="block py-3 text-sm text-slate-600">
                        <i class="ri-tooth-line mr-2 text-cyan-700"></i> Dental Care
                    </a>
                </div>

                <a href="{{ url('/#testimonials') }}"
                    @click="mobileOpen = false"
                    class="border-b border-slate-100 py-3 text-sm font-medium text-slate-700">
                    Testimonials
                </a>

                <a href="{{ url('/#contact') }}"
                    @click="mobileOpen = false"
                    class="mt-4 flex items-center justify-center gap-2 bg-med-red px-5 py-3 text-sm font-semibold text-white">
                    Book an Appointment
                    <i class="ri-arrow-right-up-line"></i>
                </a>
            </nav>
        </div>
    </header>
</div>