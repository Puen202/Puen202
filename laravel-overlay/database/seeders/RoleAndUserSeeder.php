<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndUserSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'machines.view','machines.create','machines.edit','machines.delete',
            'map.view','map.edit','imports.run','ranges.manage','audit.view',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $calidad = Role::firstOrCreate(['name' => 'calidad']);
        $visor = Role::firstOrCreate(['name' => 'visor']);

        $admin->syncPermissions($permissions);
        $calidad->syncPermissions(['machines.view','machines.create','machines.edit','map.view','map.edit','imports.run']);
        $visor->syncPermissions(['machines.view','map.view']);

        $adminUser = User::firstOrCreate(
            ['email' => env('SEED_ADMIN_EMAIL', 'admin@itv.local')],
            ['name' => 'Admin ITV', 'password' => env('SEED_ADMIN_PASSWORD', 'admin12345')]
        );

        $adminUser->syncRoles([$admin]);
    }
}
