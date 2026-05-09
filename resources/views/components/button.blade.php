@props([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
    'type' => 'button',
    'disabled' => false,
])

@if($href)
    <a
        href="{{ $href }}"
        data-button
        data-variant="{{ $variant }}"
        data-size="{{ $size }}"
        {{ $attributes }}
        @if($disabled) aria-disabled="true" tabindex="-1" @endif
    >
        {{ $slot }}
    </a>
@else
    <button
        type="{{ $type }}"
        data-button
        data-variant="{{ $variant }}"
        data-size="{{ $size }}"
        {{ $attributes }}
        @if($disabled) disabled @endif
    >
        {{ $slot }}
    </button>
@endif
