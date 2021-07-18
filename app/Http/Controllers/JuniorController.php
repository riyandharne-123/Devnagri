<?php

namespace App\Http\Controllers;

use App\Models\Junior;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class JuniorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'my_juniors' => Junior::where('user_id', Auth::user()->id)->with('user')->latest()->get(),
            'juniors' => User::latest()->get(),
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Junior::updateOrCreate([
            'user_id' => Auth::user()->id,
            'junior_id' => $request->junior_id
        ]);

        return response()->json([
            'my_juniors' => Junior::where('user_id', Auth::user()->id)->with('user')->latest()->get(),
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Junior  $junior
     * @return \Illuminate\Http\Response
     */
    public function show(Junior $junior)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Junior  $junior
     * @return \Illuminate\Http\Response
     */
    public function edit(Junior $junior)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Junior  $junior
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Junior $junior)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Junior  $junior
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Junior::find($id)->delete();

        return response()->json([
            'my_juniors' => Junior::where('user_id', Auth::user()->id)->with('user')->latest()->get(),
        ], 200);
    }
}
