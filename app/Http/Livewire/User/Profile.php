<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Profile extends Component
{
    public $username, $user, $profilePicture;

    public function render()
    {
        return view('livewire.user.profile')
            ->layout('layouts.app', ['page' => 'Profile View']);
    }

    public function mount()
    {
        $this->user = User::where('id', Auth::id())->first();
        $this->profilePicture = Storage::disk('s3')->temporaryUrl($this->user->profile_photo, now()->addMinutes(60));
    }
}
