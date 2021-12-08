<?php

namespace App\Http\Livewire\User\Setting;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Account extends Component
{
    public $input_email, $input_username, $input_password, $confirm_password, $new_password, $username, $email;

    public function render()
    {
        return view('livewire.user.setting.account');
    }

    public function mount()
    {
        $user = User::where('id', Auth::id())->first();
        $this->username = $user->username;
        $this->email = $user->email;

    }

    public function checkEmail()
    {
        $users = User::get();
        foreach($users as $user)
        {
            if($this->input_email == $user->email)
            {
                $this->emit('emailValidation', 'invalid');
                break;
            }
        }
        $this->emit('emailValidation', 'valid');
    }

    public function checkUsername()
    {
        $users = User::get();
        foreach($users as $user)
        {
            if($this->input_username == $user->username)
            {
                $this->emit('usernameValidation', 'invalid');
                break;
            }
        }
        $this->emit('usernameValidation', 'valid');
    }

    public function checkCurrentPassword()
    {
        $user = User::where('id', Auth::id())->first();
        if(Hash::check($this->input_password, $user->password))
        {
            $this->emit('passwordValidation', 'valid');
            return true;
        }
        else
        {
            $this->emit('passwordValidation', 'invalid');
            return false;
        }
    }

    public function updatePassword()
    {   
        if($this->checkCurrentPassword() === true)
        {
            $user = User::where('id', Auth::id())->first();
            $user->password = Hash::make($this->new_password);
            $user->save();
        }
        
    }
}
