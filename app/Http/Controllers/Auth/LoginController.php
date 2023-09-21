<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        
        // Verifica si el usuario tiene idRol igual a 1
        if ($user->idRol == 1 ||$user->idRol == 3 ) {
            return redirect()->intended($this->redirectTo);
        } else {
            Auth::logout(); // Cierra la sesión si el usuario no tiene el idRol adecuado
            return redirect()->back()->withErrors(['login' => 'No tienes permiso para acceder.'])->withInput($request->only('email'));
        }
    }

    return redirect()->back()->withErrors(['login' => 'Correo o contraseña incorrectos.'])->withInput($request->only('email'));
}
}
