<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Validator;
use Tymon\JWTAuth\Facades\JWTAuth;


use App\Traits\ApiResponseTrait;

class AuthController extends Controller
{
    use ApiResponseTrait ;
    
        public function register(Request $request){
            try{
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|between:2,100',
                'email' => 'required|string|email|max:100|unique:users',
                'password' => 'required|string|min:6',
            ]);
        
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
        
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
    
            $token = auth('api')->attempt($request->only('email', 'password'));
            $user->token = $token ;
    
            if (!$token) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        
            return $this->ApiResponse($user , 'Chef successfully registered' , 201);
    
        } catch(\Exception $e){
            return response()->json([
            'error' => 'Something went wrong',
            'message' => $e->getMessage()], 500);
        }
    }

    public function logout(Request $request){

        $token = $request ->header('auth-token') ;

        JWTAuth::setToken($token)->invalidate();

        return $this->ApiResponse( null , 'Logged out successfully' , 201);
    
    }
   
    
}
