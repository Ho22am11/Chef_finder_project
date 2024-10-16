<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Validator;

use App\Traits\ApiResponseTrait;

class AuthController extends Controller
{
    use ApiResponseTrait ;

    public function register(Request $request){

        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|between:2,100',
                'email' => 'required|string|email|max:100|unique:admins',
                'password' => 'required|string|min:6',
            ]);
        
            if ($validator->fails()) { // if exist error in validation return it
                return response()->json($validator->errors(), 400);
            }
        
            $admin = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            
    
            $token = auth()->guard('admin')->attempt($request->only('email', 'password'));
            $admin->token = $token ;
    
            if (!$token) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        
            return $this->ApiResponse($admin , 'Admin successfully registered' , 201);

        }catch(\Exception $e){
            return response()->json([
            'error' => 'Something went wrong',
            'message' => $e->getMessage()], 500);
        }

        
        

    }

   
}
