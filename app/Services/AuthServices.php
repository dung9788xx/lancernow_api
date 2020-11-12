<?php


namespace App\Services;


use App\Mail\ForgotPasswordMail;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
                    DB::beginTransaction();
                    DB::table('password_resets')->where('email', $email)->delete();
                    $token = Str::random(30);
                    DB::table('password_resets')->insert(['email'=>$email,'token'=>$token, 'created_at' => Carbon::now()]);
                    Mail::to("dungtv@hblab.vn")->send(new ForgotPasswordMail(config('app.client_url').'/reset_password?token='.$token));
                    $user->request_forgot_password_at = Carbon::now()->toDateTimeString();
                    $user->save();
                    DB::commit();
                    return [
                        'success' => true,
                        'data' => trans('response.mail_sent')
                    ];
                } catch (\Exception $e) {
                    DB::rollBack();
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
