<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $adminRole = Role::where('role_type', 'Admin')->first();
        $standardRole = Role::where('role_type', 'Standard')->first();

        $defaultUser = User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'date_of_birth' => '1998-05-29',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Admin1'),
            'profile_image' => 'userImage.jpg',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10)
        ]);

        $defaultUser->roles()->attach($adminRole);
        $defaultUser->roles()->attach($standardRole);

        factory(User::class, 50)->create()->each(function ($user) {
            $user->save();
            $user->roles()->attach(2);
        });
    }
}
