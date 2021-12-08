<?php

namespace App\Http\Livewire\Instructor\Course\Create\Content\Quiz;

use Livewire\Component;
use App\Models\QuestionDraft;
use App\Models\AnswerDraft;

class TrueFalse extends Component
{
    public $question_id, $question, $answers;

    public function render()
    {
        return view('livewire.instructor.course.create.content.quiz.true-false');
    }

    public function mount($id)
    {
        $this->question_id = $id;
        
        $this->question = QuestionDraft::where('id', $id)->first()->title;
        $this->answers = AnswerDraft::where('question_id', $this->question_id)->get();
    }

    public function updateQuestion($id)
    {
        $quest = QuestionDraft::firstWhere('id', $id);
        $quest->title = $this->question;
        $quest->save();
    }

    public function setCorrectAnswer($id)
    {
        $answers = AnswerDraft::where('question_id', $this->question_id)->get();
        foreach($answers as $answer)
        {
            if($answer->id == $id)
            {
                $answer->correct_answer = "true";
                $answer->save();
            }
            else
            {
                $answer->correct_answer = "false";
                $answer->save();
            }
        }
        $this->answers = AnswerDraft::where('question_id', $this->question_id)->get();
    }
}
