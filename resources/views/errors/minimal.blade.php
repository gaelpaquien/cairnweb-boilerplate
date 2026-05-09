@extends('layouts.default')

@php
    $siteGlobal = \Statamic\Facades\GlobalSet::findByHandle('site')?->inCurrentSite();
    $errorData = collect($siteGlobal?->get('errors') ?? [])
        ->firstWhere('code', (string) $code) ?? [];
    $metaTitle = $errorData['meta_title'] ?? $code;
    $heading = $errorData['heading'] ?? $metaTitle;
    $message = $errorData['message'] ?? null;
    $buttonText = $siteGlobal?->get('error_button_text');
@endphp

@section('meta_title', $metaTitle . ' — ' . $siteGlobal?->get('agency_name'))
@section('meta_robots', 'noindex, follow')
@section('body_class', 'is-error-page')

@section('content')
    <x-section theme="light" padding="none">
        <div class="error-page">
            <p class="error-code">{{ $code }}</p>
            <h1 class="error-heading">{{ $heading }}</h1>
            @if($message)
                <p class="error-message">{{ $message }}</p>
            @endif
            <div class="error-actions">
                <x-button variant="primary" href="/">{{ $buttonText }}</x-button>
            </div>
        </div>
    </x-section>
@endsection
