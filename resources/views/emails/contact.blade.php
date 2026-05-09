@php
    $g = \Statamic\Facades\GlobalSet::findByHandle('contact')?->inCurrentSite();
@endphp
{{ $g?->get('email_intro_text') }}
============================================

{{ $g?->get('label_firstname') }} : {!! $data['first_name'] !!}
{{ $g?->get('label_lastname') }} : {!! $data['last_name'] !!}
{{ $g?->get('label_email') }} : {!! $data['email'] !!}
@if(!empty($data['phone']))
{{ $g?->get('label_phone') }} : {!! $data['phone'] !!}
@endif

{{ $g?->get('label_message') }} :
{!! $data['message'] !!}
