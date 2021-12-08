<?php

namespace App\Http\Livewire\Unimooc;

use Livewire\Component;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    public $recent_courses;

    public function render()
    {
        return view('livewire.unimooc.index')
            ->layout('layouts.app',['page' => 'UNIMOOC']);
    }

    public function emitVideoUrl($uid)
    {
        $this->emitTo('modals.plyr', 'setVideoUrl', $uid);
    }

    public function mount()
    {
        $this->recent_courses = Course::where('status', 'published')->orderBy('updated_at', 'DESC')->get();
    }

    public function getProfilePhoto($course_id)
    {
        return Storage::disk('s3')->temporaryUrl(Course::find($course_id)->user()->first()->profile_photo, now()->addMinutes(1));
    }

    public function getUsername($course_id)
    {
        return Course::find($course_id)->user()->first()->username;
    }

    public function getCourseImage($course_id)
    {
        return Storage::disk('s3')->temporaryUrl(Course::find($course_id)->first()->course_image, now()->addMinutes(1));;
    }

    public function getPromotionalVideo($course_id)
    {
        return Course::find($course_id)->first()->promotional_video;
    }
}
