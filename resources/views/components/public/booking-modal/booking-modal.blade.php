<div
    x-data="{ open: @entangle('showModal').live }"
    x-effect="document.body.classList.toggle('overflow-hidden', open)"
    @open-booking-modal.window="$wire.openModal()"
    @keydown.escape.window="open && $wire.closeModal()"
>
    <div
        x-cloak
        x-show="open"
        x-transition.opacity.duration.200ms
        class="fixed inset-0 z-[80] bg-med-navy/65 backdrop-blur-sm"
        aria-hidden="true"
        @click="$wire.closeModal()"
    ></div>

    <div
        x-cloak
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-3"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-3"
        role="dialog"
        aria-modal="true"
        aria-labelledby="booking-modal-title"
        class="pointer-events-none fixed inset-0 z-[90] flex items-end justify-center overflow-y-auto p-0 sm:items-center sm:p-6"
    >
        <div
            class="pointer-events-auto relative my-auto max-h-[92vh] w-full max-w-2xl overflow-y-auto bg-white shadow-2xl"
            @click.stop
        >
            @if ($submitted)
                <div class="relative px-6 py-10 text-center sm:px-10 sm:py-12">
                    <button
                        type="button"
                        @click="$wire.closeModal()"
                        aria-label="Close booking form"
                        class="absolute right-4 top-4 grid h-9 w-9 place-items-center border border-slate-200 text-lg text-slate-400 transition hover:border-slate-300 hover:bg-slate-50 hover:text-med-navy"
                    >
                        <i class="ri-close-line"></i>
                    </button>

                    <span class="mx-auto grid h-16 w-16 place-items-center rounded-full bg-emerald-50 text-3xl text-emerald-600">
                        <i class="ri-check-line"></i>
                    </span>

                    <p class="mt-5 text-xs font-bold uppercase tracking-[0.2em] text-emerald-600">
                        Request received
                    </p>

                    <h2 id="booking-modal-title" class="mt-2 text-2xl font-bold tracking-tight text-med-navy">
                        We'll be in touch soon.
                    </h2>

                    <p class="mx-auto mt-3 max-w-md text-sm leading-7 text-slate-600">
                        Thanks, {{ $name }}. Our team will call you on {{ $phone }} to confirm your appointment.
                    </p>

                    <div class="mt-7 flex flex-col justify-center gap-3 sm:flex-row">
                        <button
                            type="button"
                            wire:click="bookAnother"
                            class="inline-flex items-center justify-center gap-2 border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-600 transition hover:border-med-blue hover:text-med-blue"
                        >
                            Book another
                        </button>

                        <button
                            type="button"
                            wire:click="closeModal"
                            class="inline-flex items-center justify-center gap-2 bg-med-navy px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800"
                        >
                            Done
                        </button>
                    </div>
                </div>
            @else
                <div class="flex items-start justify-between gap-4 border-b border-slate-100 px-6 py-5 sm:px-8">
                    <div>
                        <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-med-red">
                            Appointment request
                        </p>

                        <h2 id="booking-modal-title" class="mt-1 text-2xl font-bold tracking-tight text-med-navy">
                            Book your visit
                        </h2>

                        <p class="mt-1 text-sm leading-6 text-slate-500">
                            Share a few details and our team will call you to confirm.
                        </p>
                    </div>

                    <button
                        type="button"
                        @click="$wire.closeModal()"
                        aria-label="Close booking form"
                        class="grid h-9 w-9 shrink-0 place-items-center border border-slate-200 text-lg text-slate-400 transition hover:border-slate-300 hover:bg-slate-50 hover:text-med-navy"
                    >
                        <i class="ri-close-line"></i>
                    </button>
                </div>

                <form wire:submit="submit" class="px-6 py-6 sm:px-8">
                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="booking-name" class="text-sm font-semibold text-med-navy">
                                Full name
                            </label>

                            <input
                                id="booking-name"
                                type="text"
                                wire:model="name"
                                autocomplete="name"
                                placeholder="Your full name"
                                class="mt-2 h-11 w-full border border-slate-200 bg-white px-3.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100 @error('name') border-red-300 @enderror"
                            >

                            @error('name')
                                <p class="mt-1.5 text-xs font-medium text-med-red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="booking-phone" class="text-sm font-semibold text-med-navy">
                                Phone number
                            </label>

                            <input
                                id="booking-phone"
                                type="tel"
                                wire:model="phone"
                                autocomplete="tel"
                                placeholder="+91 98765 43210"
                                class="mt-2 h-11 w-full border border-slate-200 bg-white px-3.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100 @error('phone') border-red-300 @enderror"
                            >

                            @error('phone')
                                <p class="mt-1.5 text-xs font-medium text-med-red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="booking-age" class="text-sm font-semibold text-med-navy">
                                Age
                            </label>

                            <input
                                id="booking-age"
                                type="number"
                                wire:model="age"
                                min="1"
                                max="120"
                                inputmode="numeric"
                                placeholder="e.g. 32"
                                class="mt-2 h-11 w-full border border-slate-200 bg-white px-3.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100 @error('age') border-red-300 @enderror"
                            >

                            @error('age')
                                <p class="mt-1.5 text-xs font-medium text-med-red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="booking-address" class="text-sm font-semibold text-med-navy">
                                Address
                            </label>

                            <input
                                id="booking-address"
                                type="text"
                                wire:model="address"
                                autocomplete="street-address"
                                placeholder="House / street, area, city"
                                class="mt-2 h-11 w-full border border-slate-200 bg-white px-3.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100 @error('address') border-red-300 @enderror"
                            >

                            @error('address')
                                <p class="mt-1.5 text-xs font-medium text-med-red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="booking-problem" class="text-sm font-semibold text-med-navy">
                                Problem
                            </label>

                            <textarea
                                id="booking-problem"
                                wire:model="problem"
                                rows="4"
                                placeholder="Briefly describe your concern or the treatment you need."
                                class="mt-2 w-full resize-none border border-slate-200 bg-white px-3.5 py-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100 @error('problem') border-red-300 @enderror"
                            ></textarea>

                            @error('problem')
                                <p class="mt-1.5 text-xs font-medium text-med-red">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex flex-col-reverse gap-4 border-t border-slate-100 pt-5 sm:flex-row sm:items-center sm:justify-between">
                        <p class="max-w-xs text-xs leading-5 text-slate-400">
                            By submitting, you agree to be contacted about this appointment request.
                        </p>

                        <button
                            type="submit"
                            wire:loading.attr="disabled"
                            wire:target="submit"
                            class="inline-flex shrink-0 items-center justify-center gap-2 bg-med-red px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-red-700 disabled:cursor-not-allowed disabled:opacity-70"
                        >
                            <i class="ri-loader-4-line animate-spin" wire:loading wire:target="submit"></i>
                            <i class="ri-calendar-check-line" wire:loading.remove wire:target="submit"></i>
                            <span wire:loading.remove wire:target="submit">Request Appointment</span>
                            <span wire:loading wire:target="submit">Sending...</span>
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
