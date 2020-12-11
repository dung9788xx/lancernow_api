<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'invalidEmailPassword' => 'Invalid email or password!',
    'need_login' => 'Please login!',
    'email_not_found' => 'Email not found!',
    'try_after' => 'Please try again after :minutes minutes!',
    'something_wrong' => 'Something went wrong please try again !',
    'mail_sent' => 'Mail sent to your email inbox, if you don\'t see this email please check your spam mail box.',
    'forgot_password_mail_subject' => 'Reset password from '.config('app.name'),
    'forgot_password_mail_content' => "Click this link bellow to reset your password, don't not share this link to anyone, link will be expired in '.config('mail.timeout_link_reset_password').' minutes.",
    'reset_password_button' => 'Reset password',
    'thanks' => "Cảm ơn",
    'token_expired' => "Token is expired!",
    'password_changed' => "Your password reset successfully ",
    'email_existed' => 'The email is existed try another email or reset your password',
    'verify_email' => 'Verify email from '.config('app.name'),
    'register_success' => 'Register success please check your email to verify account',
    'verify_account_mail_subject' => 'Verify '.config('app.name').' account ',
    'verify_account_mail_content' => 'Thank you for registered '.config('app.name').' account. Please click the link bellow to verify your email:',
    'verify' => 'Verify email'
];
