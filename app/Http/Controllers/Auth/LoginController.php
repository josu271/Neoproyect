<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
         return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'dni'      => ['required', 'numeric'],
            'password' => ['required'],
        ]);

        if (Auth::guard('web')->attempt([
            'DNI'      => $credentials['dni'],
            'password' => $credentials['password'],
        ])) {
            $request->session()->regenerate();
            return redirect()->intended('/menu');
        }

        return back()
            ->withErrors(['dni' => 'Las credenciales no coinciden.'])
            ->onlyInput('dni');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
