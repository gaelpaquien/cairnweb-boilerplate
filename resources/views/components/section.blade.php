@props([
    'theme' => 'light',
    'padding' => 'default',
    'grain' => false,
    'id' => null,
    'label' => null,
])

<section
    data-section
    data-section-theme="{{ $theme }}"
    data-padding="{{ $padding }}"
    @if($grain) data-grain @endif
    @if($id) id="{{ $id }}" @endif
    @if($label) aria-labelledby="{{ $label }}" @endif
    {{ $attributes }}
>
    <div class="section-container">
        {{ $slot }}
    </div>
</section>
