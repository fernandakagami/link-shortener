<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [            
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6'            
        ]);

        if ($validator->fails())
        {
            return response($validator->errors(), 400);
        }

        $request['password'] = Hash::make($request['password']);        
        
        $user = User::create($request->toArray());        
        $token = $user->createToken('api_token')->plainTextToken;        

        $response = ['api_token' => $token];   
        return response($response, 200);
    }
}