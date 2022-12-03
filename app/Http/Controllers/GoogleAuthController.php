<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;


class GoogleAuthController extends Controller
{
    //

    public function redirect(){
        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleCallback()
    {
        try {
            //create a user using socialite driver google
            $user = Socialite::driver('google')->stateless()->user();
            // if the user exits, use that user and login
            $finduser = User::where('email', $user->getEmail())->first();

            if(!$finduser){
                //user is not yet created, so create first
                $saveUser = User::updateOrCreate([
                    'google_id' => $user->getId(),
                ],
                [
                        'name' => $user->getName(),
                        'email' => $user->getEmail(),
                        'password' => encrypt('')
                ]
                );
                /*Auth::login($finduser);
                return redirect('/dashboard');*/
            }else{
                $saveUser = User::where('email', $user->getEmail())->update([
                    'google_id' => $user->getId(),
                ]);
                $saveUser = User::where('email', $user->getEmail())->first();

                Auth::loginUsingId($saveUser->id);
                return redirect('/dashboard');
            }
            //catch exceptions
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect('/')->with('status',"您目前有一些錯誤");
        }
    }
}
