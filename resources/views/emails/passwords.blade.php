@component('mail::message')
# Log in Credentials

Dear {{ $data['name'] }},

Please use **{{ $data['password'] }}** to log in to RUV-BF.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
