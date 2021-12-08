<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Avatar;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Carbon\Carbon;

class RegisterFlow extends Component
{
    public $email, $profile_photo, $avatar_id, $avatar_photo, $profile_photo_name;
    public $avatars, $full_name, $username, $password, $page, $register_method;

    public function render()
    {
        return view('livewire.auth.register-flow')
            ->layout('layouts.guest', ['title' => 'Register - Ulearniti', 'description' => 'Be part of us for more knowledge', 'url' => 'https://fiddle.unitidev.com/register', 'image' => 'https://fiddle.unitidev.com/images/1200x630-logo.png']);
    }

    public function mount()
    {
        $this->avatars = Avatar::get();

        foreach($this->avatars as $avatar)
        {
            $avatar->url = Storage::disk('s3')->temporaryUrl($avatar->filename, now()->addMinutes(1));;
        } 

        if(Session::get('Auth_data'))
        {
            $this->email = Session::get('Auth_data')->email;
            $this->full_name = Session::get('Auth_data')->fullname;
            $this->register_method = Session::get('Auth_data')->method;

            $user = User::firstWhere('email', $this->email);

            if($user && $user->email_verified_at == null)
            {
                $this->page = "done";
            }
            elseif($user && $user->email_verified_at != null)
            {
                Auth::login($user);
                return redirect()->to('/');
            }
            else
            {
                $this->page = "avatar";
            }
        }
        else
        {
            return redirect()->to('/register');
        }
    }

    public function updateProfilePhoto($filename)
    {
        $this->profile_photo = Storage::disk('s3')->temporaryUrl($filename, now()->addMinutes(1));
        $this->profile_photo_name = $filename;
    }

    public function destroyProfilePhoto()
    {
        $this->profile_photo = null;
    }

    public function changeAvatar($avatar_id)
    {
        $avatar = Avatar::firstWhere('id', $avatar_id);
        $this->avatar_id = $avatar_id;
        $this->avatar_photo = Storage::disk('s3')->temporaryUrl($avatar->filename, now()->addMinutes(1));
    }

    public function registerUser()
    {
        if(!$this->profile_photo)
        {
            $avatar = Avatar::firstWhere('id', $this->avatar_id);
            $this->profile_photo_name = $avatar->filename;
        }

        if($this->register_method == "socialite")
        {
            $user = User::create([
                'full_name' => $this->full_name,
                'username' => $this->username,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'avatar' => $this->avatar_id,
                'profile_photo' => $this->profile_photo_name,
            ]);
            $user->markEmailAsVerified();
            event(new Verified($user));
            Auth::login($user);
        }
        else
        {
            $user = User::create([
                'full_name' => $this->full_name,
                'username' => $this->username,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'avatar' => $this->avatar_id,
                'profile_photo' => $this->profile_photo_name,
            ]);
            Auth::login($user);
            event(new Registered($user));
        }
    }

    public function validateUsername()
    {
        if ($this->username == trim($this->username) && strpos($this->username, ' ') !== false) {
            $this->emit('validatedUsername', 'contain_space');
        }
        else
        {
            if(User::firstWhere('username', $this->username))
            {
                $this->emit('validatedUsername', 'unavailable');
            }
            else
            {
                $this->emit('validatedUsername', 'available');
            }        
        }        
    }

}
