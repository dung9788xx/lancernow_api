@component('mail::message')
    {{trans('response.forgot_password_mail_content')}}
    @component('mail::button', ['url' => $link])
        {{trans('response.reset_password_button')}}
    @endcomponent

    {{trans('response.thanks')}},
    {{ config('app.name') }}
@endcomponent
