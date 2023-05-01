<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest', ['except'=>'destroy']);
    }


    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        // Attemp to authenticate the user
        if(! auth()->attempt(request(['email', 'password'])))
        {
            // If not, redirect back
            return back()->withErrors([
                'message' => 'Please check your credentials and try again'
            ]);
        }

        // If so, sign them in

        // Redirect to the home page

        return redirect()->route('home');
    }

    public function destroy()
    {
        auth()->logout();

        return redirect()->route('home');
    }
}
