<?php

namespace App\Http\Livewire\Instructor\Course\Create;

use Livewire\Component;
use App\Models\CourseDraft;
use App\Models\ContentDraft;

class CourseReview extends Component
{
    public $course_id, $title, $description, $target, $outcome, $requirement, $promotional_video, $contents, $question_id, $url = 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8';
    protected $listeners = ['pauseVideo'];
    public function render()
    {
        return view('livewire.instructor.course.create.course-review');
    }

    public function mount($courseId)
    {
        $this->course_id = $courseId;
        $course = CourseDraft::firstWhere('id',$courseId);
        $this->title = $course->title;
        $this->description = $course->description;
        $this->target = $course->target;
        $this->outcome = $course->outcome;
        $this->requirement = $course->requirement;
        $this->promotional_video = "https://videodelivery.net/" . $course->promotional_video . "/manifest/video.m3u8";
        $this->contents = ContentDraft::where('course_id', $courseId)->orderBy('position','ASC')->get();
    }

    public function numberOfSections()
    {
        $section = ContentDraft::where('course_id', $this->course_id)->where('type','section')->count();
        //dd($section);
        return $section;
    }

    public function numberOfContents()
    {
        $section = ContentDraft::where('course_id', $this->course_id)->count();
        //dd($section);
        return $section;
    }

    public function setLoopPosition($position)
    {
        $this->loopPosition = $position;
    }

    public function pauseVideo()
    {
        $this->emit('stopPlyr', true);
    }

    public function showQuiz($content_id)
    {
        $this->emitTo('instructor.course.create.content.quiz.quiz-review', 'mountID', $content_id);
    }
}
