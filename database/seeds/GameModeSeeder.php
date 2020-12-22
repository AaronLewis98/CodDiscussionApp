<?php

use App\Models\GameMode;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('game_modes')->insert([
            'name' => 'Domination',
            'mode_description' => 'Capture flags and hold them to dominate the game.'
        ]);

        DB::table('game_modes')->insert([
            'name' => 'Team Deathmatch',
            'mode_description' => 'Get the most eliminations to win the game.'
        ]);

        DB::table('game_modes')->insert([
            'name' => 'Free For All',
            'mode_description' => 'Solo elimination game.'
        ]);

        DB::table('game_modes')->insert([
            'name' => 'Capture The Flag',
            'mode_description' => 'Collect flags and return to team capture point.'
        ]);

        DB::table('game_modes')->insert([
            'name' => 'Demolition',
            'mode_description' => 'Attack and defend bomb zones in alternating rounds.'
        ]);

        DB::table('game_modes')->insert([
            'name' => 'Search And Destroy',
            'mode_description' => 'Single life per round to defend and attack bomb zones.'
        ]);
    }
}
