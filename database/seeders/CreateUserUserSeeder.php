<?php

namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateUserUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $role2 = Role::create(['name' => 'user']);
        $role2 = Role::where('name', 'user')->first();
        $users = User::all();
        foreach($users as $user){
            if ($user->email != 'admin@gmail.com' && $user->email != 'admin_2@gmail.com'){
                $user->assignRole($role2);
            }
        }
    }
}
