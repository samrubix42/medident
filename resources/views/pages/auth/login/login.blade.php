<div class="relative flex min-h-screen items-center justify-center overflow-hidden bg-[#FAFDFE] px-5 py-12">
    <div class="pointer-events-none absolute -top-24 right-0 h-96 w-96 rounded-full bg-sky-100/60 blur-3xl"></div>
    <div class="pointer-events-none absolute bottom-0 left-10 h-80 w-80 rounded-full bg-teal-50/60 blur-3xl"></div>

    <div class="relative w-full max-w-[430px]">

        {{-- Brand --}}
        <div class="mb-8 flex flex-col items-center text-center">
            <a href="{{ route('home') }}" class="flex items-center gap-3 transition-transform hover:scale-105" wire:navigate>
                <img
                    src="{{ asset('logo.webp') }}"
                    alt="MediDENT Multicare Clinic"
                    class="h-12 w-auto object-contain">

                <span class="text-left">
                    <span class="block text-base font-extrabold leading-none tracking-tight text-med-navy">MediDENT<span class="text-med-blue">.</span></span>
                    <span class="mt-1 block text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">
                        Admin Portal
                    </span>
                </span>
            </a>

            <h1 class="mt-6 text-2xl font-extrabold tracking-tight text-med-navy sm:text-3xl">
                Sign in to your account<span class="text-med-blue">.</span>
            </h1>

            <p class="mt-2 text-sm leading-relaxed text-slate-500">
                Manage appointments, patients, and clinic services.
            </p>
        </div>

        {{-- Form card --}}
        <div class="rounded-3xl border border-slate-100 bg-white p-7 shadow-[0_20px_60px_rgba(18,50,74,0.08)] sm:p-9">
            <form wire:submit="login" class="space-y-5">

                <div>
                    <label for="email" class="block text-sm font-semibold text-med-navy">
                        Email Address
                    </label>

                    <input
                        id="email"
                        type="email"
                        wire:model="email"
                        autocomplete="email"
                        autofocus
                        placeholder="admin@medidentclinic.com"
                        class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm text-slate-800 outline-none transition-all placeholder:text-slate-400 focus:bg-white focus:border-med-blue focus:ring-4 focus:ring-sky-100/50 @error('email') border-red-300 ring-2 ring-red-100 @enderror">
                </div>

                <div x-data="{ showPassword: false }">
                    <label for="password" class="block text-sm font-semibold text-med-navy">
                        Password
                    </label>

                    <div class="relative mt-2">
                        <input
                            id="password"
                            :type="showPassword ? 'text' : 'password'"
                            wire:model="password"
                            autocomplete="current-password"
                            placeholder="Enter your password"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 pr-11 text-sm text-slate-800 outline-none transition-all placeholder:text-slate-400 focus:bg-white focus:border-med-blue focus:ring-4 focus:ring-sky-100/50 @error('password') border-red-300 ring-2 ring-red-100 @enderror">

                        <button
                            type="button"
                            @click="showPassword = !showPassword"
                            :aria-label="showPassword ? 'Hide password' : 'Show password'"
                            class="absolute inset-y-0 right-0 grid w-11 place-items-center text-lg text-slate-400 transition hover:text-med-blue">
                            <i :class="showPassword ? 'ri-eye-off-line' : 'ri-eye-line'"></i>
                        </button>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="rounded-2xl border border-red-100 bg-red-50/80 px-4 py-3 text-xs font-medium leading-relaxed text-red-600">
                        {{ $errors->first() }}
                    </div>
                @endif

                <label class="flex w-fit cursor-pointer items-center gap-2.5 text-sm text-slate-600">
                    <input
                        type="checkbox"
                        wire:model="remember"
                        class="h-4 w-4 rounded border-slate-300 text-med-blue focus:ring-med-blue">
                    <span>Keep me signed in</span>
                </label>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    wire:target="login"
                    class="flex w-full items-center justify-center gap-2.5 rounded-full bg-med-navy px-6 py-3.5 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:bg-med-blue hover:shadow-lg active:translate-y-0 disabled:cursor-wait disabled:opacity-70">
                    <span wire:loading.remove wire:target="login">Sign in</span>
                    <span wire:loading wire:target="login">Signing in...</span>
                    <i class="ri-arrow-right-line text-xs" wire:loading.remove wire:target="login"></i>
                    <i class="ri-loader-4-line animate-spin text-sm" wire:loading wire:target="login"></i>
                </button>
            </form>

            <div class="mt-7 border-t border-slate-100 pt-6 text-center">
                <a href="{{ route('home') }}"
                    class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-5 py-2 text-xs font-semibold text-slate-600 shadow-sm transition-all duration-200 hover:border-med-blue hover:text-med-blue hover:bg-slate-50"
                    wire:navigate>
                    <i class="ri-arrow-left-line"></i>
                    <span>Back to clinic website</span>
                </a>
            </div>
        </div>

        <p class="mt-6 text-center text-xs text-slate-400">
            Secure admin access · MediDENT Multicare Clinic
        </p>
    </div>
</div>
