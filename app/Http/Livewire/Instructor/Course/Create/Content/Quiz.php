<?php

namespace App\Http\Livewire\Instructor\Course\Create\Content;

use Livewire\Component;
use App\Models\ContentDraft;
use App\Models\QuestionDraft;

class Quiz extends Component
{
    public $title;
    public $content;
    public $content_id;
    public $position;
    protected $listeners = ['refreshFunctionCount'];

    public function render()
    {
        return view('livewire.instructor.course.create.content.quiz');
    }

    public function mount($content_id)
    {
        $this->content_id = $content_id;
        $content = ContentDraft::where('id', $this->content_id)->first();
        $this->title = $content->title;
        $this->position = $content->position;
    }

    public function updateContent()
    {
        $content = ContentDraft::where('id', $this->content_id)->first();
        $content->title = $this->title;
        $content->save();
    }

    public function manageQuiz()
    {
        $this->emitTo('modals.manage-quiz', 'showQuiz', $this->content_id);
    }

    public function refreshFunctionCount()
    {
        $this->getAllQuestion();
        $this->getSingleChoiceQuestion();
        $this->getMultipleChoiceQuestion();
        $this->getTrueFalsequestion();
    }

    public function getAllQuestion()
    {
        return QuestionDraft::where('content_id', $this->content_id)->count();
    }

    public function getSingleChoiceQuestion()
    {
        return QuestionDraft::where('content_id', $this->content_id)->where('type','single')->count();
    }

    public function getMultipleChoiceQuestion()
    {
        return QuestionDraft::where('content_id', $this->content_id)->where('type','multiple')->count();
    }

    public function getTrueFalsequestion()
    {
        return QuestionDraft::where('content_id', $this->content_id)->where('type','truefalse')->count();
    }
}
