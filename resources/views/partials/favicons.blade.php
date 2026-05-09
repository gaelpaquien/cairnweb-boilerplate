@php
    $siteGlobal = \Statamic\Facades\GlobalSet::findByHandle('site')?->inCurrentSite();

    $faviconIco = $siteGlobal->augmentedValue('favicon_ico')?->value();
    $favicon32 = $siteGlobal->augmentedValue('favicon_32')?->value();
    $favicon16 = $siteGlobal->augmentedValue('favicon_16')?->value();
    $appleTouchIcon = $siteGlobal->augmentedValue('apple_touch_icon')?->value();
@endphp

@if($faviconIco)
<link rel="icon" href="{{ $faviconIco->url() }}" sizes="any">
@endif
@if($favicon32)
<link rel="icon" type="image/png" sizes="32x32" href="{{ $favicon32->url() }}">
@endif
@if($favicon16)
<link rel="icon" type="image/png" sizes="16x16" href="{{ $favicon16->url() }}">
@endif
@if($appleTouchIcon)
<link rel="apple-touch-icon" href="{{ $appleTouchIcon->url() }}">
@endif
