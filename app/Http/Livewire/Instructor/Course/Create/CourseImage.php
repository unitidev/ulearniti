<?php

namespace App\Http\Livewire\Instructor\Course\Create;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Models\CourseDraft;

class CourseImage extends Component
{
    public $imgurl, $courseId;
    protected $listeners = [
        'setId',
    ];

    public function render()
    {
        return view('livewire.instructor.course.create.course-image');
    }

    public function mount($courseId)
    {
        $this->courseId = $courseId;
        
        $course = CourseDraft::where('id', $courseId)->first();
        if($course->course_image)
        {
            $this->imgurl = Storage::disk('s3')->temporaryUrl($course->course_image, now()->addMinutes(1));
        }
    }

    public function setId($courseId)
    {
        $this->courseId = $courseId;
    }

    public function getImgUrl($filename)
    {
        $this->imgurl = Storage::disk('s3')->temporaryUrl(
            $filename, now()->addMinutes(1)
        );
    }

    public function saveImage($filename)
    {
        $course = CourseDraft::where('id', $this->courseId)->first();
        $course->course_image = $filename;
        $course->save();
    }

    public function removeCourseImage()
    {
        $this->imgurl = "";
        $this->emit('resetUppy', true);
    }

}
