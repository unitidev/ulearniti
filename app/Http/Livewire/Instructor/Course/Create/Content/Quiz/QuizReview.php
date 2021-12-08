<?php

namespace App\Http\Livewire\Instructor\Course\Create\Content\Quiz;

use Livewire\Component;
use App\Models\ContentDraft;
use App\Models\QuestionDraft;
use App\Models\Answer;

class QuizReview extends Component
{
    public $content_id, $title, $questions, $question_number, $answers, $total_questions;
    protected $listeners = ['mountID'];

    public function render()
    {
        return view('livewire.instructor.course.create.content.quiz.quiz-review');
    }

    public function mountID($content_id)
    {
        $this->content_id = $content_id;
        $this->title = ContentDraft::where('id', $content_id)->first()->title;
        $this->questions = QuestionDraft::where('content_id', $content_id)->get();
        $this->question_number = 1;
        $this->totalQuestions();
        $this->emit('updateTotalQuestions', $this->total_questions);
    }

    public function totalQuestions()
    {
        $this->total_questions = QuestionDraft::where('content_id', $this->content_id)->count();
        return $this->total_questions;
    }

    public function incrementQuestionNumber()
    {
        $this->question_number++;
    }

    public function decrementQuestionNumber()
    {
        $this->question_number--;
    }
}
