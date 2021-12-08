<?php

namespace App\Http\Livewire\Modals;

use Livewire\Component;
use App\Models\CourseDraft;

class InstructorCoursesEditConfirmation extends Component
{
    public $course_id;
    protected $listeners = ['retreiveID'];

    public function render()
    {
        return view('livewire.modals.instructor-courses-edit-confirmation');
    }

    public function retreiveID($course_id)
    {
        $this->course_id = $course_id;
    }

    public function editCourse()
    {
        $course = CourseDraft::firstwhere('id', $this->course_id);
        $course->status = "draft";
        $course->save();
        return redirect('/instructor/course/create/title/'.$this->course_id);
    }
}
