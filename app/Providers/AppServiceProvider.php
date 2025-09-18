<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate; // <-- 1. Import Gate
use App\Models; // <-- Import folder Models
use App\Policies; // <-- Import folder Policies

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(\Spatie\Permission\Models\Role::class, Policies\RolePolicy::class);
        Gate::policy(Models\User::class, Policies\UserPolicy::class);
        Gate::policy(Models\Schedule::class, Policies\SchedulePolicy::class);
        Gate::policy(Models\LandingPageContent::class, Policies\LandingPageContentPolicy::class);
        Gate::policy(Models\Lecturer::class, Policies\LecturerPolicy::class);
        Gate::policy(Models\Course::class, Policies\CoursePolicy::class);
        Gate::policy(Models\Room::class, Policies\RoomPolicy::class);
        Gate::policy(Models\StudyProgram::class, Policies\StudyProgramPolicy::class);
        Gate::policy(Models\StudentGroup::class, Policies\StudentGroupPolicy::class);
        Gate::policy(Models\AcademicYear::class, Policies\AcademicYearPolicy::class);
    }
}
