<?php

namespace App\Models;

use App\Models\Section;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Grade extends Model
{
    use HasTranslations;
    public $translatable = ['name'];

    use HasFactory;
    protected $fillable = ['name', 'notes'];

    // علاقة المراحل الدراسية لجلب الاقسام المتعلقة بكل مرحلة
    public function sections()
    {
        return $this->hasMany(Section::class, 'grade_id');
    }

}
