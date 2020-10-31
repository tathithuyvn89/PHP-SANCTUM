<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request) {
        try {
            $request->validate([
                 'email'=>'email|required',
                 'password'=>'required'
            ]);

            $cridentials = request(['email','password']);
            if (!Auth::attempt($cridentials)) {
                return response()->json([
                    'status_code'=>'403',
                    'message'=>'Unauthorized',
                ],403);
            }

            $user = User::where('email', $request->email)->first();

            if (!Hash::check($request->password, $user->password,[])) {
                throw new Exception('Error in login');
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'status_code'=> '200',
                'access_token'=>$tokenResult,
                'token_type'=>'Bearer',
                'data'=>$user
            ],200);

        } catch(Exception $e) {
           return \response()->json([
                'status_code'=>'500',
            'message'=>'Error in Login',
            'error'=>$e

           ],500);
        }
    }
}
