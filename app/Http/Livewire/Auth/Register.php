<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class Register extends Component
{
    public $email;

    protected $rules = [

        'email' => 'required|email',

    ];

    protected $messages = [

        'email.required' => 'The Email Address cannot be empty.',

        'email.email' => 'The Email Address format is not valid.',

    ];

    protected $validationAttributes = [

        'email' => 'email address'

    ];
    
    public function render()
    {
        return view('livewire.auth.register')
            ->layout('layouts.guest', ['title' => 'Register - Ulearniti', 'description' => 'Be part of us for more knowledge', 'url' => 'https://fiddle.unitidev.com/register', 'image' => 'https://fiddle.unitidev.com/images/1200x630-logo.png']);
    }

    public function validateUser()
    {
        if($this->validateEmail())
        {
            $auth_user = new User;
            $auth_user->fullname = "";
            $auth_user->email = $this->email;
            $auth_user->method = "email";
            Session::put('Auth_data', $auth_user);
            return redirect()->to('/register/flow');
        }
    }

    public function validateEmail()
    {

        $email = filter_var($this->email, FILTER_SANITIZE_EMAIL); 
        $user = User::firstWhere('email', $this->email);
        if($user)
        {
            return false;
        }
        else
        {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->emit('emailValidation', 'valid');
                return true;
            } else {
                $this->emit('emailValidation', 'invalid');
                return false;
            }
        }
    }
}
