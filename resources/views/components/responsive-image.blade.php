@props([
    'asset',
    'sizes' => '100vw',
    'widths' => [400, 800, 1200],
    'loading' => 'lazy',
    'fetchpriority' => null,
])

@php
    $alt = $asset->get('alt') ?: '';
    $srcset = collect($widths)
        ->map(fn ($w) => \Statamic\Facades\Image::manipulate($asset, ['w' => $w])." {$w}w")
        ->implode(', ');
    $defaultSrc = \Statamic\Facades\Image::manipulate($asset, ['w' => end($widths)]);
@endphp

<img
    {{ $attributes }}
    src="{{ $defaultSrc }}"
    srcset="{{ $srcset }}"
    sizes="{{ $sizes }}"
    alt="{{ $alt }}"
    loading="{{ $loading }}"
    @if($fetchpriority) fetchpriority="{{ $fetchpriority }}" @endif
    width="{{ $asset->width() }}"
    height="{{ $asset->height() }}"
>
