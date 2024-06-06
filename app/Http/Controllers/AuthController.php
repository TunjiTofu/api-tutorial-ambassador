<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Auth;
use Cookie;
use Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create(
            $request->only('first_name', 'last_name', 'email')
                + [
                    'password' => Hash::make($request->input('password')),
                    'is_admin' => 1
                ]
        );
        return response()->json($user, Response::HTTP_CREATED);
    }

    function login(Request $request): Response
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response([
                'error' => 'Invalid credentials',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();

        //generate JWT Access token
        $jwt = $user->createToken('token')->plainTextToken;

        //send token using cookie
        $cookie = cookie('jwt', $jwt, 60 * 24); // 1day - time is in minute

        //send response with cookie
        return response([
            'message' => 'success',
            'data' => $user,
        ])->withCookie($cookie);

        ########Don't forget to go to config/cors and change: 'supports_credentials' => true,
    }

    ###########Authenticated User
    function authUser (Request $request) : Response{
        //return $request->user();
        $user = auth()->user();
        return response()->json($user);
    }

    function logout() : Response {
        $cookie = Cookie::forget('jwt');
        return response([
            'message' => 'logout successful',
        ])->withCookie($cookie);
    }
    
}
