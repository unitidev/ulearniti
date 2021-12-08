<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'subtitle', 'type', 'language', 'level', 'category', 'subcategory', 'description', 'target', 'outcome', 'requirement', 'course_image', 'promotional_video', 'price', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
