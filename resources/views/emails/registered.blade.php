@component('mail::message')
# Registration Successful

Dear {{ $data['name'] }},

Your registration is successful.

Welcome to {{ config('app.name') }}.

Kind regards,<br>
{{ config('app.name') }}
@endcomponent
