<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function edit()
    {

        return view('users.edit', [
            'user' => Auth::user()
        ]);
    }

    public function update()
    {
        $validated = request()->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:80',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::id())],
            'password' => '',
            'password_confirmation' => ''
        ]);

        if (!is_null($validated['password'])) {
            unset($validated['password']);
            unset($validated['password_confirmation']);

            $validated = array_merge($validated, request()->validate([
                'password' => 'required|string|min:8|confirmed'
            ]));
        } else {
            unset($validated['password']);
            unset($validated['password_confirmation']);
        }

        Auth::user()->update($validated);

        return redirect()->route('home')->with('flash_message', 'User profile updated successfully');
    }
}
