<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Grade extends Model
{
    use HasTranslations;
    public $translatable = ['name'];

    use HasFactory;
    protected $fillable = ['name', 'notes'];

}
