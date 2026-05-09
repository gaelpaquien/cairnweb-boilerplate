@extends('layouts.default')

@php
    $heroGlobal = \Statamic\Facades\GlobalSet::findByHandle('hero')?->inCurrentSite();
    $contactGlobal = \Statamic\Facades\GlobalSet::findByHandle('contact')?->inCurrentSite();
    $siteGlobal = \Statamic\Facades\GlobalSet::findByHandle('site')?->inCurrentSite();

    $sectionItems = collect(['section_1', 'section_2', 'section_3', 'section_4'])
        ->map(fn ($handle) => \Statamic\Facades\GlobalSet::findByHandle($handle)?->inCurrentSite())
        ->filter()
        ->map(fn ($g) => [
            'slug' => str_replace('_', '-', $g->handle()),
            'title' => $g->get('title'),
            'content' => $g->get('content'),
        ])
        ->values()
        ->all();
@endphp

@section('content')
    <section
        data-section
        data-section-theme="dark"
        data-grain
        id="hero"
        aria-labelledby="hero-heading"
        class="relative min-h-svh 2xl:min-h-0 overflow-hidden flex items-center"
    >
        <div class="section-container relative z-10 hero-grid">

            <div class="hero-text">
                @if($heroGlobal->get('overtitle'))
                    <x-overtitle data-hero-animate>{{ $heroGlobal->get('overtitle') }}</x-overtitle>
                @endif

                <h1
                    id="hero-heading"
                    data-hero-animate
                    class="hero-title"
                >
                    @if($heroGlobal->get('title_accent'))
                        {!! str_replace(
                            $heroGlobal->get('title_accent'),
                            '<mark class="hero-highlight">' . e($heroGlobal->get('title_accent')) . '</mark>',
                            e($heroGlobal->get('title'))
                        ) !!}
                    @else
                        {{ $heroGlobal->get('title') }}
                    @endif
                </h1>

                <p data-hero-animate class="hero-subtitle">
                    {{ $heroGlobal->get('subtitle') }}
                </p>

                <div data-hero-animate class="hero-cta-wrapper">
                    <x-button variant="primary" :href="$heroGlobal->get('cta_primary_target')" data-hero-cta>
                        {{ $heroGlobal->get('cta_primary_text') }}
                    </x-button>
                </div>
            </div>

        </div>

    </section>

    @foreach($sectionItems as $index => $item)
        @php
            $theme = $index % 2 === 0 ? 'light' : 'dark';
            $sectionId = $item['slug'] ?? 'section-' . ($index + 1);
            $headingId = $sectionId . '-heading';
        @endphp
        <x-section :theme="$theme" :id="$sectionId" :label="$headingId" :grain="$theme === 'dark'">
            <div class="generic-section" data-gsap="fade-up">
                <h2 id="{{ $headingId }}" class="generic-section-title">
                    {{ $item['title'] }}
                </h2>
                @if($item['content'] ?? null)
                    <p class="generic-section-content">
                        {{ $item['content'] }}
                    </p>
                @endif
            </div>
        </x-section>
    @endforeach

    @php
        $contactTheme = count($sectionItems) % 2 === 0 ? 'light' : 'dark';
    @endphp
    <x-section :theme="$contactTheme" id="contact" label="contact-heading">
        <div data-gsap="fade-up">
            <h2 id="contact-heading" class="contact-title">
                {{ $contactGlobal->get('section_title') }}
            </h2>

            @if(session('contact_success'))
                <x-contact.success-state :contact="$contactGlobal" :site="$siteGlobal" />
                @production
                <script>
                    window.plausible = window.plausible || function() { (window.plausible.q = window.plausible.q || []).push(arguments) };
                    window.plausible('Contact Form Submit');
                </script>
                @endproduction
            @else
                <form
                    action="{{ route('contact.store') }}"
                    method="POST"
                    class="contact-form"
                    data-contact-form
                    data-state="idle"
                    data-error-message="{{ $contactGlobal->get('error_message') }}"
                    data-rate-limit-message="{{ $contactGlobal->get('rate_limit_message') }}"
                    novalidate
                >
                    @csrf

                    {{-- Honeypot — hidden from users and AT, visible to bots that auto-fill known field names --}}
                    <div class="contact-hp" aria-hidden="true">
                        <input type="text" name="website" tabindex="-1" autocomplete="off">
                    </div>

                    {{-- Timestamp — JS overrides it at load (the page is statically cached) --}}
                    <input type="hidden" name="form_loaded_at" value="{{ time() }}">

                    <div data-contact-body>
                        <x-contact.error-banner
                            data-contact-error-banner
                            :message="session('contact_error') ? $contactGlobal->get('error_message') : null"
                            :visible="(bool) session('contact_error')"
                        />

                        <x-form-field
                            name="first_name"
                            :label="$contactGlobal->get('label_firstname')"
                            :placeholder="$contactGlobal->get('placeholder_firstname')"
                            required
                            autocomplete="given-name"
                        />

                        <x-form-field
                            name="last_name"
                            :label="$contactGlobal->get('label_lastname')"
                            :placeholder="$contactGlobal->get('placeholder_lastname')"
                            required
                            autocomplete="family-name"
                        />

                        <x-form-field
                            type="email"
                            name="email"
                            :label="$contactGlobal->get('label_email')"
                            :placeholder="$contactGlobal->get('placeholder_email')"
                            required
                            autocomplete="email"
                        />

                        <x-form-field
                            type="tel"
                            name="phone"
                            :label="$contactGlobal->get('label_phone')"
                            :placeholder="$contactGlobal->get('placeholder_phone')"
                            required
                            autocomplete="tel"
                        />

                        <x-form-field
                            type="textarea"
                            name="message"
                            :label="$contactGlobal->get('label_message')"
                            :placeholder="$contactGlobal->get('placeholder_message')"
                            required
                            :rows="5"
                        />

                        <button type="submit" class="contact-submit" data-contact-submit>
                            {{ $contactGlobal->get('submit_label') }}
                        </button>
                    </div>

                    {{-- AJAX success state — hidden by default via CSS, revealed when [data-state="success"] is set on the form --}}
                    <x-contact.success-state
                        :contact="$contactGlobal"
                        :site="$siteGlobal"
                        data-contact-success
                    />
                </form>
            @endif
        </div>
    </x-section>

@endsection
