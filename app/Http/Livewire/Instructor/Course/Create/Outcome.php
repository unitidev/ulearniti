<?php

namespace App\Http\Livewire\Instructor\Course\Create;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\CourseDraft;

class Outcome extends Component
{
    public $outcome, $courseId;
    protected $listeners = [
        'updateOutcome',
        'setId',
    ];

    public function render()
    {
        return view('livewire.instructor.course.create.outcome');
    }

    public function mount($courseId)
    {
        $this->courseId = $courseId;
        
        $course = CourseDraft::where('id', $courseId)->first();
        $this->outcome = $course->outcome;
    }

    public function updateOutcome($outcome)
    {
        $this->outcome = $outcome;

        $course = CourseDraft::where('id', $this->courseId)->first();
        $course->outcome = $this->outcome;
        $course->save();
        $this->emitTo('instructor.course.create.course-image','setId',$this->courseId);
    }

    public function setId($courseId)
    {
        $this->courseId = $courseId;
    }
}
