<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'capacity',
    ];

    /**
     * Get all of the schedules for the Room
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
