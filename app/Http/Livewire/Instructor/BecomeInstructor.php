<?php

namespace App\Http\Livewire\Instructor;

use Livewire\Component;
use App\Models\CourseDraft;
use Illuminate\Support\Facades\Auth;

class BecomeInstructor extends Component
{
    public function render()
    {
        return view('livewire.instructor.become-instructor')
            ->layout('layouts.app', ['page' => 'Become Instructor']);
    }

    public function mount()
    {
        $courses = CourseDraft::where('user_id', Auth::id())->count();
        
        if($courses > 0)
        {
            return redirect('/instructor/courses');
        }
    }
}
