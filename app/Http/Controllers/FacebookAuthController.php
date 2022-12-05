<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class FacebookAuthController extends Controller
{
    //
    public function redirect(){
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            //create a user using socialite driver facebook
            $user = Socialite::driver('facebook')->stateless()->user();
            // if the user exits, use that user and login
            $finduser = User::where('email', $user->getEmail())->first();

            if(!$finduser){
                //user is not yet created, so create first
                $saveUser = User::updateOrCreate([
                    'facebook_id' => $user->getId(),
                ],
                [
                        'name' => $user->getName(),
                        'email' => $user->getEmail(),
                        'password' => encrypt('')
                ]
                );
            }else{
                $saveUser = User::where('email', $user->getEmail())->update([
                    'facebook_id' => $user->getId(),
                ]);
                $saveUser = User::where('email', $user->getEmail())->first();

                Auth::loginUsingId($saveUser->id);
                return redirect('/')->with('status',"新會員您好! 請先把個人資料填完整。");
            }
            //catch exceptions
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect('/')->with('status',"您目前有一些錯誤");
        }
    }
}
