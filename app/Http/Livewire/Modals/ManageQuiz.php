<?php

namespace App\Http\Livewire\Modals;

use Livewire\Component;
use App\Models\QuestionDraft;
use App\Models\AnswerDraft;
use App\Models\ContentDraft;


class ManageQuiz extends Component
{
    public $quizes, $content_id, $title, $questionNumber, $question, $questions, $focused_question, $question_number;
    protected $listeners = [
        'showQuiz',
        'refresh' => '$refresh',
        'deleteQuestion',
    ];
    public function render()
    {
        return view('livewire.modals.manage-quiz')
        ->layout('layouts.app') ;
    }

    public function mount()
    {
        $this->questionNumber = 1;
        $this->questions = QuestionDraft::where('content_id', $this->content_id)->get();
    }

    public function addQuestion($type)
    {
        $quiz = new QuestionDraft;
        $quiz->content_id = $this->content_id;
        $quiz->type = $type;
        $quiz->save();
        if($type == 'truefalse')
        {
            $tAnswer = new AnswerDraft;
            $tAnswer->question_id = $quiz->id;
            $tAnswer->title = "True";
            $tAnswer->save();

            $fAnswer = new AnswerDraft;
            $fAnswer->question_id = $quiz->id;
            $fAnswer->title = "False";
            $fAnswer->save();

        }
        $this->resetQuestionNumber();
        $this->questions = QuestionDraft::where('content_id', $this->content_id)->get();
        $this->emitTo('instructor.course.create.content.quiz','refreshFunctionCount');
    }

    public function showQuiz($id)
    {
        $this->content_id = $id;
        $this->title = ContentDraft::where('id', $id)->first()->title;
        $this->questions = QuestionDraft::where('content_id', $id)->get();
        $this->emit('showModal', $this->content_id);
    }

    public function incQuestionNumber()
    {
        $this->questionNumber++;
    }

    public function resetQuestionNumber()
    {
        $this->questionNumber = 1;
    }

    public function removeQuestion($id)
    {
        $quest = QuestionDraft::where('id', $id )->first();
        $answers = AnswerDraft::where('question_id', $id)->get();
        if($answers)
        {
            foreach($answers as $answer)
            {
                $answer->delete();
            }
        }
        $quest->delete();
        $this->emit('refresh');
        $this->questions = QuestionDraft::where('content_id', $this->content_id)->get();
        $this->resetQuestionNumber();
        $this->emitTo('instructor.course.create.content.quiz','refreshFunctionCount');
    }

    public function deleteQuestion($id)
    {
        $quest = QuestionDraft::where('id', $id )->first();
        $answers = AnswerDraft::where('question_id', $id)->get();
        if($answers)
        {
            foreach($answers as $answer)
            {
                $answer->delete();
            }
        }
        $quest->delete();
    }

}
