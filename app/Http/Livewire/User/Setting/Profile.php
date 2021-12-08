<?php

namespace App\Http\Livewire\User\Setting;

use Livewire\Component;
use App\Models\User;
use App\Models\SocialLink;
use App\Models\Course;
use App\Models\Avatar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Profile extends Component
{
    public $username, $user, $profile_photo, $profile_photo_name, $social_link, $bio, $professional_headline, $avatars, $avatar_id, $avatar_photo;

    protected $listeners = ['remountSocialLink'];

    public function render()
    {
        return view('livewire.user.setting.profile');
    }

    public function mount()
    {
        $this->user = User::where('id', Auth::id())->first();
        $this->profile_photo = Storage::disk('s3')->temporaryUrl($this->user->profile_photo, now()->addMinutes(60));
        $this->bio = $this->user->bio;
        $this->professional_headline = $this->user->professional_headline;
        $this->fullname = $this->user->full_name;
        $this->profile_photo_name = $this->user->profile_photo;
        $this->avatar_id = $this->user->avatar;
        $this->social_links = SocialLink::where('user_id', $this->user->id)->get();
        $this->avatars = Avatar::get();
    }

    public function getProfilePhoto($filename)
    {
        return Storage::disk('s3')->temporaryUrl($filename, now()->addMinutes(60));
    }

    public function getAvatar($id)
    {
        $avatar = Avatar::firstWhere('id', $id);
        return Storage::disk('s3')->temporaryUrl($avatar->filename, now()->addMinutes(60));
    }

    public function updateProfile()
    {
        $this->updateFullname();
        $this->updateProfessionalHeadline();
        $this->updateBio();

        $user = User::where('id', Auth::id())->first();
        $user->profile_photo = $this->profile_photo_name;
        $user->avatar = $this->avatar_id;
        //dd($this->profile_photo_name, $this->avatar_id);
        $user->save();
        $this->emitUp('remountUser');
        $this->emitTo('ui.header', 'remountProfilePhoto');
        
    }

    public function updateFullname()
    {
        $user = User::where('id', Auth::id())->first();
        $user->full_name = $this->fullname;
        $user->save();
    }

    public function updateProfessionalHeadline()
    {
        $user = User::where('id', Auth::id())->first();
        $user->professional_headline = $this->professional_headline;
        $user->save();
    }

    public function updateBio()
    {
        $user = User::where('id', Auth::id())->first();
        $user->bio = $this->bio;
        $user->save();
    }

    public function addSocial($type)
    {
        $social_link = new SocialLink;
        $social_link->user_id = $this->user->id;
        $social_link->type = $type;
        $social_link->url = "https://".$type.".com/";
        $social_link->save();
        $this->social_links = SocialLink::where('user_id', $this->user->id)->get();
    }

    public function remountSocialLink()
    {
        $this->social_links = SocialLink::where('user_id', $this->user->id)->get();
    }

    public function remountUser()
    {
        $this->user = User::where('id', Auth::id())->first();
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
        $this->updateProfilePhoto($avatar->filename);
    }

    public function updateProfilePhoto($filename)
    {   
        $this->profile_photo = Storage::disk('s3')->temporaryUrl($filename, now()->addMinutes(1));
        $this->profile_photo_name = $filename;
    }
}
