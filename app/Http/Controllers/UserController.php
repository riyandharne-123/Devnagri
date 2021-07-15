<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
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
        $data = array();

        $permissions = Permission::where('user_id',Auth::user()->id)->get();

        foreach($permissions as $item)
        {
            array_push($data,$item->name);
        }

        return response()->json([
            'users' => User::with(['role','permissions'])->latest()->get(),
            'roles' => Role::all(),
            'permissions' => $data
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
        //
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

    public function update_permissions(Request $request)
    {
        $data = Permission::where('name',$request->name)->where('user_id',Auth::user()->id)->first();

        if($data == null) {
            Permission::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name
            ]);
        }

        else {
            $data->delete();
        }

        return response()->json([
            'permissions' => Permission::where('user_id',Auth::user()->id)->get(),
        ], 200);
    }
}
