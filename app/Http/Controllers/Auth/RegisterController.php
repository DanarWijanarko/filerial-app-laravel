<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create() : View
    {
        return view('pages.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request) : RedirectResponse
    {
        $request->validated();

        $user = User::create([
            "role" => 'user',
            'username' => $request->username,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return redirect()->route("auth.login")->with('status', (object) [
            'type' => 'success',
            'message' => 'Registration Successful.',
        ]);
    }
}
