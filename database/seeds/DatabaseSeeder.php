<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            GameWeaponSeeder::class,
            GameModeSeeder::class,
            GameSeeder::class,
            TagSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
            UpvoteSeeder::class,
            DownvoteSeeder::class,
        ]);
    }
}
