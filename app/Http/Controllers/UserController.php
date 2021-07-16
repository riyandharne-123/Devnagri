<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'users' => User::with(['role','permissions'])->latest()->get(),
            'roles' => Role::all(),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[ 
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role_id' => 'required',
            'password' => 'required',
        ]);
       
        if($validation->fails()) 
        {
          return response()->json(['message' =>  $validation->messages()], 400);
        }
  
        else
        {
  
          $token = Str::random(80);

          User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role_id' => $request['role_id'],
            'api_token' => $token,
          ]);
  
          $user = User::where('email', $request->email)->first();

          foreach($request->permissions as $item) {
            Permission::create([
                'user_id' => $user->id,
                'name' => $item
            ]);
          }

          return response()->json([
            'users' => User::with(['role','permissions'])->latest()->get(),
          ], 200);
  
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'user' => User::where('id',$id)->with(['role','permissions'])->first(),
            'permissions' => Permission::where('user_id', $id)->get(),
            'roles' => Role::all(),
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        User::find($id)->update([
            'role_id' => $request->role_id
        ]);

        return response()->json([
            'user' => User::where('id',$id)->with(['role','permissions'])->first(),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();

        return response()->json([
            'users' => User::with(['role','permissions'])->latest()->get(),
        ], 200);
    }

}
