<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class UserAuthController extends BaseController
{
    public function __construct()
    {
    }

    public function login(Request $request): \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
    {
        $requestData = $request->all();

        $validator = Validator::make($requestData, [
            'email'=>'required|string|email',
            'password'=>'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => error_processor($validator)], 403);
        }

        try {
            $user = User::where('email',$requestData['email'])->first();
            if(!$user || !Hash::check($requestData['password'],$user->password)){
                return $this->errorResponse('Invalid credentials. Please enter correct data.', [],401);
            }
            $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;
            $data['token'] = $token;
            $data['name'] = $user->name;
            $data['email'] = $user->email;
            return $this->successResponse($data, 'Login Successfully.');
        }catch (\Exception $e){
            Log::critical($e->getMessage());
            return $this->errorResponse($e->getMessage(), [],401);
        }
    }

    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $requestData = $request->all();

        $validator = Validator::make($requestData, [
            'name'=>'required|string',
            'email'=>'required|string|email|unique:users',
            'password'=>'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => error_processor($validator)], 403);
        }

        try {
            $create = new User();
            $create->name = $request->name;
            $create->email = $request->email;
            $create->password = Hash::make($request->password);
            $create->save();
            if($create){
                return response()->json(['status' => 'success', 'data' => $create, 'message' => 'User Created Successfully.'], 200);
            }
            return response()->json(['status' => 'error', 'data' => [], 'message' => 'Oops! Please try again.'], 500);
        } catch (\Exception $exception){
            Log::critical($exception->getMessage());
            return response()->json(['status' => 'error', 'data' => [],'message'=>$exception->getMessage()], 200);
        }
    }

    public function logout (Request $request): \Illuminate\Http\JsonResponse
    {
        if (Auth::check()) {
            auth()->user()->tokens()->delete();
            return $this->successResponse([], 'Logout Successfully.');
        }
        return $this->errorResponse('Oops! Please try again.', [],401);
    }
}
