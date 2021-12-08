<?php

namespace App\Http\Livewire\Instructor\Course\Create;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\CourseDraft;

class Description extends Component
{
    public $description, $courseId;
    protected $listeners = [
        'updateDescription',
        'setId',
    ];

    public function render()
    {
        return view('livewire.instructor.course.create.description');
    }
    
    public function mount($courseId)
    {
        $this->courseId = $courseId;
        
        $course = CourseDraft::where('id', $courseId)->first();
        $this->description = $course->description;
        
    }

    public function updateDescription($description)
    {
        $this->description = $description;
        
        $course = CourseDraft::where('id', $this->courseId)->first();
        $course->description = $description;
        
        $course->save();
        $this->emitTo('instructor.course.create.target','setId',$course->id);
    }

    public function setId($courseId)
    {
        $this->courseId = $courseId;
    }
}
