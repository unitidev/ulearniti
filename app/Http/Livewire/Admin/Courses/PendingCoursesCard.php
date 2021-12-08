<?php

namespace App\Http\Livewire\Admin\Courses;

use Livewire\Component;
use App\Models\CourseDraft;
use App\Models\Course;
use App\Models\ContentDraft;
use App\Models\Content;
use App\Models\QuestionDraft;
use App\Models\Question;
use App\Models\AnswerDraft;
use App\Models\Answer;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PendingCoursesCard extends Component
{
    public $course_id, $course, $user;

    public function render()
    {
        return view('livewire.admin.courses.pending-courses-card');
    }

    public function mount($course_id)
    {
        $this->course_id = $course_id;
        $this->course = CourseDraft::find($course_id);
        $this->user = User::find($this->course->user_id);
    }

    public function getUpdatedAt($time)
    {
        $past = Carbon::parse($time);

        return $past->diffForHumans();
    }

    public function getImage($courseImage)
    {
        if($courseImage)
        {
            return Storage::disk('s3')->temporaryUrl($courseImage, now()->addMinutes(1));
        }
        else
        {   return null; }
    }

    public function totalVideoDuration($courseId)
    {
        $course_duration = 0;
        $contents = ContentDraft::where('course_id', $courseId)->get();
        foreach($contents as $content)
        {
            $course_duration += $content->video_duration;
        }
        
        $seconds = round($course_duration);
        return sprintf('%02d hr %02d min ', ($seconds/ 3600),($seconds/ 60 % 60));        
    }

    public function totalSection($courseId)
    {
        $number_of_section = 0;
        $contents = ContentDraft::where('course_id', $courseId)->get();
        foreach($contents as $content)
        {
            if($content->type == "section")
            {   $number_of_section ++;  }
        }

        return $number_of_section;
    }

    public function totalVideo($courseId)
    {
        $number_of_video = 0;
        $contents = ContentDraft::where('course_id', $courseId)->get();
        foreach($contents as $content)
        {
            if($content->type == "video")
            {   $number_of_video ++;  }
        }

        return $number_of_video;
    }

    public function totalQuiz($courseId)
    {
        $number_of_quiz = 0;
        $contents = ContentDraft::where('course_id', $courseId)->get();
        foreach($contents as $content)
        {
            if($content->type == "quiz")
            {   $number_of_quiz ++;  }
        }

        return $number_of_quiz;
    }

    public function approveCourse()
    {
        $course_draft = CourseDraft::find($this->course_id);  //get course draft
        
        $data['course'] = $course_draft->fill([
            'status' => 'published',
        ])->toArray();                                        //convert to array

        $data['course']['created_at'] = Carbon::now()->format('Y-m-d h:i:s');       //reassigned timestamp
        $data['course']['updated_at'] = Carbon::now()->format('Y-m-d h:i:s');       //reassigned timestamp

        //dd($data['course']);
        DB::table('courses')->insert($data['course']);

        $course_draft->update(['status' => 'published']);

        $content_drafts = ContentDraft::whereBelongsTo($course_draft)->get();
        foreach($content_drafts as $content)
        {
            $data['content'.$content->id] = $content->toArray();
            $data['content'.$content->id]['created_at'] = Carbon::now()->format('Y-m-d h:i:s');
            $data['content'.$content->id]['updated_at'] = Carbon::now()->format('Y-m-d h:i:s');
            DB::table('contents')->insert($data['content'.$content->id]);

            $question_drafts = QuestionDraft::whereBelongsTo($content)->get();
            foreach($question_drafts as $question)
            {
                $data['question'.$question->id] = $question->toArray();
                $data['question'.$question->id]['created_at'] = Carbon::now()->format('Y-m-d h:i:s');
                $data['question'.$question->id]['updated_at'] = Carbon::now()->format('Y-m-d h:i:s');
                DB::table('questions')->insert($data['question'.$question->id]);

                $answer_drafts = AnswerDraft::whereBelongsTo($question)->get();
                foreach($answer_drafts as $answer)
                {
                    $data['answer'.$answer->id] = $answer->toArray();
                    $data['answer'.$answer->id]['created_at'] = Carbon::now()->format('Y-m-d h:i:s');
                    $data['answer'.$answer->id]['updated_at'] = Carbon::now()->format('Y-m-d h:i:s');
                    DB::table('answers')->insert($data['answer'.$answer->id]);
                }
            }
        }
        //dd($data);
        $this->emitUp('remountPendingCourses');    
        $this->emitUp('remountPublishedCourses');  
    }

    public function rejectCourse()
    {
        $course_draft = CourseDraft::find($this->course_id)->update(['status' => 'rejected']);
        $this->emitUp('remountPendingCourses');    
    }
}
