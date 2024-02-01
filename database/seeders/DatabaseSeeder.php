<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Insert default admin user
        // DB::table('users')->insert([
        //     'first_name' => 'Admin',
        //     'last_name' => 'Super',
        //     'email' => 'superadmin@khgc.com',
        //     'password' => bcrypt('Abcd@1234'),
        //     'role' => 'admin',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        // $adminRole = Role::create(['name' => 'admin']);
        // $userRole = Role::create(['name' => 'user']);

        // //admin
        // $manageAllPostsPermission = Permission::create(['name' => 'manage_all_posts']);
        // $manageUserAccountsPermission = Permission::create(['name' => 'manage_user_accounts']);
        // //user
        // $managePostsPermission = Permission::create(['name' => 'manage_posts']);


        // $adminRole->givePermissionTo($manageAllPostsPermission, $manageUserAccountsPermission);

        // $userRole->givePermissionTo($managePostsPermission);


       $usersWithUserRole = User::where('role', 'user')->get();
       foreach ($usersWithUserRole as $user) {
           $user->assignRole('user');
       }

       // Gán vai trò cho người dùng có vai trò là "admin"
       $usersWithAdminRole = User::where('role', 'admin')->get();
       foreach ($usersWithAdminRole as $user) {
           $user->assignRole('admin');
       }
    }

}
