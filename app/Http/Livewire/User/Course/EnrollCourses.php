<?php

namespace App\Http\Livewire\User\Course;

use Livewire\Component;
use App\Models\Course;
use App\Models\Enroll;

class EnrollCourses extends Component
{
    public function render()
    {
        return view('livewire.user.course.enroll-courses')
        ->layout('layouts.app', ['page' => 'Enrolled Courses']);
    }

    public function mount()
    {
        
    }
}
