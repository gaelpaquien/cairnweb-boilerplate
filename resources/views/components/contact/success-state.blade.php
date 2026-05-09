@props(['contact', 'site'])

@php
    $phone = $site?->get('phone');
    $email = $site?->get('email');
    $intro = $contact?->get('success_contact_intro');
@endphp

<div {{ $attributes->merge(['class' => 'contact-success']) }} role="status" aria-live="polite">
    <x-icons.check class="contact-success-icon" />
    <h3 class="contact-success-title">{{ $contact->get('success_title') }}</h3>
    <p class="contact-success-message">{{ $contact->get('success_message') }}</p>

    @if($phone || $email)
        <div class="contact-success-fallback">
            @if($intro)
                <p class="contact-success-fallback-intro">{{ $intro }}</p>
            @endif
            <div class="contact-success-fallback-row">
                @if($phone)
                    <a href="tel:{{ preg_replace('/\s+/', '', $phone) }}" class="contact-success-fallback-item">
                        <x-icons.phone class="w-4 h-4" />
                        {{ $phone }}
                    </a>
                @endif

                @if($phone && $email)
                    <span class="contact-success-fallback-separator" aria-hidden="true"></span>
                @endif

                @if($email)
                    <a href="mailto:{{ $email }}" class="contact-success-fallback-item">
                        <x-icons.mail class="w-4 h-4" />
                        {{ $email }}
                    </a>
                @endif
            </div>
        </div>
    @endif
</div>
