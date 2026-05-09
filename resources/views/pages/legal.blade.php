@extends('layouts.default')

@if($meta_title ?? null)
    @section('meta_title', $meta_title)
@elseif($title ?? null)
    @section('meta_title', $title . ' — ' . config('app.name'))
@endif

@if($meta_description ?? null)
    @section('meta_description', $meta_description)
@endif

@section('og_type', 'article')

@section('content')
    <x-section theme="light" padding="default" class="legal-section">
        <article class="prose max-w-none legal-article">
            <h1 class="legal-title">{{ $title }}</h1>

            <div class="legal-content">
                {!! $content !!}
            </div>
        </article>
    </x-section>
@endsection
