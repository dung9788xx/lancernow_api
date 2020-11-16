<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SignupController extends Controller
{
    public function main(Request $request)
    {
        $params = $this->getParams($request);
        $validate = Validator::make($params, $this->rules());
        if( $validate ->fails()){
            return response()->json([
                'code' => 400,
                'message' => $validate->errors()->first()
            ],200);
        }

    }

    public function getParams($request)
    {
        return  $request->only(['email']);
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ];
    }
}
