<?php

namespace App\Http\Livewire\Instructor\Course\Create;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\CourseDraft;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Title extends Component
{
    public $title, $subtitle, $type, $courseId;
    protected $listeners = [
        'updateTitles',
    ];
    public function render()
    {
        return view('livewire.instructor.course.create.title');
    }

    public function mount($courseId)
    {   
        $this->courseId = $courseId;
        
        $course = CourseDraft::where('id', $courseId)->first();
        $this->title = $course->title;  
        $this->subtitle = $course->subtitle;      
    }

    public function updateTitles($title, $subtitle)
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $course = CourseDraft::where('id', $this->courseId)->first();
        $course->title = $this->title;
        $course->subtitle = $this->subtitle;
        $course->save();
        
    }
}
