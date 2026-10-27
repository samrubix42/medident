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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#f5fafc] font-sans text-slate-700 antialiased">
    <div class="flex min-h-screen flex-col">

        {{-- Header --}}
        <header class="border-b border-slate-200 bg-white">
            <div class="mx-auto flex h-20 max-w-7xl items-center justify-between gap-4 px-5 sm:px-6 lg:px-8">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3" aria-label="MediDENT home">
                    <img
                        src="{{ asset('logo.webp') }}"
                        alt="MediDENT Multicare Clinic"
                        class="h-10 w-auto object-contain sm:h-12"
                    >

                    <span class="hidden sm:block">
                        <span class="block text-sm font-bold leading-none tracking-tight text-med-navy">MediDENT</span>
                        <span class="mt-1 block text-[10px] font-semibold uppercase tracking-[0.16em] text-slate-400">
                            Multicare Clinic
                        </span>
                    </span>
                </a>

                <a href="{{ route('home') }}"
                   class="inline-flex items-center gap-2 border border-slate-200 bg-white px-4 py-2.5 text-xs font-semibold text-med-navy transition hover:border-sky-200 hover:text-med-blue sm:text-sm">
                    <i class="ri-home-4-line text-base"></i>
                    <span class="hidden sm:inline">Back to home</span>
                    <span class="sm:hidden">Home</span>
                </a>
            </div>
        </header>

        {{-- Error content --}}
        <main class="flex flex-1 items-center">
            <section class="relative w-full overflow-hidden py-14 sm:py-20 lg:py-24">
                <div class="pointer-events-none absolute -right-24 -top-24 h-80 w-80 rounded-full border-[46px] border-sky-100/70"></div>
                <div class="pointer-events-none absolute -bottom-28 left-1/4 h-64 w-64 rounded-full border-[34px] border-white"></div>

                <div class="relative mx-auto max-w-3xl px-5 text-center sm:px-6 lg:px-8">
                    <span class="inline-flex items-center gap-2 border border-sky-100 bg-white px-3 py-2 text-[10px] font-bold uppercase tracking-[0.16em] text-med-blue sm:text-xs">
                        <i class="ri-alert-line text-base"></i>
                        Error {{ $code }}
                    </span>

                    <p class="mt-7 text-[5.5rem] font-extrabold leading-none tracking-[-0.06em] text-slate-200 sm:text-[8rem]" aria-hidden="true">
                        {{ $code }}
                    </p>

                    <span class="relative mx-auto -mt-9 grid h-16 w-16 place-items-center bg-white text-3xl text-med-blue shadow-[0_12px_36px_rgba(18,50,74,0.12)]">
                        <i class="{{ $icon }}"></i>
                    </span>

                    <h1 class="mt-6 text-3xl font-bold tracking-tight text-med-navy sm:text-4xl">
                        {{ $title }}
                    </h1>

                    <p class="mx-auto mt-4 max-w-xl text-sm leading-7 text-slate-600 sm:text-base sm:leading-8">
                        {{ $description }}
                    </p>

                    <div class="mt-8 flex flex-col justify-center gap-3 sm:flex-row">
                        <a href="{{ route('home') }}"
                           class="inline-flex items-center justify-center gap-2 bg-med-blue px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-sky-800">
                            <i class="ri-home-4-line"></i>
                            Go to homepage
                        </a>

                        <a href="{{ route('contact') }}"
                           class="inline-flex items-center justify-center gap-2 border border-slate-300 bg-white px-6 py-3.5 text-sm font-semibold text-med-navy transition hover:border-med-blue hover:text-med-blue">
                            <i class="ri-mail-line"></i>
                            Contact the clinic
                        </a>
                    </div>

                    {{ $slot }}
                </div>
            </section>
        </main>

        {{-- Footer --}}
        <footer class="border-t border-slate-200 bg-white">
            <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-4 px-5 py-6 text-center sm:flex-row sm:px-6 sm:text-left lg:px-8">
                <p class="text-xs text-slate-400">
                    &copy; {{ date('Y') }} MediDENT Multicare Clinic. All rights reserved.
                </p>

                <nav class="flex flex-wrap items-center justify-center gap-x-5 gap-y-2 text-xs font-medium text-slate-500" aria-label="Helpful links">
                    <a href="{{ route('home') }}" class="transition hover:text-med-blue">Home</a>
                    <a href="{{ route('about') }}" class="transition hover:text-med-blue">About</a>
                    <a href="{{ route('blog') }}" class="transition hover:text-med-blue">Blog</a>
                    <a href="{{ route('contact') }}" class="transition hover:text-med-blue">Contact</a>
                </nav>
            </div>
        </footer>
    </div>
</body>
</html>
