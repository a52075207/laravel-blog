<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Mail;
use App\Mail\Welcome;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistrationForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // if user's input didn't match the rules
        // will redirect to the back page
        // until the input fulfill the rules
        return [
            'name'     => 'required',
            'email'    => 'required|email',
            'password' => 'required|confirmed'
        ];
    }

    public function persist()
    {
        $user = User::create([
            'name'     => request('name'),
            'email'    => request('email'),
            'password' => Hash::make(request('password'))
        ]);

        // Sign them in

        auth()->login($user);

        // When user login, send them an Email

        \Mail::to($user)->send(new Welcome($user));
    }
}
