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
        class="pointer-events-none fixed inset-0 z-[90] flex items-end justify-center overflow-y-auto p-0 sm:items-center sm:p-4 md:p-6"
    >
        <div
            class="pointer-events-auto relative my-auto max-h-[92vh] w-full max-w-xl overflow-y-auto rounded-t-[2rem] border border-slate-100 bg-white shadow-[0_25px_80px_rgba(18,50,74,0.22)] sm:rounded-3xl"
            @click.stop
        >
            {{-- Mobile drag handle indicator --}}
            <div class="mx-auto mt-2.5 h-1 w-10 rounded-full bg-slate-200 sm:hidden"></div>

            @if ($submitted)
                <div class="relative px-5 py-8 text-center sm:px-10 sm:py-12">
                    <button
                        type="button"
                        @click="$wire.closeModal()"
                        aria-label="Close booking form"
                        class="absolute right-4 top-4 sm:right-5 sm:top-5 grid h-9 w-9 sm:h-10 sm:w-10 place-items-center rounded-full border border-slate-200 bg-slate-50 text-slate-400 transition hover:border-med-blue hover:bg-white hover:text-med-blue"
                    >
                        <i class="ri-close-line text-lg"></i>
                    </button>

                    <span class="mx-auto grid h-14 w-14 sm:h-16 sm:w-16 place-items-center rounded-full bg-emerald-50 text-2xl sm:text-3xl text-emerald-600">
                        <i class="ri-check-line"></i>
                    </span>

                    <h2 id="booking-modal-title" class="mt-4 sm:mt-5 text-xl sm:text-2xl lg:text-3xl font-extrabold tracking-tight text-med-navy">
                        Request Received<span class="text-emerald-600">.</span>
                    </h2>

                    <p class="mx-auto mt-2.5 sm:mt-3 max-w-md text-xs sm:text-sm leading-relaxed text-slate-600">
                        Thanks, <span class="font-bold text-med-navy">{{ $name }}</span>. Our clinic team will call you on <span class="font-semibold text-med-navy">{{ $phone }}</span> shortly to confirm your appointment time.
                    </p>

                    <div class="mt-6 sm:mt-8 flex flex-col justify-center gap-3 sm:flex-row">
                        <button
                            type="button"
                            wire:click="bookAnother"
                            class="inline-flex w-full sm:w-auto items-center justify-center gap-2 rounded-full border border-slate-200 bg-white px-6 py-3 text-sm font-semibold text-slate-700 shadow-sm transition-all duration-200 hover:border-med-blue hover:text-med-blue"
                        >
                            <span>Book another visit</span>
                        </button>

                        <button
                            type="button"
                            wire:click="closeModal"
                            class="inline-flex w-full sm:w-auto items-center justify-center gap-2 rounded-full bg-med-navy px-7 py-3 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:bg-med-blue hover:shadow-lg"
                        >
                            <span>Done</span>
                        </button>
                    </div>
                </div>
            @else
                <div class="flex items-start justify-between gap-4 border-b border-slate-100 px-5 py-4 sm:px-8 sm:py-6">
                    <div>
                        <h2 id="booking-modal-title" class="text-xl sm:text-2xl lg:text-3xl font-extrabold tracking-tight text-med-navy">
                            Book an Appointment<span class="text-med-blue">.</span>
                        </h2>

                        <p class="mt-1 text-xs sm:text-sm text-slate-500">
                            Fill in your details and our team will call to confirm your visit.
                        </p>
                    </div>

                    <button
                        type="button"
                        @click="$wire.closeModal()"
                        aria-label="Close booking form"
                        class="grid h-9 w-9 sm:h-10 sm:w-10 shrink-0 place-items-center rounded-full border border-slate-200 bg-slate-50 text-slate-400 transition hover:border-med-blue hover:bg-white hover:text-med-blue"
                    >
                        <i class="ri-close-line text-lg"></i>
                    </button>
                </div>

                <form wire:submit="submit" class="px-5 py-5 sm:px-8 sm:py-6">
                    <div class="grid gap-4 sm:gap-5 sm:grid-cols-2">
                        <div>
                            <label for="booking-name" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                                Full Name <span class="text-med-red">*</span>
                            </label>

                            <input
                                id="booking-name"
                                type="text"
                                wire:model="name"
                                autocomplete="name"
                                placeholder="e.g. Ramesh Kumar"
                                class="mt-1.5 h-11 sm:h-12 w-full rounded-2xl border border-slate-200/90 bg-slate-50/50 px-4 text-base sm:text-sm text-med-navy outline-none transition duration-200 placeholder:text-slate-400 hover:border-slate-300 focus:border-med-blue focus:bg-white focus:ring-4 focus:ring-sky-100/60 @error('name') border-red-300 ring-2 ring-red-100 @enderror"
                            >

                            @error('name')
                                <p class="mt-1.5 text-xs font-medium text-med-red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="booking-phone" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                                Phone Number <span class="text-med-red">*</span>
                            </label>

                            <input
                                id="booking-phone"
                                type="tel"
                                wire:model="phone"
                                autocomplete="tel"
                                placeholder="+91 98765 43210"
                                class="mt-1.5 h-11 sm:h-12 w-full rounded-2xl border border-slate-200/90 bg-slate-50/50 px-4 text-base sm:text-sm text-med-navy outline-none transition duration-200 placeholder:text-slate-400 hover:border-slate-300 focus:border-med-blue focus:bg-white focus:ring-4 focus:ring-sky-100/60 @error('phone') border-red-300 ring-2 ring-red-100 @enderror"
                            >

                            @error('phone')
                                <p class="mt-1.5 text-xs font-medium text-med-red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="booking-age" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                                Age
                            </label>

                            <input
                                id="booking-age"
                                type="number"
                                wire:model="age"
                                min="1"
                                max="120"
                                inputmode="numeric"
                                placeholder="e.g. 35"
                                class="mt-1.5 h-11 sm:h-12 w-full rounded-2xl border border-slate-200/90 bg-slate-50/50 px-4 text-base sm:text-sm text-med-navy outline-none transition duration-200 placeholder:text-slate-400 hover:border-slate-300 focus:border-med-blue focus:bg-white focus:ring-4 focus:ring-sky-100/60 @error('age') border-red-300 ring-2 ring-red-100 @enderror"
                            >

                            @error('age')
                                <p class="mt-1.5 text-xs font-medium text-med-red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="booking-address" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                                Area / City
                            </label>

                            <input
                                id="booking-address"
                                type="text"
                                wire:model="address"
                                autocomplete="street-address"
                                placeholder="e.g. Shastri Nagar, Ghaziabad"
                                class="mt-1.5 h-11 sm:h-12 w-full rounded-2xl border border-slate-200/90 bg-slate-50/50 px-4 text-base sm:text-sm text-med-navy outline-none transition duration-200 placeholder:text-slate-400 hover:border-slate-300 focus:border-med-blue focus:bg-white focus:ring-4 focus:ring-sky-100/60 @error('address') border-red-300 ring-2 ring-red-100 @enderror"
                            >

                            @error('address')
                                <p class="mt-1.5 text-xs font-medium text-med-red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="booking-problem" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                                Health Concern or Service Needed <span class="text-med-red">*</span>
                            </label>

                            <textarea
                                id="booking-problem"
                                wire:model="problem"
                                rows="3"
                                placeholder="Describe your symptoms, dental concern, or required consultation..."
                                class="mt-1.5 w-full resize-none rounded-2xl border border-slate-200/90 bg-slate-50/50 px-4 py-3 text-base sm:text-sm text-med-navy outline-none transition duration-200 placeholder:text-slate-400 hover:border-slate-300 focus:border-med-blue focus:bg-white focus:ring-4 focus:ring-sky-100/60 @error('problem') border-red-300 ring-2 ring-red-100 @enderror"
                            ></textarea>

                            @error('problem')
                                <p class="mt-1.5 text-xs font-medium text-med-red">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex flex-col-reverse gap-4 border-t border-slate-100 pt-5 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-xs leading-5 text-slate-400">
                            By submitting, you agree to be contacted for this visit.
                        </p>

                        <button
                            type="submit"
                            wire:loading.attr="disabled"
                            wire:target="submit"
                            class="inline-flex w-full sm:w-auto shrink-0 items-center justify-center gap-2 rounded-full bg-med-navy px-8 py-3.5 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:-translate-y-0.5 hover:bg-med-blue hover:shadow-lg disabled:cursor-not-allowed disabled:opacity-70"
                        >
                            <i class="ri-loader-4-line animate-spin text-base" wire:loading wire:target="submit"></i>
                            <i class="ri-calendar-check-line text-base" wire:loading.remove wire:target="submit"></i>
                            <span wire:loading.remove wire:target="submit">Confirm Request</span>
                            <span wire:loading wire:target="submit">Submitting...</span>
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
