<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ActiveController extends Controller
{
    public function AllUser(){
        $users= User::where('role','user')->latest()->get();
        return view('backend.user.user_all',compact('users'));

    }// end method
}
