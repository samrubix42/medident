
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name', 'MediDENT Multicare Clinic') }}</title>

    <meta name="theme-color" content="#12324a">
    <meta name="description" content="{{ $metaDescription ?? 'Medical, diabetes and dental care for your whole family at MediDENT Multicare Clinic.' }}">

    @if (! empty($metaKeyword))
        <meta name="keywords" content="{{ $metaKeyword }}">
    @endif

    @if (! empty($metaImage))
        <meta property="og:image" content="{{ $metaImage }}">
    @endif

    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="min-h-screen bg-white font-sans text-slate-700 antialiased">

    <livewire:public.header />

    <main>
        {{ $slot }}
    </main>

    <livewire:public.footer />

    <livewire:public.booking-modal />

    @livewireScripts
</body>
</html>
