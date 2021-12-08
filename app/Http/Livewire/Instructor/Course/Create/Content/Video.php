<?php

namespace App\Http\Livewire\Instructor\Course\Create\Content;

use Livewire\Component;
use App\Models\ContentDraft;
use Carbon;

class Video extends Component
{
    public $title, $content, $content_id, $position, $video, $uid, $video_duration;

    public function render()
    {
        return view('livewire.instructor.course.create.content.video');
    }

    public function mount($content_id)
    {
        $this->content_id = $content_id;
        $content = ContentDraft::where('id', $this->content_id)->first();
        $this->title = $content->title;
        $this->position = $content->position;
        $this->video = $content->filename;
        $this->uid = $content->uid;
        if($content->video_duration)
        {   
            $seconds = round($content->video_duration);
            $this->video_duration = sprintf('%02d:%02d:%02d', ($seconds/ 3600),($seconds/ 60 % 60), $seconds% 60);
        }
    }

    public function updateContent()
    {
        $content = ContentDraft::where('id', $this->content_id)->first();
        $content->title = $this->title;
        $content->save();
    }

    public function saveVideo($uid)
    {
        $content = ContentDraft::where('id', $this->content_id)->first();
        $content->uid = $uid;
        $content->save();

        $this->uid = $uid;
    }

    public function saveVideoDuration($time)
    {
        $content = ContentDraft::where('id', $this->content_id)->first();
        $content->video_duration = $time;
        $content->save();
        $seconds = round($time);
        $this->video_duration = sprintf('%02d:%02d:%02d', ($seconds/ 3600),($seconds/ 60 % 60), $seconds% 60);

        $this->emitUp('totalVideoDuration');
    }

    public function emitVideoUrl()
    {
        $this->emitTo('modals.plyr', 'setVideoUrl', 'https://videodelivery.net/'.$this->uid.'/manifest/video.m3u8');
    }    
}
