<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyProgram extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code'];

    public function lecturers()
    {
        return $this->hasMany(Lecturer::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function studentGroups()
    {
        return $this->hasMany(StudentGroup::class);
    }
}
