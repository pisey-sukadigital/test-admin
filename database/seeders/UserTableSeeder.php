<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'Agent']);
        $permissions = Permission::pluck('id','id')->first();
        $role->syncPermissions($permissions);

        for($i = 1 ; $i <= 20 ; $i++){
            $username = "user_".$i;
            $email = $username."@gmail.com";
            $user = User::create([
                'name' => $username,
                'username' => $username,
                'email' => $email,
                'password' => bcrypt('12345678')
            ]);
            $user->assignRole([$role->id]);
        }
    }
}