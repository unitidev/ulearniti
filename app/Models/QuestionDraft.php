<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionDraft extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'type'];

    public function contentDraft()
    {
        return $this->belongsTo(CourseDraft::class, 'content_id');
    }
}
