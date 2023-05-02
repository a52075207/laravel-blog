<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegistrationForm;
// use Illuminate\Support\Facades\Hash;
// use App\Models\User;
// use Mail;
// use App\Mail\Welcome;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('registration.create');
    }

    public function store(RegistrationForm $form)
    {
        // validate the form

        // $this->validate(request(), [
        //     'name'     => 'required',
        //     'email'    => 'required|email',
        //     'password' => 'required|confirmed'
        // ]);

        // Create and save the user

        // $user = User::create([
        //     'name'     => request('name'),
        //     'email'    => request('email'),
        //     'password' => Hash::make(request('password'))
        // ]);

        // Sign them in

        // auth()->login($user);

        // When user login, send them an Email

        // \Mail::to($user)->send(new Welcome($user));

        // Redirect to the home page

        $form->persist();

        return redirect()->route('home');
    }
}
