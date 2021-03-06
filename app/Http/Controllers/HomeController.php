<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance and apply auth middleware.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard with paginated data.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::paginate(7);
        return view('home', ['posts' => $posts]);
    }

    /**
     * Show the game view.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function game()
    {
        $games = Game::get();

        return view('game', ['games' => $games]);
    }
}
