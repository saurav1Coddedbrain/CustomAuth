<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\models\User;
use Session;


class AuthManager extends Controller
{
    // home
    function home (){
        return view('home');
    }

    function login(){
       return view('login');
    }


    function register(){
        return view('register');
    }


    function loginpost(Request $request){
       $request->validate([
        'email' => 'required',
        'password' => 'required',
     ]);

      $credentials = $request->only('email', 'password');
      if(Auth::attempt($credentials)){
        return redirect('/home');
        // return redirect(route(name: 'home'))->with("Status", "Successfully Done");
     }else{
        return redirect(route(name: 'login'))->with("error", "login details are not valid");
     }

    }

    function registerpost(Request $request){
        $request->validate([
             'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
         ]);

         $data['name'] = $request-> name;
         $data['email'] = $request-> email;
         $data['password'] = Hash::make($request-> password);
         $user = User::create($data);
         if(!$user){
            return redirect(route(name: 'register'))->with("error", "Registration failed, try again.");

         }else{
            return redirect(route(name: 'login'))->with("success", "Registration success, Login to access the app");
         }

    }

    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route(name: 'login'));
    }
}
