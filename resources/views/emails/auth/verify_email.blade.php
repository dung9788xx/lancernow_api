@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => $link])
    {{trans('response.reset_password_button')}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
