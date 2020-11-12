<?php


namespace App\Services;


use App\Mail\ForgotPasswordMail;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
                try {
                    Mail::to("dungtv@hblab.vn")->send(new ForgotPasswordMail('http:///aaaa.com'));
                    return [
                        'success' => true,
                        'data' => trans('response.mail_sent')
                    ];
                } catch (\Exception $e) {
                    Log::info($e->getMessage());
                    return [
                        'success' => false,
                        'message' => trans('response.something_wrong')
                    ];
                }
            } else {
                return [
                    'success' => false,
                    'message' => trans('response.try_after', ['minutes' => $validTime - $lastTimeRequest])
                ];
            }
        }

    }
}
