<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function __construct()
    {
    }

    public function main(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $accessToken= Auth::user()->createToken('Laravel Personal Access Client')->accessToken;
            return response()->json([
                'code'=>200,
                'data'=>['token'=>$accessToken,'role'=>Auth::user()->role]
            ],200);
        }else{
            return response()->json([
                'code'=>403,
                'message'=>trans('response.invalidEmailPassword')
            ],200);
        }
    }
}
