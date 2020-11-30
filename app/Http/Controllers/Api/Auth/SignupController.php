<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SignupController extends Controller
{
    private $authServices;

    public function __construct(AuthServices $authServices)
    {
        $this->authServices = $authServices;
    }

    public function main(Request $request)
    {
        $params = $this->getParams($request);
        $validate = Validator::make($params, $this->rules());
        if ($validate->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validate->errors()->first()
            ], 200);
        }
        $result = $this->authServices->signup($params['email'], $params['password']);
        if ($result['success'] == false) {
            return response()->json([
                'code' => 400,
                'message' => $result['message']
            ], 200);
        }
        return response()->json([
            'code' => 200,
            'data' => $result['data']
        ], 200);
    }

    public function getParams($request)
    {
        return $request->only(['email', 'password']);
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ];
    }
}
