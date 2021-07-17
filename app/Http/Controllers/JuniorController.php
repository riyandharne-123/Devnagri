<?php

namespace App\Http\Controllers;

use App\Models\Junior;
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
            'my_juniors' => Junior::where('user_id', Auth::user()->id)->latest()->get(),
            'juniors' => Junior::latest()->get(),
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
        //
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
    public function destroy(Junior $junior)
    {
        //
    }
}
