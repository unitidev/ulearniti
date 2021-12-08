<?php

namespace App\Http\Livewire\Instructor\Course\Create\Content\Quiz;

use Livewire\Component;
use App\Models\AnswerDraft;

class AnswerReview extends Component
{
    public $question_id;

    public function render()
    {
        return view('livewire.instructor.course.create.content.quiz.answer-review');
    }

    public function mount($question_id)
    {
        $this->question_id = $question_id;
        $this->answers = AnswerDraft::where('question_id', $this->question_id)->get();
    }
}
