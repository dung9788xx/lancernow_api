<?php


namespace App\Services;


use App\User;
use Carbon\Carbon;

class AuthServices
{
    /**
     * @param $email
     */
    public function sendMailForgotPassword($email)
    {
        $user = User::where('email', $email)->first();
        if (!$user) {
            return [
                'success' => false,
                'message' => trans('response.email_not_found')
            ];
        } else {
            $lastTimeRequest = Carbon::createFromDate($user -> request_forgot_password_at)->diffInMinutes(Carbon::now());
            $validTime = config('mail.TIME_VALID_RESEND_MAIL');
            if ( $user ->request_forgot_password_at ==null || $lastTimeRequest - $validTime >= 0) {
                dd('oke');
            } else {
                return [
                    'success' => false,
                    'message' => trans('response.try_after', ['minutes' => $validTime - $lastTimeRequest])
                ];
            }
        }

    }
}
