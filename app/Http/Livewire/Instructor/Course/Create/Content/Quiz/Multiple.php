<?php

namespace App\Http\Livewire\Instructor\Course\Create\Content\Quiz;

use Livewire\Component;
use App\Models\QuestionDraft;
use App\Models\AnswerDraft;

class Multiple extends Component
{

    public $question_id, $question;

    public function render()
    {
        return view('livewire.instructor.course.create.content.quiz.multiple');
    }

    public function mount($id, $questionNumber)
    {
        $this->question_id = $id;
        $this->question = QuestionDraft::where('id', $id)->first()->title;
        $this->answers = AnswerDraft::where('question_id', $id)->get();        
        $this->question_number = $questionNumber;
    }

    public function updateQuestion($id)
    {
        $quest = QuestionDraft::firstWhere('id', $id);
        $quest->title = $this->question;
        $quest->save();
    }

    public function addAnswer()
    {
        $answer = new AnswerDraft;
        $answer->question_id = $this->question_id;
        $answer->save();
        $this->answers = AnswerDraft::where('question_id', $this->question_id)->get();
    }

    public function removeAnswer($id)
    {
        $answer = AnswerDraft::where('id',$id)->first();
        $answer->delete();
        //dd($answer);
        $this->answers = AnswerDraft::where('question_id', $this->question_id)->get();
    }

    public function setCorrectAnswer($id)
    {
        $answers = AnswerDraft::where('question_id', $this->question_id)->get();
        foreach($answers as $answer)
        {
            if($answer->id == $id)
            {
                if($answer->correct_answer == "true")
                {
                    $answer->correct_answer = "false";
                    $answer->save();
                }
                else
                {
                    $answer->correct_answer = "true";
                    $answer->save();
                }
                
            }
        }
        $this->answers = AnswerDraft::where('question_id', $this->question_id)->get();
    }
}
