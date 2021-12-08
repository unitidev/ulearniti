<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;
use App\Models\SocialLink;
use App\Models\Course;
use App\Models\Avatar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Setting extends Component
{
    public $username, $user, $profile_photo, $profile_photo_name, $social_link, $bio, $professional_headline, $avatars, $avatar_id, $avatar_photo, $page;

    protected $listeners = ['remountSocialLink', 'remountUser'];

    public function render()
    {
        return view('livewire.user.setting')
            ->layout('layouts.app', ['page' => 'Setting']);
    }

    public function mount()
    {   
        $this->user = User::where('id', Auth::id())->first();
        $this->profile_photo = Storage::disk('s3')->temporaryUrl($this->user->profile_photo, now()->addMinutes(60));
    }

    public function changePage($page)
    {
        $this->page = $page;
    }

    public function getProfilePhoto($filename)
    {
        return Storage::disk('s3')->temporaryUrl($filename, now()->addMinutes(60));
    }


    public function remountUser()
    {
        $this->user = User::where('id', Auth::id())->first();
    }


}
