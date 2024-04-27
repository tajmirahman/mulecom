<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
   public function RedirectToGoogle (){
    return Socialite::driver('google')->redirect();
   }//end method


   public function CallbackToGoogle (){
    $user = Socialite::driver('google')->user();
    $this->registerOrLoginUser($user);
    return redirect()->route('dashboard');
   }//end method

   protected function registerOrLoginUser($data){

    $user= User::where('email','=',$data->email)->first();

    if(!$user){
        $user= new User();
        $user->name = $data->name;
        $user->email = $data->email;
        $user->provider_id = $data->id;
        $user->photo = $data->avatar;
        $user->save();

        Auth::login($user);

    }

   }// end method


}
