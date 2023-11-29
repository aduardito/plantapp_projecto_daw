<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

# php artisan db:seed PermissionTableSeeder

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'plant-list',
            'plant-create',
            'plant-edit',
            'plant-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete'
        ];
         
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        $role = Role::findByName('Admin');

        foreach($permissions as $permission){
            $role->givePermissionTo($permission);
        }
    }
}