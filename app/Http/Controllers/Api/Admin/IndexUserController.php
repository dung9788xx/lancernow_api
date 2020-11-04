<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IndexUserController extends Controller
{
    public function main(Request $request)
    {
        Log::info('aaaa');
           return response()->json([
               'code' => 200,
               'data' => 'aaa'
           ],200);
    }
}
