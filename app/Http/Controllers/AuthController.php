<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use App\Models\Instrument;
use App\Models\Log;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function loginForm(){

        if(Auth::check()){
            return redirect('/');
        }
        return view('auth.login');

    }

    public function registerForm(){
        return view('auth.register');

        if(Auth::check()){
            return redirect('/dashboard');
        }
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user || $user->email_verified_at == null){
            return redirect('/login')->with('error', 'Sorry your account is not yet verified or does not exist.');
        }

        $login = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        while ($login) {
            if (auth()->user()->is_admin) {
                return redirect()->intended('/dashboard');
            } else {
                return redirect()->intended('/');
            }
        }

        // if(!$login){
        //     return back()->with('error', 'Invalid credentials');
        // }
        return back()->withInput()->with('error', 'Invalid Credentials');
    }

    public function register(Request $request){

        $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|confirmed|string|min:6'
        ]);

        $token = Str::random(24);

        $user = User::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'password'          => bcrypt($request->password),
            'remember_token'    => $token
        ]);
        // dd($user->remember_token);

        Mail::send('auth.verification-mail', ['user'=>$user], function($mail) use($user){
            $mail->to($user->email);
            $mail->subject('Account Verification');
        });

        return redirect('/login')->with('message', ' Your account has been created. Please check your email for the verification link.');
    }

    public function verification(User $user, $token){

        if($user->remember_token !== $token){
            return redirect('/')->with('error', 'Invalid Token');
        }

        $user->email_verified_at = now();
        $user->save();

        return redirect('/login')->with('message', 'Your account has been verified.');

    }

    public function logout(Request $request) {
        // auth()->logout();
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'Log out successfully');
    }

    public function dashboard(){
        $user = auth()->user();
        $users = User::all();
        $categories = Category::all();
        $instruments = Instrument::all();
        $orders = Order::all();
        $logs = Log::all();
        return view('admin.landing', compact('user', 'users', 'categories', 'instruments', 'orders', 'logs'));
    }

    public function sendMail(){
        dd('Email has been delivered.');
    }

}
