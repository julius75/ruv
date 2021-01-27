@component('mail::message')
# Reset Token

Dear {{ $data['name'] }},

Your password reset token is **{{ $data['token'] }}**.

Kind regards,<br>
{{ config('app.name') }}
@endcomponent
