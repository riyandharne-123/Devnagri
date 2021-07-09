<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(),[ 
            'email' => 'required|email',
            'password' => 'required',
        ]);
   
        if($validation->fails()) 
        {
            return response()->json(['message' =>  $validation->messages()], 400);
        }

        else
        {
            $credentials = $request->only('email','password');

            if(Auth::attempt($credentials))
            {

                $token = Str::random(80);
                Auth::user()->api_token = $token;
                Auth::user()->save();
                return response()->json(['token' => $token], 200);

            }

            else {

                return response()->json(['status' => 'wrong credentials!'], 200);

            }
        }

    }
    
    public function verify(Request $request)
    {
      return $request->user()->only('api_token');
    }
}
