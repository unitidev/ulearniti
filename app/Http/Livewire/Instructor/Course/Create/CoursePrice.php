<?php

namespace App\Http\Livewire\Instructor\Course\Create;

use Livewire\Component;
use App\Models\CourseDraft;

class CoursePrice extends Component
{
    public $price, $courseId;

    public function render()
    {
        return view('livewire.instructor.course.create.course-price');
    }

    public function mount($courseId)
    {
        $this->courseId = $courseId;
        $this->price = CourseDraft::where('id', $this->courseId)->first()->price;
    }

    public function checkPrice()
    {
        $this->emit('priceFloor', $this->price);   
    }

    public function updatePrice()
    {
        $course = CourseDraft::firstWhere('id', $this->courseId);
        $course->price = $this->price;
        $course->save();
    }
}
