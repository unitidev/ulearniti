<?php

namespace App\Http\Livewire\User\Profile;

use Livewire\Component;
use App\Models\User;
use App\Models\SocialLink;

class SocialLinks extends Component
{
    public $type, $url, $social_link_id, $username;
    
    public function render()
    {
        return view('livewire.user.profile.social-links');
    }

    public function mount($id)
    {
        $this->social_link_id = $id;
        $social_link = SocialLink::where('id', $id)->first();
        $this->type = $social_link->type;
        $this->url = $social_link->url;
        $this->username = $social_link->username;
    }

    public function clearSocialLink($id)
    {
        SocialLink::where('id', $id)->first()->delete();
        $this->emitTo('user.setting.profile','remountSocialLink');
    }

    public function updateSocialLink()
    {
        $social_link = SocialLink::where('id', $this->social_link_id)->first();
        $social_link->username = $this->username;
        $social_link->save();
    }
}
