<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGroup extends Model
{
    use HasFactory;

    protected $fillable = ['study_program_id', 'academic_year_id', 'name'];

    public function studyProgram()
    {
        return $this->belongsTo(StudyProgram::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
