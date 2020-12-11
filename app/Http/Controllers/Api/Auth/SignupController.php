<?php

namespace App\Http\Controllers\Api\Auth;

use App\Enum\UserRole;
use App\Http\Controllers\Controller;
use App\Services\AuthServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        $result = $this->authServices->signup($params);
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
        return $request->only(['email', 'name', 'role', 'password']);
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'name' => 'required|string',
            'password' => 'required|string|min:6',
            'role' => Rule::in([UserRole::HIRER, UserRole::LANCER])
        ];
    }
}
