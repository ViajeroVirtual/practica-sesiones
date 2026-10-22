<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Show the login form page.
     */
    public function showLoginForm(): View|RedirectResponse
    {
        if (session()->has('token')) {
            return redirect()->route('home');
        }

        return view('auth.login');
    }

    /**
     * Handle an incoming login request.
     */
    public function login(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            return back()
                ->withErrors([
                    'email' => 'Las credenciales proporcionadas no son correctas.',
                ])
                ->onlyInput('email');
        }

        $token = Str::random(60);

        // Guardar token y nombre de usuario en datos permanentes de la sesión
        session([
            'token' => $token,
            'name' => $user->name,
        ]);

        return redirect()->route('home')->with('success', '¡Bienvenido/a, '.$user->name.'! Has iniciado sesión correctamente.');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request): RedirectResponse
    {
        // Borrar la sesión y regenerar el token CSRF según instrucciones
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Has cerrado la sesión correctamente.');
    }

    /**
     * Show the register form page.
     */
    public function showRegisterForm(): View|RedirectResponse
    {
        if (session()->has('token')) {
            return redirect()->route('home');
        }

        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('login')->with('success', 'Cuenta creada correctamente para '.$user->name.'. Ahora puedes iniciar sesión.');
    }
}
