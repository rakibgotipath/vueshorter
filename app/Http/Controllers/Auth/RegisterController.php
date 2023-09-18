<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return Inertia::render('Auth/Register', [
            'pageTitle' => 'Register'
        ]);
    }

    public function register(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6']
        ]);

        $user = User::create($credentials);
        auth()->login($user);
        return redirect()->route('home');
    }
}
