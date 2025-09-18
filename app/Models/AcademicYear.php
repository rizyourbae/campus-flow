<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'year',
        'semester',
        'is_active',
    ];

    /**
     * Get all of the schedules for the AcademicYear
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * Get all of the studentGroups for the AcademicYear
     */
    public function studentGroups()
    {
        return $this->hasMany(StudentGroup::class);
    }
}
