<?php

namespace App\Http\Livewire\Instructor\Courses;

use Livewire\Component;
use App\Models\ContentDraft;
use App\Models\CourseDraft;
use Illuminate\Support\Facades\Storage;

class CoursesCard extends Component
{
    public $course_id, $course;

    public function render()
    {
        return view('livewire.instructor.courses.courses-card');
    }

    public function mount($course_id)
    {
        $this->course_id = $course_id;
        $this->course = CourseDraft::find($course_id);
    }

    public function getCourseImage($courseImage)
    {
        if($courseImage)
        {
            return Storage::disk('s3')->temporaryUrl($courseImage, now()->addMinutes(1));
        }
        else
        {   return null; }
    }

    public function totalVideoDuration($courseId)
    {
        $course_duration = 0;
        $contents = ContentDraft::where('course_id', $courseId)->get();
        foreach($contents as $content)
        {
            $course_duration += $content->video_duration;
        }
        
        $seconds = round($course_duration);
        return sprintf('%02d hr %02d min ', ($seconds/ 3600),($seconds/ 60 % 60));        
    }

    public function totalSection($courseId)
    {
        $number_of_section = 0;
        $contents = ContentDraft::where('course_id', $courseId)->get();
        foreach($contents as $content)
        {
            if($content->type == "section")
            {   $number_of_section ++;  }
        }

        return $number_of_section;
    }

    public function totalVideo($courseId)
    {
        $number_of_video = 0;
        $contents = ContentDraft::where('course_id', $courseId)->get();
        foreach($contents as $content)
        {
            if($content->type == "video")
            {   $number_of_video ++;  }
        }

        return $number_of_video;
    }

    public function totalQuiz($courseId)
    {
        $number_of_quiz = 0;
        $contents = ContentDraft::where('course_id', $courseId)->get();
        foreach($contents as $content)
        {
            if($content->type == "quiz")
            {   $number_of_quiz ++;  }
        }

        return $number_of_quiz;
    }
}
