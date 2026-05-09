@php
    $siteGlobal = \Statamic\Facades\GlobalSet::findByHandle('site')?->inCurrentSite();
    $uiGlobal = \Statamic\Facades\GlobalSet::findByHandle('ui')?->inCurrentSite();
    $navItems = $siteGlobal->get('nav_items', []);
    $navCtaText = $siteGlobal->get('nav_cta_text');
    $navCtaTarget = $siteGlobal->get('nav_cta_target');
    $isHomepage = request()->is('/');
@endphp

<nav
    data-nav
    @if(!$isHomepage) data-force-solid @endif
    aria-label="{{ $uiGlobal->get('nav_aria_label') }}"
    class="fixed top-0 left-0 right-0"
>
    <div class="section-container">
        <div class="flex items-center justify-between" data-nav-inner>
            <x-logo />

            <div class="hidden lg:flex items-center gap-8" data-nav-links>
                @foreach($navItems as $item)
                <a href="@anchor($item['href'])" data-nav-link class="relative font-medium transition-colors duration-300">
                    {{ $item['label'] }}
                </a>
                @endforeach
            </div>

            <div class="flex items-center gap-4">
                <div class="hidden lg:block" data-nav-cta>
                    <x-button variant="primary" size="sm" :href="\App\Support\Url::anchor($navCtaTarget)">
                        {{ $navCtaText }}
                    </x-button>
                </div>

                <button
                    data-mobile-toggle
                    aria-expanded="false"
                    aria-controls="mobile-panel"
                    aria-label="{{ $uiGlobal->get('nav_mobile_toggle_label') }}"
                    class="lg:hidden relative w-12 h-12 flex items-center justify-center"
                >
                    <div class="burger-icon" aria-hidden="true">
                        <span class="burger-line burger-line--1"></span>
                        <span class="burger-line burger-line--2"></span>
                        <span class="burger-line burger-line--3"></span>
                    </div>
                </button>
            </div>
        </div>
    </div>
</nav>

<div
    id="mobile-panel"
    data-mobile-panel
    role="dialog"
    aria-label="{{ $uiGlobal->get('nav_mobile_panel_label') }}"
    aria-modal="true"
    class="fixed inset-0 flex flex-col items-center justify-center lg:hidden"
>
    <nav class="mobile-menu-nav">
        @foreach($navItems as $item)
        <a href="@anchor($item['href'])" data-mobile-link class="mobile-menu-link">
            {{ $item['label'] }}
        </a>
        @endforeach

        <div class="mobile-menu-cta" data-mobile-link>
            <x-button variant="primary" size="md" :href="\App\Support\Url::anchor($navCtaTarget)" class="w-full justify-center" data-mobile-cta>
                {{ $navCtaText }}
            </x-button>
        </div>
    </nav>
</div>
