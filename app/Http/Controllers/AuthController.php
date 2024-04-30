<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function post(Request $request)
    {
        $cridentials = $request->only(['email', 'password']);
        if (Auth::attempt($cridentials)) {
            return redirect('/dashboard');
        }
        return redirect()->back();
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerpost(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect('/login');
    }
}
