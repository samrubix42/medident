
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @php
        $pageTitle = $title ?? config('app.name', 'MediDENT Multicare Clinic');
        $pageDescription = $metaDescription ?? 'Medical, diabetes and dental care for your whole family at MediDENT Multicare Clinic.';
        $canonicalUrl = $canonical ?? url()->current();
        $sharingTitle = $ogTitle ?? $pageTitle;
        $sharingDescription = $ogDescription ?? $pageDescription;
        $sharingImage = $metaImage ?? null;
    @endphp

    <title>{{ $pageTitle }}</title>

    <meta name="theme-color" content="#12324a">
    <meta name="description" content="{{ $pageDescription }}">
    <meta name="robots" content="{{ $metaRobots ?? 'index, follow' }}">
    <link rel="canonical" href="{{ $canonicalUrl }}">

    @if (! empty($metaKeyword))
        <meta name="keywords" content="{{ $metaKeyword }}">
    @endif

    <meta property="og:type" content="{{ $ogType ?? 'website' }}">
    <meta property="og:site_name" content="{{ config('app.name', 'MediDENT Multicare Clinic') }}">
    <meta property="og:title" content="{{ $sharingTitle }}">
    <meta property="og:description" content="{{ $sharingDescription }}">
    <meta property="og:url" content="{{ $canonicalUrl }}">

    @if (! empty($articlePublishedTime))
        <meta property="article:published_time" content="{{ $articlePublishedTime }}">
    @endif

    @if (! empty($articleModifiedTime))
        <meta property="article:modified_time" content="{{ $articleModifiedTime }}">
    @endif

    @if (! empty($articleSection))
        <meta property="article:section" content="{{ $articleSection }}">
    @endif

    @if (! empty($sharingImage))
        <meta property="og:image" content="{{ $sharingImage }}">
        <meta property="og:image:alt" content="{{ $pageTitle }}">
    @endif

    <meta name="twitter:card" content="{{ $sharingImage ? 'summary_large_image' : 'summary' }}">
    <meta name="twitter:title" content="{{ $sharingTitle }}">
    <meta name="twitter:description" content="{{ $sharingDescription }}">

    @if ($sharingImage)
        <meta name="twitter:image" content="{{ $sharingImage }}">
    @endif

    @if (! empty($schema))
        <script type="application/ld+json">{!! $schema !!}</script>
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
