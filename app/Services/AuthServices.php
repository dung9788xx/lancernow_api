<?php


namespace App\Services;


use App\Jobs\ResetPasswordSendMailJob;
use App\Jobs\SendMailRegister;
use App\Mail\ForgotPasswordMail;
use App\Model\PasswordReset;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use phpseclib\Crypt\Hash;

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
            $lastTimeRequest = Carbon::createFromDate($user->request_forgot_password_at)->diffInMinutes(Carbon::now());
            $validTime = config('mail.TIME_VALID_RESEND_MAIL');
            if ($user->request_forgot_password_at == null || $lastTimeRequest - $validTime >= 0) {
                try {
                    DB::beginTransaction();
                    DB::table('password_resets')->where('email', $email)->delete();
                    $token = Str::random(30);
                    DB::table('password_resets')->insert(['email' => $email, 'token' => $token, 'created_at' => Carbon::now()]);
                    ResetPasswordSendMailJob::dispatch($email, $token);
                    $user->request_forgot_password_at = Carbon::now()->toDateTimeString();
                    $user->save();
                    DB::commit();
                    return [
                        'success' => true,
                        'data' => trans('response.mail_sent')
                    ];
                } catch (\Exception $e) {
                    DB::rollBack();
                    Log::info($e->getMessage() . $e->getLine());
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

    /**
     *
     */
    public function resetPassword($tokenString, $password)
    {
        $token = PasswordReset::where('token', $tokenString)->first();
        $validTokenTime = config('mail.timeout_link_reset_password');
        if (!$token || Carbon::createFromDate($token->created_at->toDateTimeString())->diffInMinutes(Carbon::now()) > $validTokenTime) {
            return [
                'success' => false,
                'message' => trans('response.token_expired')
            ];
        }
        $user = User::where('email', $token->email)->first();
        if (!$user) {
            return [
                'success' => false,
                'message' => trans('response.something_wrong')
            ];
        }
        try {
            DB::beginTransaction();
            $user->password = \Illuminate\Support\Facades\Hash::make($password);
            $user->save();
            PasswordReset::where('token', $tokenString)->delete();
            DB::commit();
            return [
                'success' => true,
                'data' => trans('response.password_changed')
            ];
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::info($exception->getMessage());
            return [
                'success' => false,
                'message' => trans('response.something_wrong')
            ];
        }
    }

    public function signup($params)
    {
        $user = User::where('email', $params['email'])->first();
        if ($user) {
            return [
                'success' => false,
                'message' => trans('response.email_existed')
            ];
        }

        try {
            DB::beginTransaction();
            $verify_code = uniqid();
            $user = User::create([
                'email' => $params['email'],
                'password' => \Illuminate\Support\Facades\Hash::make($params['password']),
                'request_verify_at' => Carbon::now()->toDateTimeString(),
                'name' => $params['name'],
                'role' => $params['role'],
                'verify_code' => $verify_code
                ])->save();
            if ($user) {
                SendMailRegister::dispatch($params['email'], $verify_code);
                DB::commit();
                return [
                    'success' => true,
                    'data' => trans('response.register_success')
                ];

            }
            DB::rollBack();
        }catch (\Exception $exception){
            DB::rollBack();
            Log::info($exception->getMessage());
            return [
                'success' => false,
                'message' => trans('response.something_wrong')
            ];
        }
    }
}
