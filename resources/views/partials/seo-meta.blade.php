@php
    $siteGlobal = \Statamic\Facades\GlobalSet::findByHandle('site')?->inCurrentSite();
    $agencyName = $siteGlobal->get('agency_name');
    $ogImageAsset = $siteGlobal->augmentedValue('og_image')?->value();

    // Cache-bust the OG image URL so social platforms refetch when it's replaced.
    $ogImageDefault = '';
    $ogImageWidth = null;
    $ogImageHeight = null;
    if ($ogImageAsset) {
        $ogImageVersion = $ogImageAsset->lastModified()?->timestamp;
        $ogImageDefault = $ogImageAsset->url().($ogImageVersion ? '?v='.$ogImageVersion : '');
        $ogImageWidth = $ogImageAsset->width();
        $ogImageHeight = $ogImageAsset->height();
    }

    $metaTitle = $__env->yieldContent('meta_title', $siteGlobal->get('meta_title'));
    $metaDescription = $__env->yieldContent('meta_description', $siteGlobal->get('meta_description'));
    $ogImage = $__env->yieldContent('og_image', $ogImageDefault);
    $canonical = $__env->yieldContent('canonical', url()->current());
    $metaRobots = $__env->yieldContent('meta_robots', 'index, follow');
    $ogType = $__env->yieldContent('og_type', 'website');
    $siteLocale = (string) $siteGlobal->get('site_locale');
    $ogLocale = str_replace('-', '_', $siteLocale);
@endphp

<title>{{ $metaTitle }}</title>
<meta name="description" content="{{ $metaDescription }}">
<meta name="robots" content="{{ $metaRobots }}">
<link rel="canonical" href="{{ $canonical }}">
<meta name="theme-color" content="{{ $siteGlobal->get('theme_color') }}">

@if($siteGlobal->get('google_site_verification'))
<meta name="google-site-verification" content="{{ $siteGlobal->get('google_site_verification') }}">
@endif
@if($siteGlobal->get('bing_site_verification'))
<meta name="msvalidate.01" content="{{ $siteGlobal->get('bing_site_verification') }}">
@endif

<meta property="og:title" content="{{ $metaTitle }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:type" content="{{ $ogType }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:locale" content="{{ $ogLocale }}">
<meta property="og:site_name" content="{{ $agencyName }}">
@if($ogImage)
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:image:secure_url" content="{{ $ogImage }}">
@if($ogImageWidth && $ogImageHeight)
<meta property="og:image:width" content="{{ $ogImageWidth }}">
<meta property="og:image:height" content="{{ $ogImageHeight }}">
@endif
<meta property="og:image:alt" content="{{ $ogImageAsset ? $ogImageAsset->get('alt') : $agencyName }}">
@endif

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $metaTitle }}">
<meta name="twitter:description" content="{{ $metaDescription }}">
@if($ogImage)
<meta name="twitter:image" content="{{ $ogImage }}">
@endif
