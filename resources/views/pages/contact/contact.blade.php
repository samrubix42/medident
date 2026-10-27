@php
    $settings = $this->settings;
    $inputClasses = 'mt-2 h-11 w-full border border-slate-200 bg-white px-3.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100';
    $textareaClasses = 'mt-2 w-full resize-none border border-slate-200 bg-white px-3.5 py-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100';
@endphp

<div>
    {{-- Hero --}}
    <section class="relative overflow-hidden border-b border-slate-100 bg-[#f5fafc]">
        <div class="pointer-events-none absolute -right-24 -top-24 h-80 w-80 rounded-full border-[46px] border-sky-100/70"></div>
        <div class="pointer-events-none absolute -bottom-28 left-1/3 h-64 w-64 rounded-full border-[34px] border-white"></div>

        <div class="relative mx-auto max-w-7xl px-5 py-12 sm:px-6 sm:py-20 lg:px-8 lg:py-24">
            <div class="inline-flex max-w-full items-center gap-2 border border-sky-100 bg-white px-3 py-2 text-[10px] font-semibold uppercase tracking-[0.14em] text-med-blue sm:text-xs sm:tracking-[0.16em]">
                <i class="ri-customer-service-2-line shrink-0 text-base"></i>
                Contact Us
            </div>

            <h1 class="mt-5 max-w-3xl text-[2rem] font-bold leading-[1.15] tracking-tight text-med-navy sm:mt-6 sm:text-5xl lg:text-[3.5rem]">
                We're here to help with your
                <span class="text-med-blue">healthcare questions.</span>
            </h1>

            <p class="mt-5 max-w-2xl text-sm leading-7 text-slate-600 sm:mt-6 sm:text-base sm:leading-8">
                Call us, send a message, or visit the clinic. Our team will help you find the right care and answer any questions about appointments or services.
            </p>

            <div class="mt-7 flex flex-col gap-3 sm:flex-row">
                @if ($settings->phone)
                    <a href="{{ $settings->phoneHref() }}"
                       class="inline-flex w-full items-center justify-center gap-3 bg-med-blue px-5 py-3.5 text-sm font-semibold text-white transition hover:bg-sky-800 sm:w-auto sm:px-6">
                        <i class="ri-phone-line text-lg"></i>
                        Call the Clinic
                    </a>
                @endif

                <button type="button"
                        @click="$dispatch('open-booking-modal')"
                        class="inline-flex w-full items-center justify-center gap-2 border border-slate-300 bg-white px-5 py-3.5 text-sm font-semibold text-med-navy transition hover:border-med-blue hover:text-med-blue sm:w-auto sm:px-6">
                    Book an Appointment
                    <i class="ri-arrow-right-up-line text-lg"></i>
                </button>
            </div>
        </div>
    </section>

    {{-- Contact details and form --}}
    <section class="py-12 sm:py-20 lg:py-24">
        <div class="mx-auto grid max-w-7xl gap-8 px-5 sm:px-6 lg:grid-cols-[.82fr_1.18fr] lg:gap-12 lg:px-8">

            {{-- Contact information --}}
            <aside>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-red">
                    Clinic Details
                </p>

                <h2 class="mt-3 text-3xl font-bold tracking-tight text-med-navy">
                    Visit or reach out.
                </h2>

                <p class="mt-4 text-sm leading-7 text-slate-600">
                    We are available six days a week for consultations, dental care, and general health support.
                </p>

                <div class="mt-7 space-y-4">
                    @if ($settings->address)
                        <div class="flex gap-4 border border-slate-200 bg-white p-5">
                            <span class="grid h-11 w-11 shrink-0 place-items-center bg-sky-50 text-xl text-med-blue">
                                <i class="ri-map-pin-line"></i>
                            </span>

                            <div class="min-w-0">
                                <h3 class="text-sm font-bold text-med-navy">Clinic Address</h3>
                                <p class="mt-1.5 text-sm leading-6 text-slate-600">{{ $settings->address }}</p>

                                <a href="{{ $this->mapDirectionsUrl }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="mt-2 inline-flex items-center gap-1.5 text-xs font-semibold text-med-blue transition hover:text-sky-800">
                                    Get directions
                                    <i class="ri-arrow-right-up-line"></i>
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="flex gap-4 border border-slate-200 bg-white p-5">
                        <span class="grid h-11 w-11 shrink-0 place-items-center bg-red-50 text-xl text-med-red">
                            <i class="ri-phone-line"></i>
                        </span>

                        <div class="min-w-0">
                            <h3 class="text-sm font-bold text-med-navy">Phone</h3>

                            <div class="mt-1.5 flex flex-col gap-1 text-sm text-slate-600">
                                @if ($settings->phone)
                                    <a href="{{ $settings->phoneHref() }}" class="transition hover:text-med-blue">
                                        {{ $settings->phone }}
                                    </a>
                                @endif

                                @if ($settings->secondary_phone)
                                    <a href="{{ $settings->secondaryPhoneHref() }}" class="transition hover:text-med-blue">
                                        {{ $settings->secondary_phone }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if ($settings->email)
                        <div class="flex gap-4 border border-slate-200 bg-white p-5">
                            <span class="grid h-11 w-11 shrink-0 place-items-center bg-emerald-50 text-xl text-emerald-600">
                                <i class="ri-mail-line"></i>
                            </span>

                            <div class="min-w-0">
                                <h3 class="text-sm font-bold text-med-navy">Email</h3>
                                <a href="mailto:{{ $settings->email }}"
                                   class="mt-1.5 block break-all text-sm text-slate-600 transition hover:text-med-blue">
                                    {{ $settings->email }}
                                </a>
                            </div>
                        </div>
                    @endif

                    @if ($settings->opening_hours)
                        <div class="flex gap-4 border border-slate-200 bg-white p-5">
                            <span class="grid h-11 w-11 shrink-0 place-items-center bg-amber-50 text-xl text-amber-600">
                                <i class="ri-time-line"></i>
                            </span>

                            <div class="min-w-0">
                                <h3 class="text-sm font-bold text-med-navy">Opening Hours</h3>

                                <div class="mt-1.5 space-y-1 text-sm leading-6 text-slate-600">
                                    @foreach ($settings->openingHoursLines() as $hours)
                                        <p>{{ $hours }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                @if ($settings->facebook_url || $settings->instagram_url || $settings->linkedin_url || $settings->whatsappUrl())
                    <div class="mt-6">
                        <p class="text-xs font-bold uppercase tracking-[0.16em] text-slate-400">Follow the clinic</p>

                        <div class="mt-3 flex flex-wrap items-center gap-3">
                            @if ($settings->facebook_url)
                                <a href="{{ $settings->facebook_url }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   aria-label="Facebook"
                                   class="grid h-10 w-10 place-items-center border border-slate-200 bg-white text-lg text-slate-600 transition hover:border-med-blue hover:text-med-blue">
                                    <i class="ri-facebook-fill"></i>
                                </a>
                            @endif

                            @if ($settings->instagram_url)
                                <a href="{{ $settings->instagram_url }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   aria-label="Instagram"
                                   class="grid h-10 w-10 place-items-center border border-slate-200 bg-white text-lg text-slate-600 transition hover:border-med-blue hover:text-med-blue">
                                    <i class="ri-instagram-line"></i>
                                </a>
                            @endif

                            @if ($settings->linkedin_url)
                                <a href="{{ $settings->linkedin_url }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   aria-label="LinkedIn"
                                   class="grid h-10 w-10 place-items-center border border-slate-200 bg-white text-lg text-slate-600 transition hover:border-med-blue hover:text-med-blue">
                                    <i class="ri-linkedin-fill"></i>
                                </a>
                            @endif

                            @if ($settings->whatsappUrl())
                                <a href="{{ $settings->whatsappUrl() }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   aria-label="WhatsApp"
                                   class="grid h-10 w-10 place-items-center border border-slate-200 bg-white text-lg text-slate-600 transition hover:border-emerald-600 hover:text-emerald-600">
                                    <i class="ri-whatsapp-line"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            </aside>

            {{-- Contact form --}}
            <div class="border border-slate-200 bg-white p-5 shadow-[0_18px_45px_rgba(18,50,74,0.06)] sm:p-8">
                <div class="flex items-start gap-4">
                    <span class="grid h-12 w-12 shrink-0 place-items-center bg-sky-50 text-2xl text-med-blue">
                        <i class="ri-chat-3-line"></i>
                    </span>

                    <div>
                        <h2 class="text-xl font-bold text-med-navy">Send us a message</h2>
                        <p class="mt-1 text-sm leading-6 text-slate-500">
                            Share your question and our team will get back to you.
                        </p>
                    </div>
                </div>

                <form wire:submit="submit" class="mt-7">
                        <div class="grid gap-5 sm:grid-cols-2">
                            <div>
                                <label for="contact-name" class="text-sm font-semibold text-med-navy">
                                    Full Name
                                </label>
                                <input
                                    id="contact-name"
                                    type="text"
                                    wire:model="name"
                                    autocomplete="name"
                                    placeholder="Your full name"
                                    @error('name') aria-invalid="true" @enderror
                                    class="{{ $inputClasses }} @error('name') border-red-300 @enderror"
                                >
                                @error('name')
                                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="contact-email" class="text-sm font-semibold text-med-navy">
                                    Email Address
                                    <span class="font-normal text-slate-400">(optional)</span>
                                </label>
                                <input
                                    id="contact-email"
                                    type="email"
                                    wire:model="email"
                                    autocomplete="email"
                                    placeholder="you@example.com"
                                    @error('email') aria-invalid="true" @enderror
                                    class="{{ $inputClasses }} @error('email') border-red-300 @enderror"
                                >
                                @error('email')
                                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="contact-phone" class="text-sm font-semibold text-med-navy">
                                    Phone Number
                                </label>
                                <input
                                    id="contact-phone"
                                    type="tel"
                                    wire:model="phone"
                                    autocomplete="tel"
                                    placeholder="+91 98765 43210"
                                    @error('phone') aria-invalid="true" @enderror
                                    class="{{ $inputClasses }} @error('phone') border-red-300 @enderror"
                                >
                                @error('phone')
                                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="contact-subject" class="text-sm font-semibold text-med-navy">
                                    Subject
                                </label>
                                <input
                                    id="contact-subject"
                                    type="text"
                                    wire:model="subject"
                                    placeholder="How can we help?"
                                    @error('subject') aria-invalid="true" @enderror
                                    class="{{ $inputClasses }} @error('subject') border-red-300 @enderror"
                                >
                                @error('subject')
                                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-2">
                                <label for="contact-message" class="text-sm font-semibold text-med-navy">
                                    Message
                                </label>
                                <textarea
                                    id="contact-message"
                                    wire:model="message"
                                    rows="6"
                                    placeholder="Tell us a little about your question or concern"
                                    @error('message') aria-invalid="true" @enderror
                                    class="{{ $textareaClasses }} @error('message') border-red-300 @enderror"
                                ></textarea>
                                @error('message')
                                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6 flex flex-col gap-4 border-t border-slate-100 pt-5 sm:flex-row sm:items-center sm:justify-between">
                            <p class="text-xs leading-5 text-slate-500">
                                Your details are kept private and used only to respond to your enquiry.
                            </p>

                            <button type="submit"
                                    wire:loading.attr="disabled"
                                    wire:target="submit"
                                    class="inline-flex w-full items-center justify-center gap-2 bg-med-blue px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-sky-800 disabled:cursor-wait disabled:opacity-70 sm:w-auto">
                                <span wire:loading.remove wire:target="submit">Send Message</span>
                                <span wire:loading wire:target="submit">Sending...</span>
                                <i wire:loading.remove wire:target="submit" class="ri-send-plane-line text-base"></i>
                            </button>
                        </div>
                    </form>
            </div>
        </div>
    </section>

    {{-- Map --}}
    <section class="border-t border-slate-100 bg-[#f5fafc] py-12 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
                <div class="max-w-2xl">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-red">
                        Find Us
                    </p>

                    <h2 class="mt-3 text-3xl font-bold tracking-tight text-med-navy sm:text-4xl">
                        Visit MediDENT in Ghaziabad.
                    </h2>

                    @if ($settings->address)
                        <p class="mt-4 text-sm leading-7 text-slate-600 sm:text-base">
                            {{ $settings->address }}
                        </p>
                    @endif
                </div>

                <a href="{{ $this->mapDirectionsUrl }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="inline-flex w-fit shrink-0 items-center gap-2 border-b border-med-blue pb-1 text-sm font-semibold text-med-blue transition hover:text-sky-800">
                    Open in Google Maps
                    <i class="ri-arrow-right-up-line"></i>
                </a>
            </div>

            <div class="mt-8 overflow-hidden border border-slate-200 bg-white shadow-[0_18px_45px_rgba(18,50,74,0.08)] sm:mt-10">
                <iframe
                    src="{{ $this->mapEmbedUrl }}"
                    title="Map showing MediDENT Multicare Clinic in Ghaziabad"
                    class="h-[320px] w-full border-0 sm:h-[420px] lg:h-[460px]"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    allowfullscreen
                ></iframe>
            </div>
        </div>
    </section>

    <div
        x-data
        x-cloak
        x-show="$wire.submitted"
        x-transition.opacity
        @keydown.escape.window="$wire.sendAnother()"
        class="fixed inset-0 z-[60] flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/60" wire:click="sendAnother"></div>

        <div
            x-transition
            role="dialog"
            aria-modal="true"
            aria-labelledby="inquiry-modal-title"
            class="relative w-full max-w-lg border border-slate-200 bg-white p-6 shadow-2xl sm:p-8">
            <button
                type="button"
                wire:click="sendAnother"
                aria-label="Close inquiry confirmation"
                class="absolute right-4 top-4 grid h-8 w-8 place-items-center text-lg text-slate-400 transition hover:bg-slate-50 hover:text-med-navy">
                <i class="ri-close-line"></i>
            </button>

            <span class="grid h-14 w-14 place-items-center rounded-full bg-emerald-50 text-3xl text-emerald-600">
                <i class="ri-checkbox-circle-line"></i>
            </span>

            <p class="mt-5 text-xs font-bold uppercase tracking-[0.2em] text-emerald-600">
                Inquiry received
            </p>

            <h2 id="inquiry-modal-title" class="mt-2 text-2xl font-bold tracking-tight text-med-navy">
                Thank you for reaching out.
            </h2>

            <p class="mt-3 text-sm leading-7 text-slate-600">
                Your message is now with our care team. We will review your inquiry and get back to you as soon as possible.
            </p>

            <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                @if ($settings->phone)
                    <a href="{{ $settings->phoneHref() }}"
                       class="inline-flex items-center justify-center gap-2 border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:border-med-blue hover:text-med-blue">
                        <i class="ri-phone-line text-base"></i>
                        Call the clinic
                    </a>
                @endif

                <button
                    type="button"
                    wire:click="sendAnother"
                    class="inline-flex items-center justify-center bg-med-blue px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-sky-800">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
