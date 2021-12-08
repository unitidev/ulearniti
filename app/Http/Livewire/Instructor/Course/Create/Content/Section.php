<?php

namespace App\Http\Livewire\Instructor\Course\Create\Content;

use Livewire\Component;
use App\Models\ContentDraft;

class Section extends Component
{
    public $title;
    public $content;
    public $content_id;
    public $position;
    
    public function render()
    {
        return view('livewire.instructor.course.create.content.section');
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
}
