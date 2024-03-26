<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(){
        return view('home');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            toastr()->addSuccess('Loggin successfully');
            return redirect()->route('home');
        }
        
        toastr()->addError('Oppes! You have entered invalid credentials.');
        return redirect()->route('home');
    }

    public function logout(Request $request){
        Auth::logout();
        toastr()->addSuccess('Log out');
        return redirect()->route('home')->with('message','You have successfully logged out');
    }
}
