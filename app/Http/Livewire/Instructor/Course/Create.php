<?php

namespace App\Http\Livewire\Instructor\Course;

use Livewire\Component;
use App\Models\CourseDraft;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public $page, $status, $index, $courseId, $course_type, $course_duration;

    protected $listeners = [
        'durationExceed'
    ];

    public function render()
    {
        return view('livewire.instructor.course.create')
            ->layout('layouts.wizard', ['page' => 'Create Course']);
    }

    public function mount($courseId)
    {
        $course = CourseDraft::where('id', $courseId)->first();
        $this->course_type = $course->type;
        if($course->user_id == Auth::id())
        {
            $this->courseId = $course->id;
        }
        else
        {
            return redirect()->route('dashboard');
        }
    }

    public function changePage($page)
    {
        if($page == "course-price")
        {

        }
        else
        {
            
        }
        $this->page = $page;
    }

    public function increaseIndex()
    {
        $this->index++;
    }

    public function pausePromotionalVideo()
    {
        $this->emitTo('instructor.course.create.promotional-video', 'pauseVideo');
    }

    public function pauseCrVideo()
    {
        $this->emitTo('instructor.course.create.course-review', 'pauseVideo');
    }

    public function submitCourse()
    {
        $course = CourseDraft::where('id', $this->courseId)->first();
        $course->status = "submitted";
        $course->save();
        return redirect('/instructor/courses');
    }

    public function durationExceed($course_duration)
    {
        //dd($course_duration);
        $this->course_duration = $course_duration;
        //return $this->course_duration;
    }
}
