<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseDraft extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'subtitle', 'type', 'language', 'level', 'category', 'subcategory', 'description', 'target', 'outcome', 'requirement', 'course_image', 'promotional_video', 'price', 'status'];

    public function getContentDraft()
    {
        return $this->hasMany(ContentDraft::class, 'course_id');
    }
}
