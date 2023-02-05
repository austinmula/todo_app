@component('mail::message')
# Success!!

Todo Created Successfully

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
