<?php

use App\Models\Game;
use App\Models\GameMode;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modernWarfare = Game::create([
            'game_title' => 'Modern Warfare',
            'date_of_release' => '2019-11-10',
            'age_restriction' => '18',
        ]);

        $modernWarfare->gameWeapons()->attach([1,2,3,4,5,6,7,8,9]);
        $modernWarfare->gameModes()->attach(GameMode::all());
       

        $coldWar = Game::create([
            'game_title' => 'Cold War',
            'date_of_release' => '2020-11-13',
            'age_restriction' => '18',
        ]);
       
        $coldWar->gameWeapons()->attach([3,4,5,10,11]);
        $coldWar->gameModes()->attach(GameMode::all());

    }
}
