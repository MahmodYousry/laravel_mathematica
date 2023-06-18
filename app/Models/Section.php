<?php

namespace App\Models;

use App\Models\Teacher;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasTranslations;
    public $translatable = ['section_name'];

    use HasFactory;
    protected $fillable=['section_name', 'grade_id', 'class_id'];

    // علاقة بين الاقسام والصفوف لجلب اسم الصف في جدول الاقسام
    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_section');
    }

}
