<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $v5 = Permission::create(['name' => 'View Dashboard']);
        $v5->assignRole(Role::find(1));
        
        $v = Permission::create(['name' => 'View Products']);
        $v->assignRole(Role::find(1));
        $v2 = Permission::create(['name' => 'Create Product']);
        $v2->assignRole(Role::find(1));
        $v3 = Permission::create(['name' => 'Edit Product']);
        $v3->assignRole(Role::find(1));
        $v4 = Permission::create(['name' => 'Delete Product']);
        $v4->assignRole(Role::find(1));
    }
}
