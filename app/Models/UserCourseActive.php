<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourseActive extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'user_course_active';
    protected $fillable =  ['username','c_id','status'];
}
