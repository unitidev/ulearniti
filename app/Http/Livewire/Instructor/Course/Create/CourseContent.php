<?php

namespace App\Http\Livewire\Instructor\Course\Create;

use Livewire\Component;
use App\Models\ContentDraft;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\CourseDraft;
use App\Models\QuestionDraft;
use App\Models\AnswerDraft;



class CourseContent extends Component
{
    public $contents, $courseId, $focused_content, $section_number = 2, $course_duration;
    public $focused_content_type;
    protected $listeners = [
        'addContent',
        'deleteContent',
        'totalVideoDuration',
        'refresh' => '$refresh',
    ];

    public function mount($courseId)
    {
        $this->courseId = $courseId;
        if(ContentDraft::where('course_id', $this->courseId)->count() < 2)
        {
            $content = new ContentDraft;
            $content->course_id = $this->courseId;
            $content->type = "video";
            $content->position = 1;
            $content->title = "Untitled video";
            $content->save();
        }
        else{
            $this->focused_content = ContentDraft::where('position', 1)->first()->id;
        }
        $this->contents = ContentDraft::where('course_id', $this->courseId)->orderBy('position','ASC')->get();
        //dd($this->courseId, $this->contents);
    }

    public function render()
    {
        return view('livewire.instructor.course.create.course-content');
    }

    public function totalOfSection()
    {
        $total_section = 0;

        foreach ($this->contents as $content)
        {
            if ($content->type == "section")
            {
                $total_section++;
            }
        }
        return $total_section;
    }

    public function incSectionNumber()
    {
        $this->section_number++;
    }
    public function rstSectionNumber()
    {
        $this->section_number = 2;
    }

 //-------------------------------------Event Function----------------------------------//
    
    public function sortContents($contents)
    {
        foreach($contents as $content)
        {
            ContentDraft::find($content['id'])->update(['position'=>$content['position']]);
        }
        $this->contents = ContentDraft::where('course_id', $this->courseId)->orderBy('position','ASC')->get();
        $this->emit('setPositionSort', true);
        $this->rstSectionNumber();
        //$this->emitSelf('refresh');
    }

    public function addContent($id, $type)
    {
        $position = ContentDraft::where('id', $id)->first()->position;
        $contents = ContentDraft::where('course_id', $this->courseId)->get();
        foreach($contents as $content)
        {
            if($content->position > $position)
            {
                $content->position++;
                $content->save();
            }
        }
        $content = new ContentDraft;
        $content->course_id = $this->courseId;
        $content->type = $type;
        $content->position = $position+1;
        $content->title = "Untitled ".$type;     
        $content->save();
        $this->contents = ContentDraft::where('course_id', $this->courseId)->orderBy('position','ASC')->get();
        $this->emit('setPosition', $content->id);
        $this->rstSectionNumber();
        //$this->emitSelf('refresh');
    }

    public function deleteContent($id)
    {
        
        $content = ContentDraft::where('id', $id)->first();
        if(ContentDraft::where('course_id', $this->courseId)->where('position', $content->position+1)->first())
        {
            $nextpositionId = ContentDraft::where('course_id', $this->courseId)->where('position', $content->position+1)->first()->id;
        }
        else
        {
            $nextpositionId = ContentDraft::where('course_id', $this->courseId)->where('position', $content->position-1)->first()->id;
        }
    
        $position = $content->position;
        if($content && $position != 0)
        {
            if($content->type == "quiz")
            {
                $questions = QuestionDraft::where('content_id', $id )->get();
                
                foreach($questions as $question)
                {
                    $answers = AnswerDraft::where('question_id', $question->id)->get();
                    if($answers)
                    {
                        foreach($answers as $answer)
                        {
                            $answer->delete();
                        }
                    }
                    $question->delete();
                }   
                
                $content->delete();           
            }
            else{
                $content->delete();
            }
            $contents = ContentDraft::where('course_id', $this->courseId)->get();
            foreach($contents as $content)
            {
                if($content->position > $position)
                {
                    $content->position--;
                    $content->save();
                }
            }
            $this->contents = ContentDraft::where('course_id', $this->courseId)->orderBy('position','ASC')->get();
        }
        
        $this->emit('setPosition', $nextpositionId);
        $this->rstSectionNumber();
        $this->totalVideoDuration();
    }

    public function curlDeleteCFSVideo($uid)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.cloudflare.com/client/v4/accounts/'.env('CFS_ACCOUNT_ID').'/'.'stream/'. $uid);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');


        $headers = array();
        $headers[] = 'Authorization: Bearer '.env('CFS_BEARER_TOKEN').'';
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
    }

    public function setContentType($content_type)
    {
        $this->focused_content_type = $content_type;
        $this->rstSectionNumber();
    }

    public function totalVideoDuration()
    {
        $this->course_duration = 0;
        $contents = ContentDraft::where('course_id', $this->courseId)->get();
        foreach($contents as $content)
        {
            $this->course_duration += $content->video_duration;
        }
        if($this->course_duration > 600 && ContentDraft::where('id', $this->courseId)->first()->type == "free")
        {
            $this->emit('durationExceed', $this->course_duration);
        }
        $this->emitUp('durationExceed', $this->course_duration);
        $seconds = round($this->course_duration);
        return sprintf('%02d hrs %02d mins %02d seconds', ($seconds/ 3600),($seconds/ 60 % 60), $seconds% 60);        
    }
}
