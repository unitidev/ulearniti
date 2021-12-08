<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email;
    public $password;
    public $remember;

    public function render()
    {
        return view('livewire.auth.login')
            ->layout('layouts.guest', ['title' => 'Login - Ulearniti', 'description' => 'Welcome home', 'url' => 'https://fiddle.unitidev.com/login', 'image' => 'https://fiddle.unitidev.com/images/1200x630-logo.png']);
    }

    public function mount()
    {
        if(Auth::user())
        {
            return redirect('/');
        }
    }

    public function validateEmail()
    {
        if($this->email != null)
        {
            $user = User::where('email', $this->email)->first();
            if($user)
            {
                $this->emit('emailValidation', 'valid');
            }
            else
            {
                $this->emit('emailValidation', 'invalid');
            }
        }
    }

    public function validateUser()
    {
        $user = User::where('email', $this->email)->first();
        if($user)
        {
            if(Hash::check($this->password, $user->password))
            {
                $this->emit('passwordValidation', 'valid');
                if($this->remember == true) {
                    Auth::login($user, $remember = true);
                }
                else {
                    Auth::login($user);
                }
                return redirect('/');

                
            }
            else
            {
                $this->emit('passwordValidation', 'invalid');
            }
        }
        else
        {
            $this->emit('passwordValidation', 'invalid user');
        }
    }
}
