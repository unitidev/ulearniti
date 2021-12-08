<?php

namespace App\Http\Livewire\Ui;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HeaderWizard extends Component
{
    public $theme, $page, $profilePicture;

    public function mount($page)
    {
        $user = User::where('id', Auth::id())->first();
        $this->profilePicture = Storage::disk('s3')->temporaryUrl($user->profile_photo, now()->addMinutes(60));
        if($user->theme==null)
        {
            $this->theme = 'light';
            $user->theme = 'light';
            $user->save();
        }
        else
        {
            $this->theme = $user->theme;
        }
    }

    public function render()
    {
        return view('livewire.ui.header-wizard');
    }

    public function changeTheme()
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
