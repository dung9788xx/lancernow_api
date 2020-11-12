<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    private $authService;
    public function __construct( AuthServices $authService)
    {
        $this->authService = $authService;
    }

    /**
     *aaa
     */
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
        $result = $this->authService->sendMailForgotPassword($params['email']);
        if($result['success'] == false) {
            return response()->json([
                'code' => 400,
                'message' => $result['message']
            ],200);
        }
        return response()->json([
            'code' => 200,
            'message' => $result['data']
        ],200);
    }

    public function getParams($request)
    {
        return  $request->only(['email']);
    }

    public function rules()
    {
        return [
            'email' => 'required|email'
        ];
    }
}
