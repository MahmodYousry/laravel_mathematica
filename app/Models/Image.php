<?php

namespace App\Models;

use App\Models\My_Parent;
use App\Models\Nationality;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    public $fillable = ['filename', 'imageable_id', 'imageable_type'];

    public function imageable()
    {
        return $this->morphTo();
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }

    public function myparent()
    {
        return $this->belongsTo(My_Parent::class, 'parent_id');
    }
}
