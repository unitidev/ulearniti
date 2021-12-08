<?php

namespace App\Http\Livewire\Instructor\Course\Create;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\CourseDraft;
use App\Models\Category;
use App\Models\Language;
use App\Models\Level;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;

class Info extends Component
{
    public $courseCategory, $subCategoryStatus, $subCategory, $courseId, $courseLanguage, $courseLevel, $selectedCategory;
    protected $listeners = ['storeInfo', 'setId'];


    public function render()
    {
        return view('livewire.instructor.course.create.info',['languages'=>Language::get(), 'levels'=>Level::get(), 'categories'=>Category::get()]);
    }

    public function mount($courseId)
    {
        $this->courseId = $courseId;
        
        $course = CourseDraft::where('id', $courseId)->first();
        $this->courseLanguage = $course->language;
        $this->courseLevel = $course->level;
        $this->courseCategory = $course->category;
        $this->selectedCategory = $course->subcategory;
        $this->subCategory = Subcategory::where('category_id', $this->courseCategory)->get();
        $this->subCategoryStatus = "active";    
    }

    public function setSub()
    {
        if($this->courseCategory == "default" || $this->courseCategory == null)
        {
            $this->subCategoryStatus = "active";
        }
        elseif($this->courseCategory == 14)
        {
            $this->subCategory = Subcategory::where('category_id', $this->courseCategory)->get();
            $this->subCategoryStatus = "default";
        }
        else
        {
            $this->subCategory = Subcategory::where('category_id', $this->courseCategory)->get();
            $this->subCategoryStatus = "active";
        }
        
    }   
    
    public function storeInfo()
    {
        //dd(Session::get('course-id'));
        $course = CourseDraft::where('id', $this->courseId)->first();
        $course->id = $this->courseId;
        $course->language = $this->courseLanguage;
        $course->level = $this->courseLevel;
        $course->category = $this->courseCategory;
        $course->subcategory = $this->selectedCategory;
        $this->emitTo('instructor.course.create.description','setId',$course->id);
        $course->save();        
    }

    public function setId($courseId)
    {
        $this->courseId = $courseId;
    }

}
