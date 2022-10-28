<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table = 'course';
    public $timestamps = false;
    protected $fillable = [ 'c_name', 'cat_name', 'c_description', 'c_teacher','c_video' ];
}
