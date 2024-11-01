<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Chef;
use App\Models\AttechmentChef;
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
                'email' => 'required|string|email|max:100|unique:chefs',
                'password' => 'required|string|min:6',
            ]);
        
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $request->except('name' , 'email' , 'password') ;
        
            $chef = Chef::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'whats' => $request->whats,
                'gender' => $request->gender,
                'password' => bcrypt($request->password),
            ]);
            $files = ['cv', 'passport']; 

foreach ($files as $file) {
    if ($request->hasFile($file)) {
        $uploadedFile = $request->file($file);

        $fileName = time() . "_$file." . $uploadedFile->getClientOriginalExtension();

        $path = "chefs/$file";
        $uploadedFile->storeAs($path, $fileName, 'attechment');

        AttechmentChef::create([
            'name' => "$path/$fileName",
            'chef_id' => $chef->id,
        ]);
    }
}
    
    
    
            $token = auth('chef')->attempt($request->only('email', 'password'));
            $chef->token = $token ;
    
            if (!$token) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        
            return $this->ApiResponse($chef , 'Chef successfully registered' , 201);
        }catch(\Exception $e){
            return response()->json([
                'error' => 'Something went wrong',
                'message' => $e->getMessage()], 500);
        }
      

    }
}
