<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerDraft extends Model
{
    use HasFactory;

    public function questionDraft()
    {
        return $this->belongsTo(QuestionDraft::class, 'question_id');
    }
}
