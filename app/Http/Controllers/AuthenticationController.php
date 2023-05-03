<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use IlluminateSupportFacadesURL;
class AuthenticationController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('app/ecommerce/shop');
        } else {
            return view('content/authentication/auth-login-basic');
        }
    }
    public function postlogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()
                ->intended('app/ecommerce/shop')
                ->with('message', 'Signed in!');
        }

        return redirect('/login')->with(
            'message',
            'Login details are not valid!'
        );
    }
    public function register()
    {
        if (Auth::check()) {
            return redirect('login');
        } else {
            return view('content/authentication/auth-register-basic');
        }
    }
    public function postsignup(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'avatar' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $file = $request->file('avatar');
        $name = $request->file('avatar')->getClientOriginalName();
        $file->move(public_path('/images/'), $name);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'avatar' => $name,
        ];
        $check = $this->create($data);

        return redirect('login');
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'avatar' => $data['avatar'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }
}
