<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $headers = $request->headers->all();
        $token = $headers['x-token'];
        if (!$token) {
            return response()->json([
                'code' => 20001,
                'status' => 'error',
                'message' => 'Token is required'
            ]);
        }
        $user = User::where('token', $token)->first();
        if (!$user) {
            return response()->json(
                [
                    'code' => 20002,
                    'status' => 'error',
                    'message' => 'Invalid token'
                ]
            );
        }
        Auth::login($user);
        return $next($request);
    }
}
