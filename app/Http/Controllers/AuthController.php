<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            "email" => "required | email",
            "password" => "required | min:8",
        ]);

        $credentials = $request->only("email", "password");
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route("home"));
        }

        return redirect("login")
            ->with("error", "Invalid credentials!");
    }

    public function register()
    {
        return view("auth.register");
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            "name" => "required | string | max:255",
            "email" => "required | email | unique:users",
            "password" => "required | min:8",
        ]);

        $user = new User();
        $user->name = $request->input("name");
        $user->email = $request->input("email");
        $user->password = Hash::make($request->input("password"));

        if ($user->save()) {
            return redirect("login")
                ->with("success", "User registered successfully");
        }

        return redirect("register")
            ->with("error", "Error while registering user");
    }

    public function logout() {
        Auth::logout();
        return redirect("/login")->with("success", "User logout successful");
    }
}
