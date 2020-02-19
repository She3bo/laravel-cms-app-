<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UsersController extends Controller
{
    public function index(){
        return view('user.index')->with('users',User::all());
    }

    public function create(){
        return view('user.create');
    }
    public function store($id){
        return 'User Created';
    }
    public function edit(User $user){
        return view('user.edit')->withUser($user);
    }
    public function update($id){
        return 'User Updated';
    }
    public function destroy(User $user){
        $user->delete();
        return redirect(route('users.index'));
    }

    public function makeAdmin(User $user)
    {
        //dd($user);
        $user->role = "admin";
        $user->save();
        // $user = User::find($id);
        // $user->update(['role' => 'admin']);
        return redirect(route('users.index'));
    }
    public function makeWriter(User $user)
    {
        //dd($user);
        $user->role = "writer";
        $user->save();
        // $user = User::find($id);
        // $user->update(['role' => 'admin']);
        return redirect(route('users.index'));
    }
    public function profile(User $user){
        return view('user.profile')->withUser($user);
    }
}
