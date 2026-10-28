@props([
    'code' => '500',
    'title' => 'Something went wrong',
    'description' => 'We could not complete your request. Please try again.',
    'icon' => 'ri-error-warning-line',
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#12324a">
    <meta name="robots" content="noindex, nofollow">

    <title>{{ $code }} {{ $title }} | MediDENT Multicare Clinic</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#FAFDFE] font-sans text-slate-700 antialiased selection:bg-med-blue selection:text-white">
    <div class="flex min-h-screen flex-col">

        {{-- Header --}}
        <header class="border-b border-slate-100 bg-white/80 backdrop-blur-md sticky top-0 z-40">
            <div class="mx-auto flex h-20 max-w-7xl items-center justify-between gap-4 px-5 sm:px-6 lg:px-8">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 transition-transform hover:scale-105" aria-label="MediDENT home">
                    <img
                        src="{{ asset('logo.webp') }}"
                        alt="MediDENT Multicare Clinic"
                        class="h-10 w-auto object-contain sm:h-11"
                    >

                    <span class="hidden sm:block">
                        <span class="block text-base font-extrabold leading-none tracking-tight text-med-navy">MediDENT<span class="text-med-blue">.</span></span>
                        <span class="mt-1 block text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">
                            Multicare Clinic
                        </span>
                    </span>
                </a>

                <a href="{{ route('home') }}"
                   class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-5 py-2 text-xs font-semibold text-med-navy shadow-sm transition-all duration-200 hover:border-med-blue hover:text-med-blue sm:text-sm">
                    <i class="ri-home-4-line text-sm"></i>
                    <span class="hidden sm:inline">Back to home</span>
                    <span class="sm:hidden">Home</span>
                </a>
            </div>
        </header>

        {{-- Error content --}}
        <main class="flex flex-1 items-center">
            <section class="relative w-full overflow-hidden py-16 sm:py-24 lg:py-28">
                <div class="pointer-events-none absolute -top-24 right-0 h-96 w-96 rounded-full bg-sky-100/50 blur-3xl"></div>
                <div class="pointer-events-none absolute bottom-0 left-10 h-80 w-80 rounded-full bg-teal-50/50 blur-3xl"></div>

                <div class="relative mx-auto max-w-3xl px-5 text-center sm:px-6 lg:px-8">
                    <span class="inline-flex items-center gap-2 rounded-full border border-sky-100 bg-white px-3.5 py-1.5 text-xs font-semibold uppercase tracking-wider text-med-blue shadow-sm">
                        <i class="ri-alert-line text-sm"></i>
                        <span>Error {{ $code }}</span>
                    </span>

                    <p class="mt-8 text-[6rem] font-extrabold leading-none tracking-[-0.06em] text-slate-200/80 sm:text-[9rem]" aria-hidden="true">
                        {{ $code }}
                    </p>

                    <span class="relative mx-auto -mt-10 grid h-18 w-18 place-items-center rounded-2xl bg-white text-3xl text-med-blue shadow-[0_15px_40px_rgba(18,50,74,0.12)] border border-slate-100">
                        <i class="{{ $icon }}"></i>
                    </span>

                    <h1 class="mt-8 text-3xl font-extrabold tracking-tight text-med-navy sm:text-4xl lg:text-5xl">
                        {{ $title }}<span class="text-med-blue">.</span>
                    </h1>

                    <p class="mx-auto mt-4 max-w-xl text-base leading-relaxed text-slate-600 sm:text-lg">
                        {{ $description }}
                    </p>

                    <div class="mt-10 flex flex-col justify-center gap-3.5 sm:flex-row sm:items-center">
                        <a href="{{ route('home') }}"
                           class="inline-flex items-center justify-center gap-2 rounded-full bg-med-navy px-8 py-3.5 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:bg-med-blue hover:shadow-lg active:translate-y-0">
                            <i class="ri-home-4-line text-base"></i>
                            <span>Go to homepage</span>
                        </a>

                        <a href="{{ route('contact') }}"
                           class="inline-flex items-center justify-center gap-2 rounded-full border border-slate-200 bg-white px-8 py-3.5 text-sm font-semibold text-med-navy shadow-sm transition-all duration-200 hover:border-med-blue hover:text-med-blue hover:bg-slate-50">
                            <i class="ri-mail-line text-base"></i>
                            <span>Contact the clinic</span>
                        </a>
                    </div>

                    {{ $slot }}
                </div>
            </section>
        </main>

        {{-- Footer --}}
        <footer class="border-t border-slate-100 bg-white">
            <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-4 px-5 py-6 text-center sm:flex-row sm:px-6 sm:text-left lg:px-8">
                <p class="text-xs font-medium text-slate-400">
                    &copy; {{ date('Y') }} MediDENT Multicare Clinic. All rights reserved.
                </p>

                <nav class="flex flex-wrap items-center justify-center gap-x-6 gap-y-2 text-xs font-semibold text-slate-500" aria-label="Helpful links">
                    <a href="{{ route('home') }}" class="transition-colors hover:text-med-blue">Home</a>
                    <a href="{{ route('about') }}" class="transition-colors hover:text-med-blue">About</a>
                    <a href="{{ route('services') }}" class="transition-colors hover:text-med-blue">Services</a>
                    <a href="{{ route('blog') }}" class="transition-colors hover:text-med-blue">Blog</a>
                    <a href="{{ route('contact') }}" class="transition-colors hover:text-med-blue">Contact</a>
                </nav>
            </div>
        </footer>
    </div>
</body>
</html>
