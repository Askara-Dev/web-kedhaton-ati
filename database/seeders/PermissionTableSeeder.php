<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;


class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authorities = config('permission.authorities');

        $listPermission = [];

        $superAdminPermissions = [];

        $adminPermissions = [];

        $editorPermission = [];

        foreach ($authorities as $label => $permissions) {

            foreach ($permissions as $permission) {

                $listPermission[] = [
                    'name' => $permission,
                    'guard_name' => 'web',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];

                // super admin permission
                $superAdminPermissions[] = $permission;

                // admin permission
                if (in_array($label, ['manage_posts', 'manage_categories', 'manage_tags'])) {
                    $adminPermissions[] = $permission;
                }

                // editorPermission
                if (in_array($label, ['manage_posts'])) {
                    $editorPermission[] = $permission;
                }
            }
        }

        // Insert Permission
        Permission::insert($listPermission);

        // Insert Role
        // Super admin
        $superAdmin = Role::create([
            'name' => 'SuperAdmin',
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        // admin
        $admin = Role::create([
            'name' => 'Admin',
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        // editor
        $editor = Role::create([
            'name' => 'Editor',
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $superAdmin->givePermissionTo($superAdminPermissions);
        $admin->givePermissionTo($adminPermissions);
        $editor->givePermissionTo($editorPermission);

        //assign user super admin

        $userSuperAdmin = User::find(1)->assignRole("SuperAdmin");

        // dd($listPermission);
        // dd('super admin', $superAdminPermission);
        // dd('admin', $adminPermission);
        // dd('editor', $editorPermission);
    }
}
