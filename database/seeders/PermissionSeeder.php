<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
    //     // Reset cached roles and permissions
    //     app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

    //     //create permissions
    //     Permission::create(['name' => 'Manage Payment']);
    //     Permission::create(['name' => 'Manage Order']);



    //       // Create the "cashier" role
    //     $cashierRole = Role::create(['name' => 'cashier']);


    //     // Assign the "cashier" role to the user with ID 1 (assuming user ID 1 is the cashier)
    // $user = User::find(1);
    // $user->assignRole($cashierRole);
    // if ($user->hasRole('cashier')) {
    //     // The user has the "cashier" role
    // }
    
    }
    
}
