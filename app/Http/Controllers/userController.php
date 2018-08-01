<?php

namespace App\Http\Controllers;

use App\Http\Requests\addUserRequest;
use App\Http\Requests\updateUserRequest;
use App\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $users = User::where('id','>',1)->get();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }


    public function store(addUserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('listUsers')->with(['message' => 'User successfully created!']);
    }

    public function edit($user)
    {
        $user = User::find($user);
        if ($user != \Auth::user() && \Auth::user()->id != 1){
            return redirect()->route('listUsers')->with(['message_err' => 'Not Allowed!']);
        }

        return view('users.update', compact('user'));
    }

    public function update($user, updateUserRequest $request)
    {
        $user = User::find($user);
        if ($request->password == ''){
            $password = $user->password;
        }else{
            $password = bcrypt($request->password);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>$password
        ]);

        return redirect()->route('listUsers')->with(['message' => 'User Successfully Updated!']);
    }

    public function destroy($user)
    {
        User::find($user)->delete();

        return redirect()->route('listUsers')->with(['message' => 'User Successfully deleted!']);
    }
}
