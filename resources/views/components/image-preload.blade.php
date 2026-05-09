@props([
    'asset',
    'sizes' => '100vw',
    'widths' => [400, 800, 1200],
    'fetchpriority' => 'high',
])

@php
    $srcset = collect($widths)
        ->map(fn ($w) => \Statamic\Facades\Image::manipulate($asset, ['w' => $w])." {$w}w")
        ->implode(', ');
    $defaultSrc = \Statamic\Facades\Image::manipulate($asset, ['w' => end($widths)]);
@endphp

<link rel="preload" as="image" href="{{ $defaultSrc }}" imagesrcset="{{ $srcset }}" imagesizes="{{ $sizes }}" fetchpriority="{{ $fetchpriority }}">
