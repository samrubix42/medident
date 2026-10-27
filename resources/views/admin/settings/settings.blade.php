@php
    $inputClasses = 'mt-2 h-11 w-full border border-slate-200 bg-white px-3.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100';
    $textareaClasses = 'mt-2 w-full resize-none border border-slate-200 bg-white px-3.5 py-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100';
@endphp

<div class="mx-auto max-w-5xl space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-blue">
                Website settings
            </p>

            <h2 class="mt-2 text-2xl font-bold tracking-tight text-med-navy sm:text-3xl">
                Clinic settings
            </h2>

            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">
                Update the contact details and social profiles shown across the public website.
            </p>
        </div>

        <a href="{{ route('home') }}"
            target="_blank"
            rel="noopener noreferrer"
            class="inline-flex w-fit items-center gap-2 border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:border-med-blue hover:text-med-blue">
            <i class="ri-external-link-line"></i>
            View website
        </a>
    </div>

    <form wire:submit="save" class="space-y-6">
        <section class="border border-slate-200 bg-white">
            <div class="flex items-start gap-3 border-b border-slate-100 px-5 py-4 sm:px-6">
                <span class="grid h-10 w-10 shrink-0 place-items-center bg-sky-50 text-xl text-med-blue">
                    <i class="ri-hospital-line"></i>
                </span>

                <div>
                    <h3 class="font-bold text-med-navy">Contact details</h3>
                    <p class="mt-1 text-xs text-slate-500">
                        These details appear in the website header, footer and contact section.
                    </p>
                </div>
            </div>

            <div class="grid gap-5 p-5 sm:grid-cols-2 sm:p-6">
                <div class="sm:col-span-2">
                    <label for="settings-clinic-name" class="text-sm font-semibold text-med-navy">
                        Clinic name
                    </label>

                    <input
                        id="settings-clinic-name"
                        type="text"
                        wire:model="clinicName"
                        class="{{ $inputClasses }} @error('clinicName') border-red-300 @enderror"
                    >

                    @error('clinicName')
                        <p class="mt-1.5 text-xs font-medium text-med-red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="settings-address" class="text-sm font-semibold text-med-navy">
                        Full address
                    </label>

                    <textarea
                        id="settings-address"
                        wire:model="address"
                        rows="2"
                        class="{{ $textareaClasses }} @error('address') border-red-300 @enderror"
                    ></textarea>

                    @error('address')
                        <p class="mt-1.5 text-xs font-medium text-med-red">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="settings-phone" class="text-sm font-semibold text-med-navy">
                        Primary phone
                    </label>

                    <input
                        id="settings-phone"
                        type="text"
                        wire:model="phone"
                        placeholder="+91 88000 23032"
                        class="{{ $inputClasses }} @error('phone') border-red-300 @enderror"
                    >

                    @error('phone')
                        <p class="mt-1.5 text-xs font-medium text-med-red">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="settings-secondary-phone" class="text-sm font-semibold text-med-navy">
                        Secondary phone
                    </label>

                    <input
                        id="settings-secondary-phone"
                        type="text"
                        wire:model="secondaryPhone"
                        placeholder="0120-4169996"
                        class="{{ $inputClasses }} @error('secondaryPhone') border-red-300 @enderror"
                    >

                    @error('secondaryPhone')
                        <p class="mt-1.5 text-xs font-medium text-med-red">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="settings-email" class="text-sm font-semibold text-med-navy">
                        Email address
                    </label>

                    <input
                        id="settings-email"
                        type="email"
                        wire:model="email"
                        class="{{ $inputClasses }} @error('email') border-red-300 @enderror"
                    >

                    @error('email')
                        <p class="mt-1.5 text-xs font-medium text-med-red">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="settings-whatsapp" class="text-sm font-semibold text-med-navy">
                        WhatsApp number
                    </label>

                    <input
                        id="settings-whatsapp"
                        type="text"
                        wire:model="whatsappNumber"
                        placeholder="+91 88000 23032"
                        class="{{ $inputClasses }} @error('whatsappNumber') border-red-300 @enderror"
                    >

                    @error('whatsappNumber')
                        <p class="mt-1.5 text-xs font-medium text-med-red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="settings-hours" class="text-sm font-semibold text-med-navy">
                        Opening hours
                    </label>

                    <input
                        id="settings-hours"
                        type="text"
                        wire:model="openingHours"
                        placeholder="Mon - Sat 11:00 AM - 1:00 PM | 5:00 PM - 8:30 PM"
                        class="{{ $inputClasses }} @error('openingHours') border-red-300 @enderror"
                    >

                    <p class="mt-1.5 text-xs text-slate-400">
                        Separate different time slots with a pipe character (|).
                    </p>

                    @error('openingHours')
                        <p class="mt-1.5 text-xs font-medium text-med-red">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </section>

        <section class="border border-slate-200 bg-white">
            <div class="flex items-start gap-3 border-b border-slate-100 px-5 py-4 sm:px-6">
                <span class="grid h-10 w-10 shrink-0 place-items-center bg-slate-100 text-xl text-slate-500">
                    <i class="ri-share-line"></i>
                </span>

                <div>
                    <h3 class="font-bold text-med-navy">Social profiles</h3>
                    <p class="mt-1 text-xs text-slate-500">
                        Add the full profile URLs used by the social icons in the website footer.
                    </p>
                </div>
            </div>

            <div class="grid gap-5 p-5 lg:grid-cols-3 sm:p-6">
                <div>
                    <label for="settings-facebook" class="text-sm font-semibold text-med-navy">
                        Facebook URL
                    </label>

                    <input
                        id="settings-facebook"
                        type="url"
                        wire:model="facebookUrl"
                        placeholder="https://www.facebook.com/your-page"
                        class="{{ $inputClasses }} @error('facebookUrl') border-red-300 @enderror"
                    >

                    @error('facebookUrl')
                        <p class="mt-1.5 text-xs font-medium text-med-red">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="settings-instagram" class="text-sm font-semibold text-med-navy">
                        Instagram URL
                    </label>

                    <input
                        id="settings-instagram"
                        type="url"
                        wire:model="instagramUrl"
                        placeholder="https://www.instagram.com/your-page"
                        class="{{ $inputClasses }} @error('instagramUrl') border-red-300 @enderror"
                    >

                    @error('instagramUrl')
                        <p class="mt-1.5 text-xs font-medium text-med-red">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="settings-linkedin" class="text-sm font-semibold text-med-navy">
                        LinkedIn URL
                    </label>

                    <input
                        id="settings-linkedin"
                        type="url"
                        wire:model="linkedinUrl"
                        placeholder="https://www.linkedin.com/company/your-page"
                        class="{{ $inputClasses }} @error('linkedinUrl') border-red-300 @enderror"
                    >

                    @error('linkedinUrl')
                        <p class="mt-1.5 text-xs font-medium text-med-red">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </section>

        <div class="flex flex-col gap-4 border border-slate-200 bg-white p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
            <p class="flex items-start gap-2 text-sm leading-6 text-slate-500">
                <i class="ri-information-line mt-0.5 text-base text-med-blue"></i>
                Changes appear immediately across the public website.
            </p>

            <button
                type="submit"
                wire:loading.attr="disabled"
                wire:target="save"
                class="inline-flex shrink-0 items-center justify-center gap-2 bg-med-blue px-6 py-3 text-sm font-semibold text-white transition hover:bg-sky-800 disabled:cursor-not-allowed disabled:opacity-70"
            >
                <i class="ri-loader-4-line animate-spin" wire:loading wire:target="save"></i>
                <i class="ri-check-line" wire:loading.remove wire:target="save"></i>
                <span wire:loading.remove wire:target="save">Save settings</span>
                <span wire:loading wire:target="save">Saving...</span>
            </button>
        </div>
    </form>
</div>
