<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function login()
    {
        return response()->json([
            'code'=>20000,
            'status' => 'success',
            'message' => 'Login Successfully',
            'data' => [
                'token' => '123123'
            ]
        ]);
    }

    public function info()
    {
        return response()->json([
            'code'=>20000,
            'status' => 'success',
            'message' => 'Get User Info Successfully',
            'data' => [
                'name'=>'admin',
                'avatar'=>'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif'
            ]
        ]);
    }

    public function logout()
    {
        return response()->json([
            'code'=>20000,
            'status' => 'success',
            'message' => 'Logout Successfully'
        ]);
    }
}
