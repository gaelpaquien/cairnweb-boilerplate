<!DOCTYPE html>
@php
    $layoutSite = \Statamic\Facades\GlobalSet::findByHandle('site')?->inCurrentSite();
    $siteLocale = (string) ($layoutSite?->get('site_locale') ?? 'fr-FR');
    $htmlLang = explode('-', $siteLocale)[0];
@endphp
<html lang="{{ $htmlLang }}" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('partials.seo-meta')
    @include('partials.favicons')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="view-transition" content="same-origin">
    <script>document.documentElement.classList.remove('no-js');</script>

    <link rel="preload" href="/fonts/satoshi/Satoshi-Bold.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/fonts/satoshi/Satoshi-Black.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/fonts/dm-sans/DMSans-latin.woff2" as="font" type="font/woff2" crossorigin>

    @yield('preload')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('partials.structured-data')

    {{-- Plausible Analytics — RGPD-compliant (no cookies), no consent banner needed.
         Set PLAUSIBLE_SCRIPT_URL in .env to enable (script URL fournie par Plausible). --}}
    @production
        @if(env('PLAUSIBLE_SCRIPT_URL'))
            <script async src="{{ env('PLAUSIBLE_SCRIPT_URL') }}"></script>
            <script>
                window.plausible=window.plausible||function(){(plausible.q=plausible.q||[]).push(arguments)},plausible.init=plausible.init||function(i){plausible.o=i||{}};
                plausible.init()
            </script>
        @endif
    @endproduction
</head>
@php
    $isLegalPage = request()->is('mentions-legales') || request()->is('politique-confidentialite');
@endphp
<body class="{{ $isLegalPage ? 'is-legal-page ' : '' }}@yield('body_class')">
    @php($uiGlobal = \Statamic\Facades\GlobalSet::findByHandle('ui')?->inCurrentSite())
    <a href="#content" class="skip-link sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:rounded-md">
        {{ $uiGlobal->get('skip_link_label') }}
    </a>

    <header>
        <x-nav />
    </header>

    <main id="content">
        @yield('content')
    </main>

    <x-footer />

    @if($isLegalPage)
    {{-- Legal pages render Markdown from CMS; we can't add target/rel at render time, so we patch external links post-load. --}}
    <script>
      document.querySelectorAll('.legal-section .prose a[href^="http"]').forEach((a) => {
        a.target = '_blank';
        a.rel = 'noopener noreferrer';
      });
    </script>
    @endif
</body>
</html>
