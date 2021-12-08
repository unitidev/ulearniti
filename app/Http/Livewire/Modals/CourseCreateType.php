<?php

namespace App\Http\Livewire\Modals;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\CourseDraft;
use Illuminate\Support\Facades\Auth;
use App\Models\ContentDraft;

class CourseCreateType extends Component
{
    public function render()
    {
        return view('livewire.modals.course-create-type');
    }

    public function createCourse($type)
    {
        $course = CourseDraft::where('user_id', Auth::id())->where('title', null)->where('type',$type)->first();
        if ($course)
        {
            return redirect()->route('course-create', ['page' => 'title', 'courseId' => $course->id]);   
        }
        else
        {
            $course = new CourseDraft;
            $course->user_id = Auth::id();
            $course->type = $type;
            $course->status = "draft";
            $course->save();

            $content = new ContentDraft;
            $content->course_id = $course->id;
            $content->position = 0;
            $content->type = "section";
            $content->title = "Untitled section";
            $content->save();

            $content = new ContentDraft;
            $content->course_id = $course->id;
            $content->type = "video";
            $content->position = 1;
            $content->title = "Untitled video";
            $content->save();
            
            return redirect()->route('course-create', ['page' => 'title', 'courseId' => $course->id]);
        }
    }
}
