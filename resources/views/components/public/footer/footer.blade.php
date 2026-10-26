<div>
    
{{-- Appointment banner --}}
<section id="contact" class="px-5 py-14 sm:py-20 lg:px-8">
    <div class="relative mx-auto max-w-7xl overflow-hidden bg-med-navy px-6 py-10 sm:px-10 sm:py-14 lg:px-14">

        <div class="absolute -right-16 -top-24 h-72 w-72 rounded-full border-[40px] border-white/[0.04]"></div>

        <div class="relative grid gap-8 md:grid-cols-[1fr_auto] md:items-center">
            <div class="max-w-2xl">
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-cyan-300">
                    Your health matters
                </p>

                <h2 class="mt-4 text-3xl font-bold leading-tight tracking-tight text-white sm:text-4xl">
                    Let's take care of your health, together.
                </h2>

                <p class="mt-4 max-w-xl text-sm leading-7 text-slate-300 sm:text-base">
                    Connect with MediDENT Multicare Clinic to discuss your healthcare needs and arrange a visit.
                </p>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row md:flex-col">
                <a href="tel:+910000000000"
                   class="inline-flex items-center justify-center gap-2 bg-med-red px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-red-700">
                    <i class="ri-phone-line"></i>
                    Call the Clinic
                </a>

                <a href="mailto:hello@medidentclinic.com"
                   class="inline-flex items-center justify-center gap-2 border border-white/25 px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-white/10">
                    <i class="ri-mail-line"></i>
                    Email Us
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Main footer --}}
<footer class="border-t border-slate-200 bg-white">

    <div class="mx-auto grid max-w-7xl gap-10 px-5 py-12 sm:px-6 md:grid-cols-2 lg:grid-cols-4 lg:px-8">

        {{-- Brand --}}
        <div class="lg:col-span-2">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-3" aria-label="MediDENT home">
                <img
                    src="{{ asset('logo.webp') }}"
                    alt="MediDENT Multicare Clinic"
                    class="h-12 w-auto object-contain">

                <span>
                    <span class="block text-lg font-bold leading-none tracking-tight text-med-navy">MediDENT</span>
                    <span class="mt-1 block text-[10px] font-semibold uppercase tracking-[0.18em] text-med-blue">
                        Multicare Clinic
                    </span>
                </span>
            </a>

            <p class="mt-5 max-w-md text-sm leading-7 text-slate-500">
                Medical, diabetes and dental care under one roof. Our goal is to make healthcare more accessible, comfortable, and personal for every family.
            </p>

            <div class="mt-5 flex items-center gap-3">
                <a href="https://www.facebook.com/"
                   aria-label="Facebook"
                   class="grid h-10 w-10 place-items-center border border-slate-200 text-lg text-slate-600 transition hover:border-med-blue hover:text-med-blue">
                    <i class="ri-facebook-fill"></i>
                </a>

                <a href="https://www.instagram.com/"
                   aria-label="Instagram"
                   class="grid h-10 w-10 place-items-center border border-slate-200 text-lg text-slate-600 transition hover:border-med-blue hover:text-med-blue">
                    <i class="ri-instagram-line"></i>
                </a>

                <a href="https://wa.me/910000000000"
                   aria-label="WhatsApp"
                   class="grid h-10 w-10 place-items-center border border-slate-200 text-lg text-slate-600 transition hover:border-emerald-600 hover:text-emerald-600">
                    <i class="ri-whatsapp-line"></i>
                </a>
            </div>
        </div>

        {{-- Quick links --}}
        <div>
            <h3 class="text-sm font-bold text-med-navy">Quick Links</h3>

            <ul class="mt-5 space-y-3 text-sm text-slate-500">
                <li><a href="{{ route('home') }}" class="transition hover:text-med-blue">Home</a></li>
                <li><a href="{{ route('about') }}" class="transition hover:text-med-blue">About Us</a></li>
                <li><a href="{{ url('/#services') }}" class="transition hover:text-med-blue">Our Services</a></li>
                <li><a href="{{ url('/#testimonials') }}" class="transition hover:text-med-blue">Testimonials</a></li>
                <li><a href="{{ url('/#contact') }}" class="transition hover:text-med-blue">Contact Us</a></li>
            </ul>
        </div>

        {{-- Contact information --}}
        <div>
            <h3 class="text-sm font-bold text-med-navy">Get in Touch</h3>

            <ul class="mt-5 space-y-4 text-sm text-slate-500">
                <li class="flex items-start gap-3">
                    <i class="ri-phone-line mt-0.5 text-lg text-med-blue"></i>
                    <a href="tel:+910000000000" class="transition hover:text-med-blue">
                        +91 00000 00000
                    </a>
                </li>

                <li class="flex items-start gap-3">
                    <i class="ri-mail-line mt-0.5 text-lg text-med-blue"></i>
                    <a href="mailto:hello@medidentclinic.com"
                       class="break-all transition hover:text-med-blue">
                        hello@medidentclinic.com
                    </a>
                </li>

                <li class="flex items-start gap-3">
                    <i class="ri-time-line mt-0.5 text-lg text-med-blue"></i>
                    <span>Monday – Saturday<br>9:00 AM – 8:00 PM</span>
                </li>

                <li class="flex items-start gap-3">
                    <i class="ri-map-pin-line mt-0.5 text-lg text-med-blue"></i>
                    <span>Clinic address goes here</span>
                </li>
            </ul>
        </div>
    </div>

    {{-- Copyright --}}
    <div class="border-t border-slate-200">
        <div class="mx-auto flex max-w-7xl flex-col gap-3 px-5 py-5 text-xs text-slate-500 sm:px-6 md:flex-row md:items-center md:justify-between lg:px-8">
            <p>
                &copy; {{ date('Y') }} MediDENT Multicare Clinic. All rights reserved.
            </p>

            <p class="flex items-center gap-2">
                <i class="ri-heart-pulse-line text-med-blue"></i>
                Medical · Diabetes · Dental Care
            </p>
        </div>
    </div>
</footer>

</div>