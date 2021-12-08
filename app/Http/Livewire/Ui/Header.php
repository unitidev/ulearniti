<?php

namespace App\Http\Livewire\Ui;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Header extends Component
{
    public $theme, $page, $profilePicture, $auth, $user, $username;
    protected $listeners = ['remountProfilePhoto'];

    public function mount($page)
    {
        if(Auth::user())
        {
            $this->user = User::where('id', Auth::id())->first();
            $this->username = $this->user->username;
            $this->profilePicture = Storage::disk('s3')->temporaryUrl($this->user->profile_photo, now()->addMinutes(60));
            if($this->user->theme==null)
            {
                $this->theme = 'light';
                $this->user->theme = 'light';
                $this->user->save();
            }
            else
            {
                $this->theme = $this->user->theme;
            }
            $this->auth = true;
            

        }
        else
        {
            $this->auth = false;
            $this->theme = 'light';
        }
    }

    public function render()
    {
        return view('livewire.ui.header');
    }

    public function changeTheme()
    {
        if(Auth::user())
        {
            $user = User::where('id', Auth::id())->first();
            if($user->theme == 'light')
            {
                $user->theme = 'dark';
                $this->theme = $user->theme;
                $user->save();
            }
            elseif($user->theme == 'dark')
            {
                $user->theme = 'light';
                $this->theme = $user->theme;
                $user->save();
            }
        }
    }

    public function remountProfilePhoto()
    {
        $this->profilePicture = Storage::disk('s3')->temporaryUrl($this->user->profile_photo, now()->addMinutes(60));
    }
}
