@props([
    'name',
    'label',
    'type' => 'text',
    'placeholder' => null,
    'required' => false,
    'optional' => null,
    'autocomplete' => null,
    'rows' => 5,
    'idPrefix' => 'contact',
])

@php
    $id = $idPrefix.'-'.str_replace('_', '-', $name);
    $errorId = $id.'-error';
@endphp

<div class="form-group">
    <label class="form-label" for="{{ $id }}">
        {{ $label }}@if($required)<span class="form-label-required" aria-hidden="true">*</span>@elseif($optional)<span class="form-label-optional">({{ $optional }})</span>@endif
    </label>

    @if($type === 'textarea')
        <textarea
            name="{{ $name }}"
            id="{{ $id }}"
            class="form-input"
            placeholder="{{ $placeholder }}"
            @if($required) required aria-required="true" @endif
            aria-describedby="{{ $errorId }}"
            rows="{{ $rows }}"
            data-1p-ignore
            data-lpignore="true"
            data-bwignore
        >{{ old($name) }}</textarea>
    @else
        <input
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $id }}"
            class="form-input"
            placeholder="{{ $placeholder }}"
            @if($required) required aria-required="true" @endif
            aria-describedby="{{ $errorId }}"
            @if($autocomplete) autocomplete="{{ $autocomplete }}" @endif
            data-1p-ignore
            data-lpignore="true"
            data-bwignore
            value="{{ old($name) }}"
        >
    @endif

    <x-form-error :field="$name" :id="$errorId" />
</div>
