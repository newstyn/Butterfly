<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;

class ZalController extends Controller
{
    
    public function index()
    {
        //return view('zal.index');
    }

    
    public function create()
    {
        //return view('zal.create');
    }


    public function store(Request $request)
    {
        //User::create($request->all());
        // $userName = $request->name;
        // return view('zal.welcome' , compact('userName'));

        // $user = new User;
        // $user->id = $request->id;
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = $request->password;
        // $user->remember_token = $request->remember_token;
        // $user->created_at = $request->created_at;
        // $user->updated_at = $request->updated_at;
        // $user->save();
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
