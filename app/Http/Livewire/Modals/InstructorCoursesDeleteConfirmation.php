<?php

namespace App\Http\Livewire\Modals;

use Livewire\Component;
use App\Models\CourseDraft;
use App\Models\ContentDraft;
use App\Models\QuestionDraft;
use App\Models\AnswerDraft;
use App\Models\Course;

class InstructorCoursesDeleteConfirmation extends Component
{
    public $course_id, $course_status;
    protected $listeners = ['retreiveID'];

    public function render()
    {
        return view('livewire.modals.instructor-courses-delete-confirmation');
    }

    public function retreiveID($course_id)
    {   
        $this->course_id = $course_id;
        $this->course_status = CourseDraft::firstWhere('id', $course_id)->status;
    }

    public function deleteCourses()
    {
        $this->checkContent($this->course_id);
        CourseDraft::firstWhere('id', $this->course_id)->delete();
        $this->emitTo('instructor.courses', 'remountCourseDraft');
    }

    public function checkContent($course_id)
    {
        $content_draft = ContentDraft::where('course_id', $course_id)->get();
        foreach($content_draft as $content)
        {
            if($content->type == 'quiz')
            {
                $this->checkQuestion($content->id);
            }
            $content->delete();
        }
    }

    public function checkQuestion($content_id)
    {
        $question_draft = QuestionDraft::where('content_id', $content_id)->get();
        foreach($question_draft as $question)
        {
            $this->checkAnswer($question->id);
            $question->delete();
        }
    }

    public function checkAnswer($question_id)
    {
        $answer_draft = AnswerDraft::where('question_id', $question_id)->get();
        foreach($answer_draft as $answer)
        {
            $answer->delete();
        }
    }
}
