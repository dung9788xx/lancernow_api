@component('mail::message')
 {{trans('response.verify_account_mail_content')}}
@component('mail::button', ['url' => $link])
    {{trans('response.verify')}}
@endcomponent

 {{trans('response.thanks')}},<br>
{{ config('app.name') }}
@endcomponent
