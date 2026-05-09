<?php extract((new \Illuminate\Support\Collection($attributes->getAttributes()))->mapWithKeys(function ($value, $key) { return [Illuminate\Support\Str::camel(str_replace([':', '.'], ' ', $key)) => $value]; })->all(), EXTR_SKIP); ?>
@props(['class','ariaHidden'])
<x-icons.map-pin :class="$class" :aria-hidden="$ariaHidden" >

{{ $slot ?? "" }}
</x-icons.map-pin>