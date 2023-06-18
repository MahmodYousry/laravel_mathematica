<?php

namespace App\Models;

use App\Models\Grade;
use App\Models\Gender;
use App\Models\Section;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name'];
    protected $guarded = [];


    public function gender() {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function grade() {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function classroom() {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

    public function section() {
        return $this->belongsTo(Section::class, 'section_id');
    }

}
