<?php

namespace App\Http\Livewire\Instructor\Course\Create\Content\Quiz;

use Livewire\Component;
use App\Models\AnswerDraft;

class AnswerTruefalse extends Component
{
    public $answer_id, $answer_title , $correct_answer;

    public function render()
    {
        return view('livewire.instructor.course.create.content.quiz.answer-truefalse');
    }

    public function mount($answer_id)
    {
        $this->answer_id = $answer_id;
        $this->answer_title = AnswerDraft::firstWhere('id', $this->answer_id)->title;
    }

    
}
