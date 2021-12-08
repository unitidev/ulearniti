<?php

namespace App\Http\Livewire\Instructor\Course\Create;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\CourseDraft;

class Requirement extends Component
{
    public $requirement, $courseId;
    protected $listeners = [
        'updateRequirement',
        'setId',
    ];

    public function render()
    {
        return view('livewire.instructor.course.create.requirement');
    }

    public function mount($courseId)
    {
        $this->courseId = $courseId;
        
        $course = CourseDraft::where('id', $courseId)->first();
        $this->requirement = $course->requirement;              
    }

    public function updateRequirement($requirement)
    {
        $this->requirement = $requirement;

        $course = CourseDraft::where('id', $this->courseId)->first();
        $course->requirement = $this->requirement;
        $course->save();
        $this->emitTo('instructor.course.create.outcome','setId',$course->id);
    }

    public function setId($courseId)
    {
        $this->courseId = $courseId;
    }
}
