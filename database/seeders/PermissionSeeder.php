<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //module-dashboard
        $moduleAppDashboard = Module::updateOrCreate([
            'name' => 'Admin Dashboard'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppDashboard->id,
            'name' => 'Access Dashboard',
            'slug' => 'app.dashboard',
        ]);
        $moduleAppRoles = Module::updateOrCreate([
            'name' => 'Role Management'
        ]);
        //role-module
        Permission::updateOrCreate([
            'module_id' => $moduleAppRoles->id,
            'name' => 'Access Role',
            'slug' => 'app.roles.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRoles->id,
            'name' => 'Create Role',
            'slug' => 'app.roles.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRoles->id,
            'name' => 'Edit Role',
            'slug' => 'app.roles.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRoles->id,
            'name' => 'Delete Role',
            'slug' => 'app.roles.destroy',
        ]);
        //user-module
        $moduleAppUsers = Module::updateOrCreate([
            'name' => 'User Management'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUsers->id,
            'name' => 'Access User',
            'slug' => 'app.users.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUsers->id,
            'name' => 'Create User',
            'slug' => 'app.users.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUsers->id,
            'name' => 'Edit User',
            'slug' => 'app.users.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUsers->id,
            'name' => 'Delete User',
            'slug' => 'app.users.destroy',
        ]);
        //backup-module
        $moduleAppBackups = Module::updateOrCreate([
            'name' => 'Backups'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBackups->id,
            'name' => 'Access Backup',
            'slug' => 'app.backups.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBackups->id,
            'name' => 'Create Backup',
            'slug' => 'app.backups.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBackups->id,
            'name' => 'Download Backup',
            'slug' => 'app.backups.download',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBackups->id,
            'name' => 'Delete Backup',
            'slug' => 'app.backups.destroy',
        ]);
        //page-module
        $modulePage = Module::updateOrCreate([
            'name' => 'Page'
        ]);
        Permission::updateOrCreate([
            'module_id' => $modulePage->id,
            'name' => 'Access Pages',
            'slug' => 'app.pages.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $modulePage->id,
            'name' => 'Create Page',
            'slug' => 'app.pages.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $modulePage->id,
            'name' => 'Edit Page',
            'slug' => 'app.pages.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $modulePage->id,
            'name' => 'Delete Page',
            'slug' => 'app.pages.destroy',
        ]);
    }
}
