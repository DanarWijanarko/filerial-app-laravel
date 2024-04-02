<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    /**
     * Display the login view.
     */
    public function create() : View
    {
        return view("pages.auth.login");
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request) : RedirectResponse
    {
        $validated = $request->validated();

        $remember = Arr::exists($validated, 'remember') ? true : false;

        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']], $remember)) {
            $request->session()->regenerate();

            return redirect()->route("main.home");
        }

        return back()->with('message', 'The provided credentials do not match our records!');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request) : RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
