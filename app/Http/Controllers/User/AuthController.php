<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Validator;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
    
        // إنشاء المستخدم
        $User = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);



        $token = auth('api')->attempt($request->only('email', 'password'));

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        return response()->json([
            'message' => 'Admin successfully registered',
            'token' => $token,
        ], 201);

    }
}
