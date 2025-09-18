<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'academic_year_id',
        'lecturer_id',
        'course_id',
        'room_id',
        'student_group_id',
        'day_of_week',
        'start_time',
        'end_time',
    ];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function studentGroup()
    {
        return $this->belongsTo(StudentGroup::class);
    }
}
