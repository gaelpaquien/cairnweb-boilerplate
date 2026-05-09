@props([])

<p {{ $attributes->merge(['class' => 'overtitle']) }}>
    {{ $slot }}
</p>
