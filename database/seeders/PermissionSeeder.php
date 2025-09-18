<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB; // Import DB Facade

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cache permission
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Hapus semua data lama untuk memastikan kebersihan data
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();
        Permission::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Definisikan semua resource kita
        $resources = ['User', 'Role', 'Schedule', 'Lecturer', 'Course', 'Room', 'StudyProgram', 'StudentGroup', 'AcademicYear', 'LandingPageContent'];

        // Buat permission untuk setiap resource (view_any, view, create, update, delete)
        foreach ($resources as $resource) {
            Permission::create(['name' => 'view_any_' . strtolower($resource)]);
            Permission::create(['name' => 'view_' . strtolower($resource)]);
            Permission::create(['name' => 'create_' . strtolower($resource)]);
            Permission::create(['name' => 'update_' . strtolower($resource)]);
            Permission::create(['name' => 'delete_' . strtolower($resource)]);
        }

        // Buat Role Super Admin
        $superAdminRole = Role::create(['name' => 'Super Admin']); // Pakai spasi biar lebih rapi
        // Super Admin dapat semua permission
        $superAdminRole->givePermissionTo(Permission::all());

        // Buat atau update User Super Admin
        // Ini akan mencari user dengan email tsb, jika tidak ada akan dibuat baru
        $superAdminUser = User::updateOrCreate(
            ['email' => 'superadmin@kampusflow.test'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password'), // Gunakan bcrypt() atau Hash::make()
                'is_admin' => true,
            ]
        );
        $superAdminUser->assignRole($superAdminRole);
    }
}
