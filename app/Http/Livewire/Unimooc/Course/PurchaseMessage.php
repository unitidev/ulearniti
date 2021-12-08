<?php

namespace App\Http\Livewire\Unimooc\Course;

use Livewire\Component;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PurchaseMessage extends Component
{
    public $course, $enroll_button;
    public function render()
    {
        return view('livewire.unimooc.course.purchase-message');
    }

    public function mount($course_id)
    {
        $this->course = Course::find($course_id);
        if($this->course->type == "free")
        {   
            $this->price = "Free";
            $this->enroll_button = "ENROLL THIS COURSE";
        }
        else
        {
            $this->price = $this->course->price;
            $this->enroll_button = "PURCHASE THIS COURSE";
        }
    }

    public function getProfilePhoto($course_id)
    {
        return Storage::disk('s3')->temporaryUrl(Course::find($course_id)->user()->first()->profile_photo, now()->addMinutes(1));
    }

    public function getUsername($course_id)
    {
        return Course::find($course_id)->user()->first()->username;
    }

    public function getCourseImage($course_id)
    {
        return Storage::disk('s3')->temporaryUrl(Course::find($course_id)->first()->course_image, now()->addMinutes(1));;
    }

    public function purchaseCourse()
    {
        if(Auth::user())
        {

        }
        else
        {
            return redirect('/login');
        }
    }
}
