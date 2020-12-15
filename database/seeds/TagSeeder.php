<?php

use App\Models\Game;
use App\Models\GameMode;
use App\Models\GameWeapon;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($index = 1; $index <= GameMode::get()->count(); $index++) {
            DB::table('tags')->insert([
                'taggable_id' => $index,
                'taggable_type' => GameMode::class
            ]);
        }

        for($index = 1; $index <= GameWeapon::get()->count(); $index++) {
            DB::table('tags')->insert([
                'taggable_id' => $index,
                'taggable_type' => GameWeapon::class
            ]);
        }

        for($index = 1; $index <= Game::get()->count(); $index++) {
            DB::table('tags')->insert([
                'taggable_id' => $index,
                'taggable_type' => Game::class
            ]);
        }

    }
}
