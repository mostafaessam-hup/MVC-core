<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {

        User::create([
            'password' => bcrypt('123@Ahmed'),
            'name' => 'hamada',
            'email' => 'hack@zipe.com',
            'phone' => '01067214731',
        ]);

        Admin::create([
            'password' => ('123@Ahmed'),
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'phone' => '01067214731',
            'status' => 1,
        ]);

        // DB::statement('ALTER TABLE permissions DISABLE TRIGGER ALL');
        // DB::statement('TRUNCATE table permissions');
        // DB::statement('ALTER TABLE permissions ENABLE TRIGGER ALL');
        // DB::statement('TRUNCATE TABLE permissions CASCADE');


        // $base_path = base_path() . '/core';
        // foreach (glob($base_path . '/*/Permissions.php') as $file) {
        //     require_once $file;
        // }

        // $role = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'admin-api']);
        // $permissions = Permission::all();
        // $role->syncPermissions($permissions);
        // $admin = Admin::first();
        // $admin->assignRole('super_admin');
    }
}
