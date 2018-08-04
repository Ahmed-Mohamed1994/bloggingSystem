<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\UserLoginRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class mainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['dashboard']);
    }

    public function index(){
        $posts = Post::where('status',1)->latest()->get();
        $categories = Category::all();
        return view('welcome', compact('posts','categories'));
    }

    public function dashboard(){
        return view('dashboard');
    }

    public function loginPage(){
        if (Auth::check()){
            return redirect()->route('dashboard');
        }else {
            return view('login');
        }
    }

    public function login(UserLoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('dashboard');
        }

        return redirect()->back()->with(['message_err' => 'invalid email or password!']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
