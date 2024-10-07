<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function login(Request $request)
    {
        $params = request()->input();
        if ($params['username'] && $params['password']) {
            if (Auth::attempt(['account' => $params['username'], 'password' => $params['password']])) {
                $user = Auth::user();
                $token = Hash::make($user->id . time(). rand(100000,999999));
                $user->token = $token;
                $user->save();
                return response()->json(['code'=>20000, 'status' => 'success', 'message' => '登录成功', 'data' => ['token' => $token]]);
            } else {
                //获取最后一条sql
                $sql = DB::getQueryLog();
                return response()->json([
                    'code'=>20001,
                    'status' => 'error',
                    'message' => '账号或者密码错误',
                ]);
            }
        }
    }

    /**
     * @return JsonResponse
     */
    public function info(): JsonResponse
    {
        $user = Auth::user();
        return response()->json([
            'code'=>20000,
            'status' => 'success',
            'message' => 'Get User Info Successfully',
            'data' => [
                'name'=>$user->name,
                'roles' => [$user->roles],
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
