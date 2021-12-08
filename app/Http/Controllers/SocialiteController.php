<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class SocialiteController extends Controller
{
    public function google()
    {
        $user = Socialite::driver('google')->user();
        $this->socialiteProcess($user);
        return redirect()->to('/register/flow');
    }

    public function facebook()
    {
        $user = Socialite::driver('facebook')->user();
        $this->socialiteProcess($user);
        return redirect()->to('/register/flow');
    }

    public function microsoft()
    {
        $user = Socialite::driver('microsoft')->user();
        $this->socialiteProcess($user);
        return redirect()->to('/register/flow');
    }

    public function apple()
    {
        $user = Socialite::driver('apple')->user();
        $this->socialiteProcess($user);
        return redirect()->to('/register/flow');
    }

    public function socialiteProcess($user)
    {
        $token = $user->token;
        $refreshToken = $user->refreshToken;
        $expiresIn = $user->expiresIn;

        $user->getId();
        //$user->getNickname();
        $user->getName();
        $user->getEmail();
        //$user->getAvatar();

        $auth_user = new User;
        $auth_user->fullname = $user->getName();
        $auth_user->email = $user->getEmail();
        $auth_user->method = "socialite";

        Session::put('Auth_data', $auth_user);        
    }
}
