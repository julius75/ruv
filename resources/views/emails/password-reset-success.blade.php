@component('mail::message')
# Reset Successful

Dear {{ $data['name'] }},

Your password has been successfully reset.

Kind regards,<br>
{{ config('app.name') }}
@endcomponent
