@component('mail::message')
# Passcode Verification (OTP)

Dear {{ $data['name'] }},

Please use **{{ $data['passcode'] }}** to verify on the mobile app.

Kind regards,<br>
{{ config('app.name') }}
@endcomponent
