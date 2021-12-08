<?php

namespace App\Http\Livewire\Instructor;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\CourseDraft;
use App\Models\Course;
use App\Models\ContentDraft;
use Illuminate\Support\Facades\Storage;

class Courses extends Component
{
    public $course_drafts, $courses;
    protected $listeners = ['remountCourseDraft'];

    public function render()
    {
        return view('livewire.instructor.courses')
            ->layout('layouts.app', ['page' => 'Courses']);
    }

    public function mount()
    {
        $user = User::where('id', Auth::id())->first();
        
        $this->course_drafts = CourseDraft::where('user_id', Auth::id())->orderBy('updated_at', 'DESC')->get();
        $this->courses = Course::where('user_id', Auth::id())->orderBy('updated_at', 'DESC')->get();
        //dd($this->courses);        
    }

    public function remountCourseDraft()
    {
        $this->courses = Course::where('user_id', Auth::id())->orderBy('updated_at', 'DESC')->get();
    }

    
}
