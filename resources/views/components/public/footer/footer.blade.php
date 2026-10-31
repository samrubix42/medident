@php($settings = $this->settings)

<div>
    
{{-- Appointment banner --}}
<section id="contact" class="px-5 py-12 sm:py-16 lg:px-8 lg:py-20">
    <div class="relative mx-auto max-w-7xl overflow-hidden rounded-3xl bg-gradient-to-br from-med-navy via-[#0f2a3d] to-med-navy px-6 py-10 shadow-[0_30px_80px_rgba(18,50,74,0.25)] sm:px-10 sm:py-14 lg:px-16 lg:py-16">

        <div class="absolute -right-20 -top-32 h-80 w-80 rounded-full bg-cyan-400/5 blur-3xl"></div>
        <div class="absolute -bottom-24 -left-16 h-72 w-72 rounded-full bg-med-blue/5 blur-3xl"></div>

        <div class="relative grid gap-8 md:grid-cols-[1fr_auto] md:items-center">
            <div class="max-w-2xl">
                <h2 class="text-3xl font-extrabold leading-tight tracking-tight text-white sm:text-4xl lg:text-5xl">
                    Let's take care of your health, together<span class="text-cyan-400">.</span>
                </h2>

                <p class="mt-4 max-w-xl text-sm leading-7 text-slate-300 sm:text-base">
                    Connect with MediDENT Multicare Clinic to discuss your healthcare needs and arrange a visit for comprehensive medical and dental care.
                </p>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row md:flex-col">
                @if ($settings->phone)
                    <a href="{{ $settings->phoneHref() }}"
                       class="group inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-med-red to-red-600 px-8 py-3.5 text-sm font-semibold text-white shadow-lg shadow-red-500/25 transition-all hover:-translate-y-0.5 hover:shadow-xl hover:shadow-red-500/35">
                        <i class="ri-phone-line"></i>
                        Call the Clinic
                        <i class="ri-arrow-right-up-line transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5"></i>
                    </a>
                @endif

                @if ($settings->email)
                    <a href="mailto:{{ $settings->email }}"
                       class="inline-flex items-center justify-center gap-2 rounded-full border border-white/30 bg-white/5 px-8 py-3.5 text-sm font-semibold text-white backdrop-blur-sm transition-all hover:bg-white/10">
                        <i class="ri-mail-line"></i>
                        Email Us
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- Main footer --}}
<footer class="border-t border-slate-100 bg-gradient-to-b from-white to-slate-50/50">

    <div class="mx-auto grid max-w-7xl gap-10 px-5 py-12 sm:px-6 md:grid-cols-2 lg:grid-cols-4 lg:px-8 lg:py-16">

        {{-- Brand --}}
        <div class="lg:col-span-2">
            <a href="{{ url('/') }}" class="group inline-flex items-center gap-3" aria-label="MediDENT home">
                <img
                    src="{{ asset('logo.webp') }}"
                    alt="MediDENT Multicare Clinic"
                    class="h-12 w-auto object-contain transition group-hover:scale-105">

                <span>
                    <span class="block text-lg font-bold leading-none tracking-tight text-med-navy transition group-hover:text-med-blue">MediDENT</span>
                    <span class="mt-1 block text-[10px] font-semibold uppercase tracking-[0.2em] text-med-blue">
                        Multicare Clinic
                    </span>
                </span>
            </a>

            <p class="mt-6 max-w-md text-sm leading-7 text-slate-600">
                Medical, diabetes and dental care under one roof. Our goal is to make healthcare more accessible, comfortable, and personal for every family with compassionate, expert care.
            </p>

            <div class="mt-6 flex items-center gap-2">
                @if ($settings->facebook_url)
                    <a href="{{ $settings->facebook_url }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       aria-label="Facebook"
                       class="grid h-10 w-10 place-items-center rounded-full border border-slate-200 text-lg text-slate-600 transition-all hover:-translate-y-0.5 hover:border-med-blue hover:bg-med-blue/5 hover:text-med-blue">
                        <i class="ri-facebook-fill"></i>
                    </a>
                @endif

                @if ($settings->instagram_url)
                    <a href="{{ $settings->instagram_url }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       aria-label="Instagram"
                       class="grid h-10 w-10 place-items-center rounded-full border border-slate-200 text-lg text-slate-600 transition-all hover:-translate-y-0.5 hover:border-pink-500 hover:bg-pink-50 hover:text-pink-600">
                        <i class="ri-instagram-line"></i>
                    </a>
                @endif

                @if ($settings->linkedin_url)
                    <a href="{{ $settings->linkedin_url }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       aria-label="LinkedIn"
                       class="grid h-10 w-10 place-items-center rounded-full border border-slate-200 text-lg text-slate-600 transition-all hover:-translate-y-0.5 hover:border-blue-600 hover:bg-blue-50 hover:text-blue-600">
                        <i class="ri-linkedin-fill"></i>
                    </a>
                @endif

                @if ($settings->whatsappUrl())
                    <a href="{{ $settings->whatsappUrl() }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       aria-label="WhatsApp"
                       class="grid h-10 w-10 place-items-center rounded-full border border-slate-200 text-lg text-slate-600 transition-all hover:-translate-y-0.5 hover:border-emerald-600 hover:bg-emerald-50 hover:text-emerald-600">
                        <i class="ri-whatsapp-line"></i>
                    </a>
                @endif
            </div>
        </div>

        {{-- Quick links --}}
        <div>
            <h3 class="text-sm font-bold uppercase tracking-wider text-med-navy">Quick Links</h3>

            <ul class="mt-6 space-y-3 text-sm text-slate-600">
                <li><a href="{{ route('home') }}" class="group inline-flex items-center gap-2 transition hover:text-med-blue"><span class="h-px w-0 bg-med-blue transition-all group-hover:w-2"></span>Home</a></li>
                <li><a href="{{ route('about') }}" class="group inline-flex items-center gap-2 transition hover:text-med-blue"><span class="h-px w-0 bg-med-blue transition-all group-hover:w-2"></span>About Us</a></li>
                <li><a href="{{ route('services') }}" class="group inline-flex items-center gap-2 transition hover:text-med-blue"><span class="h-px w-0 bg-med-blue transition-all group-hover:w-2"></span>Our Services</a></li>
                <li><a href="{{ route('physician') }}" class="group inline-flex items-center gap-2 transition hover:text-med-blue"><span class="h-px w-0 bg-med-blue transition-all group-hover:w-2"></span>Physician in Ghaziabad</a></li>
                <li><a href="{{ route('dentist') }}" class="group inline-flex items-center gap-2 transition hover:text-med-blue"><span class="h-px w-0 bg-med-blue transition-all group-hover:w-2"></span>Dentist in Ghaziabad</a></li>
                <li><a href="{{ route('gastroenterologist') }}" class="group inline-flex items-center gap-2 transition hover:text-med-blue"><span class="h-px w-0 bg-med-blue transition-all group-hover:w-2"></span>Pediatric Gastroenterologist in Ghaziabad</a></li>
                <li><a href="{{ route('gallery') }}" class="group inline-flex items-center gap-2 transition hover:text-med-blue"><span class="h-px w-0 bg-med-blue transition-all group-hover:w-2"></span>Gallery</a></li>
                <li><a href="{{ route('blog') }}" class="group inline-flex items-center gap-2 transition hover:text-med-blue"><span class="h-px w-0 bg-med-blue transition-all group-hover:w-2"></span>Blog</a></li>
                <li><a href="{{ url('/#testimonials') }}" class="group inline-flex items-center gap-2 transition hover:text-med-blue"><span class="h-px w-0 bg-med-blue transition-all group-hover:w-2"></span>Testimonials</a></li>
                <li><a href="{{ route('contact') }}" class="group inline-flex items-center gap-2 transition hover:text-med-blue"><span class="h-px w-0 bg-med-blue transition-all group-hover:w-2"></span>Contact Us</a></li>
            </ul>
        </div>

        {{-- Contact information --}}
        <div>
            <h3 class="text-sm font-bold uppercase tracking-wider text-med-navy">Get in Touch</h3>

            <ul class="mt-6 space-y-4 text-sm text-slate-600">
                @if ($settings->phone)
                    <li class="group flex items-start gap-3">
                        <span class="mt-0.5 grid h-9 w-9 shrink-0 place-items-center rounded-full bg-med-blue/10 text-med-blue transition group-hover:bg-med-blue group-hover:text-white">
                            <i class="ri-phone-line"></i>
                        </span>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Phone</p>
                            <a href="{{ $settings->phoneHref() }}" class="mt-1 block transition hover:text-med-blue">
                                {{ $settings->phone }}
                            </a>
                        </div>
                    </li>
                @endif

                @if ($settings->secondary_phone)
                    <li class="group flex items-start gap-3">
                        <span class="mt-0.5 grid h-9 w-9 shrink-0 place-items-center rounded-full bg-med-blue/10 text-med-blue transition group-hover:bg-med-blue group-hover:text-white">
                            <i class="ri-phone-line"></i>
                        </span>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Alternate</p>
                            <a href="{{ $settings->secondaryPhoneHref() }}" class="mt-1 block transition hover:text-med-blue">
                                {{ $settings->secondary_phone }}
                            </a>
                        </div>
                    </li>
                @endif

                @if ($settings->email)
                    <li class="group flex items-start gap-3">
                        <span class="mt-0.5 grid h-9 w-9 shrink-0 place-items-center rounded-full bg-med-blue/10 text-med-blue transition group-hover:bg-med-blue group-hover:text-white">
                            <i class="ri-mail-line"></i>
                        </span>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Email</p>
                            <a href="mailto:{{ $settings->email }}"
                               class="mt-1 block break-all transition hover:text-med-blue">
                                {{ $settings->email }}
                            </a>
                        </div>
                    </li>
                @endif

                @if ($settings->opening_hours)
                    <li class="group flex items-start gap-3">
                        <span class="mt-0.5 grid h-9 w-9 shrink-0 place-items-center rounded-full bg-med-blue/10 text-med-blue transition group-hover:bg-med-blue group-hover:text-white">
                            <i class="ri-time-line"></i>
                        </span>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Hours</p>
                            <span class="mt-1 block leading-6">
                                @foreach ($settings->openingHoursLines() as $hours)
                                    {{ $hours }}@if (! $loop->last)<br>@endif
                                @endforeach
                            </span>
                        </div>
                    </li>
                @endif

                @if ($settings->address)
                    <li class="group flex items-start gap-3">
                        <span class="mt-0.5 grid h-9 w-9 shrink-0 place-items-center rounded-full bg-med-blue/10 text-med-blue transition group-hover:bg-med-blue group-hover:text-white">
                            <i class="ri-map-pin-line"></i>
                        </span>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Location</p>
                            <span class="mt-1 block leading-6">{{ $settings->address }}</span>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>

    {{-- Copyright --}}
    <div class="border-t border-slate-200">
        <div class="mx-auto flex max-w-7xl flex-col gap-3 px-5 py-6 text-xs text-slate-500 sm:px-6 md:flex-row md:items-center md:justify-between lg:px-8">
            <p>
                &copy; {{ date('Y') }} MediDENT Multicare Clinic. All rights reserved.
            </p>

            <p>
                Powered by
                <a href="https://techonika.com/"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="font-semibold text-med-red transition hover:text-med-navy">
                    Techonika
                </a>
            </p>
        </div>
    </div>
</footer>

</div>