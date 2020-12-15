<?php

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('roles')->insert([
            'role_type' => 'Admin',
            'role_description' => 'This is the user role with full access to manipulating everything within the app.'
        ]);

        DB::table('roles')->insert([
            'role_type' => 'Standard',
            'role_description' => 'This is the user role which restricts users to editing their content only.'
        ]);
        
    }
}
