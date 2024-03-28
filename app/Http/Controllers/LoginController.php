<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(request $request){

        $request->validate([
            'email' => ['required|email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($request->only('email', 'password'))){
            return response()->json(Auth::user(),200);
        }
        throw ValidationException::withMessages([
            'email' => 'Las credenciales no coinciden.',
        ]);
    }
    public function store(){

        if(auth()->attempt(request(['email', 'password']))==false){
            return back()->withErrors([
                "message" => "Identificación incorrecta"
            ]);

        }
        return redirect()->to("/");
    }
    public function destroy(){

        auth()->logout();
        return redirect()->to("/");
    }
}
