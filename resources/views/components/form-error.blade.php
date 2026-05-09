@props(['field', 'id' => null])

<span
    @if($id) id="{{ $id }}" @endif
    class="form-error @error($field) is-visible @enderror"
    aria-live="polite"
    data-contact-error-for="{{ $field }}"
>@error($field){{ $message }}@enderror</span>
