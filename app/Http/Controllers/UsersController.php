<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UsersController extends Controller
{
    public function index(){
        return view('user.index')->with('users',User::all());
    }
    public function edit($id){
        return view('user.profile');
    }
}
