<?php

namespace App\Http\Livewire\Instructor\Course\Create;

use Livewire\Component;
use App\Models\CourseDraft;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PromotionalVideo extends Component
{
    public $courseId, $promotionalVideo, $readyToStream, $videoUrl;
    protected $listeners = ['pauseVideo'];

    public function render()
    {
        return view('livewire.instructor.course.create.promotional-video');
    }

    public function mount($courseId)
    {
        $this->courseId = $courseId;

        $course = CourseDraft::where('id', $courseId)->first();
        if($course->promotional_video)
        {
            $this->promotionalVideo = $course->promotional_video;
        }
        else{
            $this->promotionalVideo = "";
        }
    }

    public function setId($courseId)
    {
        $this->courseId = $courseId;
    }

    public function saveVideo($uid)
    {
        $this->promotionalVideo = $uid;
        $course = CourseDraft::where('id', $this->courseId)->first();
        $course->promotional_video = $uid;
        $course->save();
    }

    public function removePromotionalVideo()
    {
        $this->promotionalVideo = "";
        $this->emit('resetUppy', true);
    }

    public function pauseVideo()
    {
        $this->emit('stopPlyr', true);
    }
    
}
