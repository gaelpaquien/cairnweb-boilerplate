@php
    $siteGlobal = \Statamic\Facades\GlobalSet::findByHandle('site')?->inCurrentSite();
    $uiGlobal = \Statamic\Facades\GlobalSet::findByHandle('ui')?->inCurrentSite();
    $navItems = $siteGlobal->get('nav_items', []);
    $legalLinks = $siteGlobal->get('footer_extra_links', []);
    $footerText = $siteGlobal->get('footer_text');
    $footerNavTitle = $siteGlobal->get('footer_nav_title');
    $footerCreditPrefix = $siteGlobal->get('footer_credit_prefix');
    $footerCreditLinkText = $siteGlobal->get('footer_credit_link_text');
    $footerCreditUrl = $siteGlobal->get('footer_credit_url');
    $copyright = str_replace('{year}', (string) date('Y'), (string) $siteGlobal->get('footer_copyright'));
    $email = $siteGlobal->get('email');
    $phone = $siteGlobal->get('phone');
    $address = $siteGlobal->get('address');
    $hours = $siteGlobal->get('business_hours');

    $allLinks = collect($navItems)->merge($legalLinks)->map(fn($item) => [
        'label' => $item['label'],
        'href' => \App\Support\Url::anchor($item['href']),
    ])->values();
@endphp

<footer data-footer aria-label="{{ $uiGlobal->get('footer_aria_label') }}">
    <div class="section-container">

        <div class="footer-tier footer-tier-brand">
            <x-logo />

            @if($footerText)
            <p class="footer-description">{{ $footerText }}</p>
            @endif
        </div>

        <hr class="footer-separator footer-separator--mobile-only" aria-hidden="true" />

        <div class="footer-tier footer-tier-contact">
            <div class="footer-contact">
                <x-contact-link type="phone" :value="$phone" class="footer-contact-item" />
                <x-contact-link type="email" :value="$email" class="footer-contact-item" />
                <x-contact-link type="address" :value="$address" class="footer-contact-item" />
                <x-contact-link type="hours" :value="$hours" class="footer-contact-item" />
            </div>
        </div>

        <hr class="footer-separator footer-separator--mobile-only" aria-hidden="true" />

        <div class="footer-tier footer-tier-nav">
            <nav aria-label="{{ $uiGlobal->get('footer_nav_aria_label') }}">
                <p class="footer-nav-title">{{ $footerNavTitle }}</p>
                <ul class="footer-nav-list">
                    @foreach($allLinks as $link)
                    <li>
                        <a href="{{ $link['href'] }}" class="footer-nav-link">{{ $link['label'] }}</a>
                    </li>
                    @endforeach
                </ul>
            </nav>
        </div>

        <hr class="footer-separator" aria-hidden="true" />

        <div class="footer-tier footer-tier-copyright">
            <p class="footer-copyright">{{ $copyright }}</p>

            @if($footerCreditLinkText && $footerCreditUrl)
                <p class="footer-credit">
                    {{ $footerCreditPrefix }}<a href="{{ $footerCreditUrl }}" target="_blank" rel="noopener noreferrer" class="footer-credit-link">{{ $footerCreditLinkText }}</a>
                </p>
            @endif
        </div>
    </div>

</footer>
