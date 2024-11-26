<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('servicios')->with('success', '¡Bienvenido!');
        }

        return back()->withErrors(['email' => 'Credenciales incorrectas.']);
    }

    public function showRegisterForm()
    {
        return view('registro');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:admin_hospital,supervisor_inventario,personal_lavanderia,personal_clinico',
        ]);

        Usuario::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
        ]);

        
        return redirect()->route('login')->with('success', '¡Usuario registrado exitosamente!');
    }
}
