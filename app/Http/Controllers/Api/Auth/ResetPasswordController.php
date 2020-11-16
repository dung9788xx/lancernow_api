<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    /**
     * @param Request $request
     */
    private $authService;

    public function __construct(AuthServices $authService)
    {
        $this->authService = $authService;
    }

    public function main(Request $request)
    {
        $params = $this->getParams($request);
        $validate = Validator::make($params, $this->rules());
        if ($validate->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validate->errors()->first()
            ]);
        }
        $result = $this->authService->resetPassword($params['token'], $params['password']);
        if (!$result['success']) {
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
        return $request->only(['token', 'password']);
    }

    public function rules()
    {
        return [
            'token' => 'required|string',
            'password' => 'required|string|min:6'
        ];
    }
}
