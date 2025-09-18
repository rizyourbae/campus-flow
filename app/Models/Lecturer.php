<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    use HasFactory;

    protected $fillable = ['study_program_id', 'name', 'nip', 'email'];

    public function studyProgram()
    {
        return $this->belongsTo(StudyProgram::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
