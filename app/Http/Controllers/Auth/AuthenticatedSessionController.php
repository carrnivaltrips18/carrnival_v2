<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
{
    // Attempt to authenticate the user
    if ($request->authenticate()) {
        $request->session()->regenerate();

        // Redirect to the intended dashboard with a success message
        return redirect()->intended(route('dashboard', [], false));
    }

    // If authentication fails, redirect back with an error message
    return back()->withErrors([
        'email' => 'Either email or password is incorrect.',
    ])->withInput($request->only('email', 'remember'));
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
