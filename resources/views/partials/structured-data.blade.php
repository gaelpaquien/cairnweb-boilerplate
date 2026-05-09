@php
    $siteGlobal = \Statamic\Facades\GlobalSet::findByHandle('site')?->inCurrentSite();
    $uiGlobal = \Statamic\Facades\GlobalSet::findByHandle('ui')?->inCurrentSite();
    $siteUrl = config('app.url');
    $agencyName = $siteGlobal->get('agency_name');
    $siteLocale = (string) $siteGlobal->get('site_locale');
    $primaryLanguage = explode('-', $siteLocale)[0];

    $ogImageAsset = $siteGlobal->augmentedValue('og_image')?->value();
    $logoAsset = $siteGlobal->augmentedValue('schema_logo')?->value();

    $websiteSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        '@id' => rtrim($siteUrl, '/').'/#website',
        'name' => $agencyName,
        'url' => $siteUrl,
        'inLanguage' => $siteLocale,
    ];

    if ($logoAsset) {
        $websiteSchema['logo'] = $logoAsset->url();
    }

    $areasServed = collect($siteGlobal->get('schema_areas_served', []))->map(function ($area) {
        return ['@type' => 'AdministrativeArea', 'name' => $area];
    })->all();

    $businessSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'ProfessionalService',
        '@id' => rtrim($siteUrl, '/').'/#business',
        'name' => $agencyName,
        'url' => $siteUrl,
        'telephone' => $siteGlobal->get('phone'),
        'email' => $siteGlobal->get('email'),
        'areaServed' => $areasServed,
        'knowsLanguage' => $primaryLanguage,
        'priceRange' => $siteGlobal->get('schema_price_range'),
        'openingHours' => $siteGlobal->get('schema_opening_hours'),
        'description' => $siteGlobal->get('schema_description'),
        'serviceType' => $siteGlobal->get('schema_service_types', []),
    ];

    if ($founderName = $siteGlobal->get('legal_founder_name')) {
        $founder = [
            '@type' => 'Person',
            'name' => $founderName,
        ];

        $founderSameAs = $siteGlobal->get('legal_founder_same_as');
        if (is_array($founderSameAs) && count($founderSameAs) > 0) {
            $founder['sameAs'] = array_values($founderSameAs);
        }

        $businessSchema['founder'] = $founder;
    }

    if ($vatId = $siteGlobal->get('legal_vat_id')) {
        $businessSchema['vatID'] = $vatId;
    }

    if ($siren = $siteGlobal->get('legal_siren')) {
        $businessSchema['taxID'] = $siren;
    }

    $sameAs = $siteGlobal->get('same_as');
    if (is_array($sameAs) && count($sameAs) > 0) {
        $businessSchema['sameAs'] = array_values($sameAs);
    }

    if ($ogImageAsset) {
        $businessSchema['image'] = $ogImageAsset->url();
    }
    if ($logoAsset) {
        $businessSchema['logo'] = $logoAsset->url();
    }
@endphp

<script type="application/ld+json">{!! json_encode($websiteSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
<script type="application/ld+json">{!! json_encode($businessSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>

@php
    $currentEntry = \Statamic\Facades\Entry::query()
        ->where('collection', 'pages')
        ->where('uri', '/'.trim(request()->path(), '/'))
        ->first();

    $isSubPage = $currentEntry && request()->path() !== '/';
@endphp

@if($isSubPage)
@php
    $breadcrumbSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => $uiGlobal?->get('breadcrumb_home_label'),
                'item' => rtrim($siteUrl, '/').'/',
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => $currentEntry->get('title'),
                'item' => url()->current(),
            ],
        ],
    ];

    $webPageSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'WebPage',
        '@id' => url()->current().'#webpage',
        'url' => url()->current(),
        'name' => $currentEntry->get('title'),
        'inLanguage' => $siteLocale,
        'isPartOf' => ['@id' => rtrim($siteUrl, '/').'/#website'],
        'dateModified' => $currentEntry->lastModified()?->toIso8601String(),
    ];
@endphp
<script type="application/ld+json">{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
<script type="application/ld+json">{!! json_encode($webPageSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endif
