<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\CourseDraft;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;

class Courses extends Component
{
    public $page, $pending_courses, $published_courses;
    protected $listeners = ['remountPendingCourses', 'remountPublishedCourses'];
    
    public function render()
    {
        return view('livewire.admin.courses')
        ->layout('layouts.admin', ['page' => 'Welcome Admin', 'navigation' => 'Courses']);
    }

    public function mount()
    {
        $this->pending_courses = CourseDraft::where('status', 'submitted')->orderBy('updated_at', 'asc')->get();
        $this->published_courses = Course::where('status', 'published')->orderBy('updated_at', 'asc')->get();
    }

    public function remountPendingCourses()
    {
        $this->pending_courses = CourseDraft::where('status', 'submitted')->orderBy('updated_at', 'asc')->get();
    }

    public function remountPublishedCourses()
    {
        $this->published_courses = Course::where('status', 'published')->orderBy('updated_at', 'asc')->get();
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
}
