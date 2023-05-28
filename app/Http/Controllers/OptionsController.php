<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;

use App\Models\Poll;
use Auth;
class OptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index( Request $request)
    {
        //
        $uid = Auth::id();
        $poll = Poll::find($request->input('id'))->get();

        // return view('my_polls')->with('polls',$poll);
        
        // return view("optionform")->with('pollid', session('pollid'))->with('num_options',session('num_options'));
        return view("optionform")->with('poll', $poll);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Option $option)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Option $option)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Option $option)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Option $option)
    {
        //
    }
}
