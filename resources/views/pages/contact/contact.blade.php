@php
    $settings = $this->settings;
    $inputClasses = 'mt-2 h-12 w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-sm text-slate-800 outline-none transition-all placeholder:text-slate-400 focus:bg-white focus:border-med-blue focus:ring-4 focus:ring-sky-100/50';
    $textareaClasses = 'mt-2 w-full resize-none rounded-xl border border-slate-200 bg-slate-50/50 p-4 text-sm text-slate-800 outline-none transition-all placeholder:text-slate-400 focus:bg-white focus:border-med-blue focus:ring-4 focus:ring-sky-100/50';
@endphp

<div>
    {{-- Hero --}}
    <section class="relative overflow-hidden bg-[#FAFDFE] py-14 sm:py-20 lg:py-24 border-b border-slate-100">
        <div class="pointer-events-none absolute -top-24 right-0 h-96 w-96 rounded-full bg-sky-100/50 blur-3xl"></div>
        <div class="pointer-events-none absolute bottom-0 left-1/4 h-80 w-80 rounded-full bg-teal-50/50 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <h1 class="text-3xl font-extrabold tracking-tight text-med-navy sm:text-5xl lg:text-6xl">
                    We're here to help with your <br class="hidden sm:inline" />
                    <span class="text-med-blue">healthcare questions<span class="text-med-red">.</span></span>
                </h1>

                <p class="mt-5 max-w-2xl text-base leading-relaxed text-slate-600 sm:text-lg">
                    Call us, send an inquiry, or visit our clinic. Our team is always ready to guide you to the right care and answer any questions about treatments or appointments.
                </p>

                <div class="mt-8 flex flex-col gap-3.5 sm:flex-row sm:items-center">
                    @if ($settings->phone)
                        <a href="{{ $settings->phoneHref() }}"
                           class="inline-flex w-full items-center justify-center gap-2.5 rounded-full bg-med-navy px-7 py-3.5 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:bg-med-blue hover:shadow-lg active:translate-y-0 sm:w-auto">
                            <i class="ri-phone-line text-base"></i>
                            <span>Call the Clinic</span>
                        </a>
                    @endif

                    <button type="button"
                            @click="$dispatch('open-booking-modal')"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-full border border-slate-200 bg-white px-7 py-3.5 text-sm font-semibold text-med-navy shadow-sm transition-all duration-200 hover:border-med-blue hover:text-med-blue hover:bg-slate-50 sm:w-auto">
                        <span>Book an Appointment</span>
                        <i class="ri-arrow-right-line text-xs"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    {{-- Contact details and form --}}
    <section class="py-14 sm:py-20 lg:py-24 bg-white">
        <div class="mx-auto grid max-w-7xl gap-10 px-5 sm:px-6 lg:grid-cols-[.82fr_1.18fr] lg:gap-14 lg:px-8">

            {{-- Contact information --}}
            <aside>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-red">
                    Clinic Details
                </p>

                <h2 class="mt-2 text-2xl font-extrabold tracking-tight text-med-navy sm:text-3xl lg:text-4xl">
                    Visit or reach out<span class="text-med-blue">.</span>
                </h2>

                <p class="mt-3 text-sm leading-relaxed text-slate-600 sm:text-base">
                    We are available six days a week for dental consultations, physician care, chronic disease management, and emergency appointments.
                </p>

                <div class="mt-8 space-y-4">
                    @if ($settings->address)
                        <div class="flex gap-4 rounded-3xl border border-slate-100 bg-white p-6 shadow-sm transition-all duration-300 hover:shadow-md">
                            <span class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-sky-50 text-xl text-med-blue">
                                <i class="ri-map-pin-line"></i>
                            </span>

                            <div class="min-w-0">
                                <h3 class="text-sm font-bold text-med-navy">Clinic Address</h3>
                                <p class="mt-1.5 text-sm leading-relaxed text-slate-600">{{ $settings->address }}</p>

                                <a href="{{ $this->mapDirectionsUrl }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="mt-2.5 inline-flex items-center gap-1.5 text-xs font-bold text-med-blue transition-colors hover:text-sky-800">
                                    <span>Get directions</span>
                                    <i class="ri-arrow-right-up-line"></i>
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="flex gap-4 rounded-3xl border border-slate-100 bg-white p-6 shadow-sm transition-all duration-300 hover:shadow-md">
                        <span class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-red-50 text-xl text-med-red">
                            <i class="ri-phone-line"></i>
                        </span>

                        <div class="min-w-0">
                            <h3 class="text-sm font-bold text-med-navy">Phone Numbers</h3>

                            <div class="mt-1.5 flex flex-col gap-1 text-sm font-medium text-slate-600">
                                @if ($settings->phone)
                                    <a href="{{ $settings->phoneHref() }}" class="transition-colors hover:text-med-blue">
                                        {{ $settings->phone }}
                                    </a>
                                @endif

                                @if ($settings->secondary_phone)
                                    <a href="{{ $settings->secondaryPhoneHref() }}" class="transition-colors hover:text-med-blue">
                                        {{ $settings->secondary_phone }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if ($settings->email)
                        <div class="flex gap-4 rounded-3xl border border-slate-100 bg-white p-6 shadow-sm transition-all duration-300 hover:shadow-md">
                            <span class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-emerald-50 text-xl text-emerald-600">
                                <i class="ri-mail-line"></i>
                            </span>

                            <div class="min-w-0">
                                <h3 class="text-sm font-bold text-med-navy">Email Address</h3>
                                <a href="mailto:{{ $settings->email }}"
                                   class="mt-1.5 block break-all text-sm font-medium text-slate-600 transition-colors hover:text-med-blue">
                                    {{ $settings->email }}
                                </a>
                            </div>
                        </div>
                    @endif

                    @if ($settings->opening_hours)
                        <div class="flex gap-4 rounded-3xl border border-slate-100 bg-white p-6 shadow-sm transition-all duration-300 hover:shadow-md">
                            <span class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-amber-50 text-xl text-amber-600">
                                <i class="ri-time-line"></i>
                            </span>

                            <div class="min-w-0">
                                <h3 class="text-sm font-bold text-med-navy">Opening Hours</h3>

                                <div class="mt-1.5 space-y-1 text-sm leading-relaxed text-slate-600">
                                    @foreach ($settings->openingHoursLines() as $hours)
                                        <p>{{ $hours }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                @if ($settings->facebook_url || $settings->instagram_url || $settings->linkedin_url || $settings->whatsappUrl())
                    <div class="mt-8 rounded-3xl border border-slate-100 bg-[#FAFDFE] p-6 shadow-sm">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Connect With MediDENT</p>

                        <div class="mt-3 flex flex-wrap items-center gap-2.5">
                            @if ($settings->facebook_url)
                                <a href="{{ $settings->facebook_url }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   aria-label="Facebook"
                                   class="grid h-10 w-10 place-items-center rounded-full border border-slate-200 bg-white text-base text-slate-600 shadow-sm transition-all duration-200 hover:border-med-blue hover:text-med-blue hover:shadow">
                                    <i class="ri-facebook-fill"></i>
                                </a>
                            @endif

                            @if ($settings->instagram_url)
                                <a href="{{ $settings->instagram_url }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   aria-label="Instagram"
                                   class="grid h-10 w-10 place-items-center rounded-full border border-slate-200 bg-white text-base text-slate-600 shadow-sm transition-all duration-200 hover:border-med-blue hover:text-med-blue hover:shadow">
                                    <i class="ri-instagram-line"></i>
                                </a>
                            @endif

                            @if ($settings->linkedin_url)
                                <a href="{{ $settings->linkedin_url }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   aria-label="LinkedIn"
                                   class="grid h-10 w-10 place-items-center rounded-full border border-slate-200 bg-white text-base text-slate-600 shadow-sm transition-all duration-200 hover:border-med-blue hover:text-med-blue hover:shadow">
                                    <i class="ri-linkedin-fill"></i>
                                </a>
                            @endif

                            @if ($settings->whatsappUrl())
                                <a href="{{ $settings->whatsappUrl() }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   aria-label="WhatsApp"
                                   class="grid h-10 w-10 place-items-center rounded-full border border-slate-200 bg-white text-base text-emerald-600 shadow-sm transition-all duration-200 hover:border-emerald-500 hover:bg-emerald-50 hover:shadow">
                                    <i class="ri-whatsapp-line"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            </aside>

            {{-- Contact form --}}
            <div class="rounded-3xl border border-slate-100 bg-white p-7 shadow-[0_20px_50px_rgba(18,50,74,0.06)] sm:p-10">
                <div class="flex items-start gap-4 border-b border-slate-100 pb-6">
                    <span class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-sky-50 text-2xl text-med-blue shadow-sm">
                        <i class="ri-chat-3-line"></i>
                    </span>

                    <div>
                        <h2 class="text-xl font-extrabold text-med-navy sm:text-2xl">Send us a message<span class="text-med-blue">.</span></h2>
                        <p class="mt-1 text-sm leading-relaxed text-slate-500">
                            Share your query or requirement and our patient coordinators will reply shortly.
                        </p>
                    </div>
                </div>

                <form wire:submit="submit" class="mt-8">
                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="contact-name" class="text-sm font-semibold text-med-navy">
                                Full Name <span class="text-med-red">*</span>
                            </label>
                            <input
                                id="contact-name"
                                type="text"
                                wire:model="name"
                                autocomplete="name"
                                placeholder="Your full name"
                                @error('name') aria-invalid="true" @enderror
                                class="{{ $inputClasses }} @error('name') border-red-300 ring-2 ring-red-100 @enderror"
                            >
                            @error('name')
                                <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
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
                                class="{{ $inputClasses }} @error('email') border-red-300 ring-2 ring-red-100 @enderror"
                            >
                            @error('email')
                                <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="contact-phone" class="text-sm font-semibold text-med-navy">
                                Phone Number <span class="text-med-red">*</span>
                            </label>
                            <input
                                id="contact-phone"
                                type="tel"
                                wire:model="phone"
                                autocomplete="tel"
                                placeholder="+91 98765 43210"
                                @error('phone') aria-invalid="true" @enderror
                                class="{{ $inputClasses }} @error('phone') border-red-300 ring-2 ring-red-100 @enderror"
                            >
                            @error('phone')
                                <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="contact-subject" class="text-sm font-semibold text-med-navy">
                                Subject <span class="text-med-red">*</span>
                            </label>
                            <input
                                id="contact-subject"
                                type="text"
                                wire:model="subject"
                                placeholder="How can we help?"
                                @error('subject') aria-invalid="true" @enderror
                                class="{{ $inputClasses }} @error('subject') border-red-300 ring-2 ring-red-100 @enderror"
                            >
                            @error('subject')
                                <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="contact-message" class="text-sm font-semibold text-med-navy">
                                Message <span class="text-med-red">*</span>
                            </label>
                            <textarea
                                id="contact-message"
                                wire:model="message"
                                rows="5"
                                placeholder="Tell us a little about your question, symptoms, or requested service..."
                                @error('message') aria-invalid="true" @enderror
                                class="{{ $textareaClasses }} @error('message') border-red-300 ring-2 ring-red-100 @enderror"
                            ></textarea>
                            @error('message')
                                <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-8 flex flex-col gap-4 border-t border-slate-100 pt-6 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-xs leading-relaxed text-slate-500">
                            Your details are strictly confidential and used solely to respond to your inquiry.
                        </p>

                        <button type="submit"
                                wire:loading.attr="disabled"
                                wire:target="submit"
                                class="inline-flex w-full items-center justify-center gap-2.5 rounded-full bg-med-navy px-8 py-3.5 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:bg-med-blue hover:shadow-lg disabled:cursor-wait disabled:opacity-70 sm:w-auto">
                            <span wire:loading.remove wire:target="submit">Send Message</span>
                            <span wire:loading wire:target="submit">Sending...</span>
                            <i wire:loading.remove wire:target="submit" class="ri-send-plane-line text-sm"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    {{-- Map --}}
    <section class="border-t border-slate-100 bg-[#FAFDFE] py-14 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
                <div class="max-w-2xl">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-red">
                        Location & Directions
                    </p>

                    <h2 class="mt-2 text-2xl font-extrabold tracking-tight text-med-navy sm:text-3xl lg:text-4xl">
                        Visit MediDENT in Ghaziabad<span class="text-med-blue">.</span>
                    </h2>

                    @if ($settings->address)
                        <p class="mt-3 text-sm leading-relaxed text-slate-600 sm:text-base">
                            {{ $settings->address }}
                        </p>
                    @endif
                </div>

                <a href="{{ $this->mapDirectionsUrl }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="inline-flex w-full sm:w-fit justify-center sm:justify-start items-center gap-2 rounded-full border border-slate-200 bg-white px-5 py-2.5 text-xs sm:text-sm font-semibold text-med-navy shadow-sm transition-all duration-200 hover:border-med-blue hover:text-med-blue hover:bg-slate-50">
                    <span>Open in Google Maps</span>
                    <i class="ri-arrow-right-up-line text-xs"></i>
                </a>
            </div>

            <div class="mt-8 sm:mt-10 overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-[0_20px_50px_rgba(18,50,74,0.08)]">
                <iframe
                    src="{{ $this->mapEmbedUrl }}"
                    title="Map showing MediDENT Multicare Clinic in Ghaziabad"
                    class="h-[280px] w-full border-0 sm:h-[440px] lg:h-[480px]"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    allowfullscreen
                ></iframe>
            </div>
        </div>
    </section>

    {{-- Confirmation Modal --}}
    <div
        x-data
        x-cloak
        x-show="$wire.submitted"
        x-transition.opacity
        @keydown.escape.window="$wire.sendAnother()"
        class="fixed inset-0 z-[60] flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-med-navy/60 backdrop-blur-sm" wire:click="sendAnother"></div>

        <div
            x-transition
            role="dialog"
            aria-modal="true"
            aria-labelledby="inquiry-modal-title"
            class="relative w-full max-w-lg rounded-3xl border border-slate-100 bg-white p-7 shadow-2xl sm:p-9">
            <button
                type="button"
                wire:click="sendAnother"
                aria-label="Close inquiry confirmation"
                class="absolute right-5 top-5 grid h-9 w-9 place-items-center rounded-full bg-slate-100 text-slate-500 transition-colors hover:bg-slate-200 hover:text-med-navy">
                <i class="ri-close-line text-lg"></i>
            </button>

            <span class="grid h-16 w-16 place-items-center rounded-2xl bg-emerald-50 text-3xl text-emerald-600 shadow-sm">
                <i class="ri-checkbox-circle-line"></i>
            </span>

            <p class="mt-5 text-xs font-bold uppercase tracking-[0.2em] text-emerald-600">
                Inquiry Received
            </p>

            <h2 id="inquiry-modal-title" class="mt-2 text-2xl font-extrabold tracking-tight text-med-navy">
                Thank you for reaching out<span class="text-med-blue">.</span>
            </h2>

            <p class="mt-3 text-sm leading-relaxed text-slate-600">
                Your message has been received by our clinical care coordinators. We will review your inquiry and get back to you promptly.
            </p>

            <div class="mt-7 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                @if ($settings->phone)
                    <a href="{{ $settings->phoneHref() }}"
                       class="inline-flex items-center justify-center gap-2 rounded-full border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 transition-all hover:border-med-blue hover:text-med-blue">
                        <i class="ri-phone-line text-sm"></i>
                        <span>Call the clinic</span>
                    </a>
                @endif

                <button
                    type="button"
                    wire:click="sendAnother"
                    class="inline-flex items-center justify-center rounded-full bg-med-navy px-6 py-2.5 text-sm font-semibold text-white shadow-md transition-all hover:bg-med-blue">
                    <span>Close</span>
                </button>
            </div>
        </div>
    </div>
</div>
