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
                'phone' => 'required|string|min:10|max:15',
                'password' => 'required|string|min:6',
            ]);
        
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
        
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'password' => bcrypt($request->password),
            ]);
    
            $token = auth()->guard('user')->attempt($request->only('email', 'password'));
            $user->token = $token ;
    
            if (!$token) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        
            return $this->ApiResponse($user , 'User successfully registered' , 201);
    
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

    public function login(Request $request){

        try{
            $rules = [
                "login" => "required",
                "password" => "required" ,
                
    
            ];
    
            $validator = Validator::make($request->all(), $rules);


            $login = $request->login;
            $password = $request->password;


            if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
                
                $credentials = ['email' => $login, 'password' => $password];
            } else {
               
                $credentials = ['phone' => $login, 'password' => $password];
            }
    
    
            $token = Auth::guard($request->guard_name)->attempt($credentials);
    
            if (!$token) {
                return response()->json(['error' => 'Unauthorized. Invalid credentials'], 401);
            }

            $user = Auth::guard($request->guard_name)->user();

            $user->token = $token;
    
            return $this->ApiResponse( $user , 'LOGIN successfully' , 201);

        }catch(\Exception $e){
            return response()->json([
            'error' => 'Something went wrong',
            'message' => $e->getMessage()], 500);
        }

        
    }
   
    
}
