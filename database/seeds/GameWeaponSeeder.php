<?php

use App\Models\GameWeapon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameWeaponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $assaultRifle = 'Assault Rifle';
        $submachineGun = 'Submachine Gun';
        $lightmachineGun = 'Lightmachine Gun';
        $sniperRifle = 'Sniper Rifle';
        $marksmanRifle = 'Marksman Rifle';
        $shotgun = 'Shotgun';

        DB::table('game_weapons')->insert([
            'weapon_name' => 'Kilo',
            'weapon_type' => $assaultRifle
        ]);

        DB::table('game_weapons')->insert([
            'weapon_name' => 'Amax',
            'weapon_type' => $assaultRifle
        ]);

        DB::table('game_weapons')->insert([
            'weapon_name' => 'AK-47',
            'weapon_type' => $assaultRifle
        ]);

        DB::table('game_weapons')->insert([
            'weapon_name' => 'MP5',
            'weapon_type' => $submachineGun
        ]);
    
        DB::table('game_weapons')->insert([
            'weapon_name' => 'UZI',
            'weapon_type' => $submachineGun
        ]);

        DB::table('game_weapons')->insert([
            'weapon_name' => 'HDR',
            'weapon_type' => $sniperRifle
        ]);

        DB::table('game_weapons')->insert([
            'weapon_name' => 'M91',
            'weapon_type' => $lightmachineGun
        ]);

        DB::table('game_weapons')->insert([
            'weapon_name' => 'Origin',
            'weapon_type' => $shotgun
        ]);

        DB::table('game_weapons')->insert([
            'weapon_name' => 'Kar',
            'weapon_type' => $marksmanRifle
        ]);

        DB::table('game_weapons')->insert([
            'weapon_name' => 'MX4',
            'weapon_type' => $assaultRifle
        ]);

        DB::table('game_weapons')->insert([
            'weapon_name' => 'AK-74u',
            'weapon_type' => $assaultRifle
        ]);

    }
}
