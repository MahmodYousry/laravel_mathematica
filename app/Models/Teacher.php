<?php

namespace App\Models;

use App\Models\Gender;
use App\Models\Section;
use App\Models\Specialization;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Model
{
    use HasTranslations;
    public $translatable = ['Name'];

    use HasFactory;
    protected $guarded = [];


    public function specializations() {
        return $this->belongsTo(Specialization::class, 'Specialization_id');
    }

    public function genders() {
        return $this->belongsTo(Gender::class, 'Gender_id');
    }

    public function sections() {
        return $this->belongsToMany(Section::class, 'teacher_section');
    }


}
