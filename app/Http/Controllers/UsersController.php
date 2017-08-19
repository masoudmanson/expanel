<?php

namespace App\Http\Controllers;

use App\Authorized;
use App\Client;
use App\Identifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.users');
    }

    public function indexFanap(Request $request)
    {
        $identifier_id = Identifier::where('name','fanapium')->first()->id;
        $users = Client::where('identifier_id',$identifier_id)->where('is_authorized' , true)->get();
        $users_count = Client::where('identifier_id',$identifier_id)->count();
        dd($users);
        if ($request->ajax())
            return response()->json(view('partials.singleTrans', compact('users','users_count'))->render());

        return view('pages.fanapUsers',compact('users'));

        return view('pages.fanapUsers');
    }

    public function indexExhouse(Request $request)
    {
        $identifier_id = Auth::user()->currencyExchange->identifier->id;

        $users = Authorized::where('identifier_id',$identifier_id)->get();
        $users_count = Authorized::where('identifier_id',$identifier_id)->count();
        dd($users);
        if ($request->ajax())
            return response()->json(view('partials.singleTrans', compact('users','users_count'))->render());

        return view('pages.exhouseUsers',compact('users'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
