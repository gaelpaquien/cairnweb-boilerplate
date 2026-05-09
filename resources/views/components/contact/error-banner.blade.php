@props(['message' => null, 'visible' => false])

<div {{ $attributes->class(['contact-error-banner', 'is-visible' => $visible]) }} role="alert" aria-live="polite">
    {{ $message }}
</div>
