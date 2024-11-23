<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function edit(){
        $user = User::find(Auth::id());
        return view('User.edit', compact('user'));
    }

    public function update(Request $request){
        $user = User::find($request->user()->id);
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name,'.$user->id,
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        $user->update();

        return redirect()->route('home');

    }

    public function destroy(Request $request){
        $user = User::find($request->user()->id);
        $user->delete();

        return redirect()->route('home');
    }
}
