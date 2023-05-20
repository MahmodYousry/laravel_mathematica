<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classroom extends Model
{
    use HasTranslations;
    public $translatable = ['class_name'];

    use HasFactory;
    protected $fillable = ['class_name', 'grade_id'];


    public function grades() {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

}

