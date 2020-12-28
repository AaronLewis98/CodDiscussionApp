@extends('layouts.app')

@section('title', 'Games')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Games') }}</div>
                    @foreach ($games as $game)
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-light">Game Title:
                                {{ $game->name }}
                            </li>
                            <li class="list-group-item list-group-item-light">Game Modes:
                                @foreach ($game->gameModes as $mode)
                                    {{ $mode->name }}
                                @endforeach
                            </li>
                            <li class="list-group-item list-group-item-light">Game Weapons: 
                                @foreach ($game->gameWeapons as $weapon)
                                    {{ $weapon->name }}
                                @endforeach
                            </li>
                        </ul>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection