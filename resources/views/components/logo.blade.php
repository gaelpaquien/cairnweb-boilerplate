@php
    $siteGlobal = \Statamic\Facades\GlobalSet::findByHandle('site')?->inCurrentSite();
    $agencyName = (string) ($siteGlobal?->get('agency_name') ?? '');
    [$first, $second] = explode(' ', $agencyName, 2) + [1 => ''];
@endphp

<a href="/" {{ $attributes->class('site-logo') }}>
    <span class="site-logo-strong">{{ $first }}</span>@if($second !== '') <span class="site-logo-light">{{ $second }}</span>@endif
</a>
