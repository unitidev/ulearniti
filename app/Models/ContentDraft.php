<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentDraft extends Model
{
    use HasFactory;
    protected $fillable = ['type', 'title', 'position', 'filename', 'uid', 'video_duration'];

    public function courseDraft()
    {
        return $this->belongsTo(CourseDraft::class, 'course_id');
    }
}
