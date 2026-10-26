<div class="flex min-h-screen items-center justify-center bg-slate-50 px-5 py-12">
    <div class="w-full max-w-[420px]">

        {{-- Brand --}}
        <div class="mb-8 flex flex-col items-center text-center">
            <a href="{{ route('home') }}" class="flex items-center gap-3" wire:navigate>
                <img
                    src="{{ asset('logo.webp') }}"
                    alt="MediDENT Multicare Clinic"
                    class="h-12 w-auto object-contain">

                <span class="text-left">
                    <span class="block text-base font-bold leading-none tracking-tight text-med-navy">MediDENT</span>
                    <span class="mt-1 block text-[10px] font-medium uppercase tracking-[0.18em] text-slate-400">
                        Admin
                    </span>
                </span>
            </a>

            <h1 class="mt-7 text-2xl font-bold tracking-tight text-med-navy sm:text-3xl">
                Sign in to your account
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Manage appointments, patients and clinic services.
            </p>
        </div>

        {{-- Form card --}}
        <div class="border border-slate-200 bg-white p-6 sm:p-8">
            <form wire:submit="login" class="space-y-5">

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">
                        Email address
                    </label>

                    <input
                        id="email"
                        type="email"
                        wire:model="email"
                        autocomplete="email"
                        autofocus
                        placeholder="admin@medidentclinic.com"
                        class="mt-2 w-full border border-slate-200 px-3.5 py-2.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-4 focus:ring-sky-50 @error('email') border-red-300 focus:border-red-400 focus:ring-red-50 @enderror">
                </div>

                <div x-data="{ showPassword: false }">
                    <label for="password" class="block text-sm font-medium text-slate-700">
                        Password
                    </label>

                    <div class="relative mt-2">
                        <input
                            id="password"
                            :type="showPassword ? 'text' : 'password'"
                            wire:model="password"
                            autocomplete="current-password"
                            placeholder="Enter your password"
                            class="w-full border border-slate-200 px-3.5 py-2.5 pr-11 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-4 focus:ring-sky-50 @error('password') border-red-300 focus:border-red-400 focus:ring-red-50 @enderror">

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
                    <div class="border border-red-100 bg-red-50 px-3.5 py-2.5 text-xs leading-6 text-red-600">
                        {{ $errors->first() }}
                    </div>
                @endif

                <label class="flex w-fit cursor-pointer items-center gap-2.5 text-sm text-slate-600">
                    <input
                        type="checkbox"
                        wire:model="remember"
                        class="h-4 w-4 border-slate-300 text-med-blue focus:ring-med-blue">
                    Keep me signed in
                </label>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    wire:target="login"
                    class="flex w-full items-center justify-center gap-2.5 bg-med-blue px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-sky-800 data-loading:cursor-wait data-loading:opacity-70">
                    <span wire:loading.remove wire:target="login">Sign in</span>
                    <span wire:loading wire:target="login">Signing in...</span>
                    <i class="ri-arrow-right-line" wire:loading.remove wire:target="login"></i>
                    <i class="ri-loader-4-line animate-spin" wire:loading wire:target="login"></i>
                </button>
            </form>

            <div class="mt-6 border-t border-slate-100 pt-5 text-center">
                <a href="{{ route('home') }}"
                    class="inline-flex items-center gap-2 text-xs font-medium text-slate-500 transition hover:text-med-blue"
                    wire:navigate>
                    <i class="ri-arrow-left-line"></i>
                    Back to clinic website
                </a>
            </div>
        </div>

        <p class="mt-6 text-center text-[11px] text-slate-400">
            Secure admin access · MediDENT Multicare Clinic
        </p>
    </div>
</div>
