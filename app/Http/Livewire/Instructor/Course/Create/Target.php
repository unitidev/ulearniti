<?php

namespace App\Http\Livewire\Instructor\Course\Create;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\CourseDraft;

class Target extends Component
{
    public $target, $courseId;
    protected $listeners = [
        'updateTarget',
        'setId',
    ];

    public function render()
    {
        return view('livewire.instructor.course.create.target');
    }

    public function mount($courseId)
    {
        $this->courseId = $courseId;

        $course = CourseDraft::where('id', $courseId)->first();
        $this->target = $course->target;               
    }

    public function updateTarget($target)
    {
        $this->target = $target;

        $course = CourseDraft::where('id', $this->courseId)->first();
        $course->target = $this->target;
        $course->save();
        $this->emitTo('instructor.course.create.requirement','setId',$course->id);

    }

    public function setId($courseId)
    {
        $this->courseId = $courseId;
    }
}
