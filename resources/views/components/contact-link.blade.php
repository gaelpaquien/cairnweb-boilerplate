@props([
    'type' => 'phone',
    'value' => null,
    'iconSize' => 'w-4 h-4',
])

@php
    $icon = match ($type) {
        'phone' => 'icons.phone',
        'email' => 'icons.mail',
        'address' => 'icons.map-pin',
        'hours' => 'icons.clock',
        default => null,
    };

    $href = match ($type) {
        'phone' => 'tel:'.preg_replace('/\s/', '', (string) $value),
        'email' => 'mailto:'.$value,
        default => null,
    };
@endphp

@if($value)
    @if($href)
        <a href="{{ $href }}" {{ $attributes }}>
            <x-dynamic-component :component="$icon" :class="$iconSize.' shrink-0'" aria-hidden="true" />
            {{ $value }}
        </a>
    @else
        <span {{ $attributes }}>
            <x-dynamic-component :component="$icon" :class="$iconSize.' shrink-0'" aria-hidden="true" />
            {{ $value }}
        </span>
    @endif
@endif
