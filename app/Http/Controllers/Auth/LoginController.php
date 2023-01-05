<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function create()
    {
        return Inertia::render('Auth/Login');
    }

    /**
     * Este metodo se ha copiado desde la documentacion de laravel
     * https://laravel.com/docs/9.x/authentication#authenticating-users
     * y el metodo era LoginController.Authenticate()
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/settings');   // el redirect sera a la pagina 'settings', dejar vacio para que vaya al index
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Lo llamamos destroy en vez de logout para diferenciar que esto seha hecho manualmente
     * sin utilizar las plantillas de laravel como jetstream o breeze
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
