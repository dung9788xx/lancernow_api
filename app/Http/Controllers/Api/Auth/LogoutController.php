<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function main()
    {
        $user = Auth::user();
        $user->token()->revoke();
        return response()->json([
            'code' => 200,
            'data' =>'success'
        ],200);
    }
}
