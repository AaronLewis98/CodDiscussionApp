@extends('layouts.app')

@section('title', 'Quote Of The Day')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Quote Of The Day!') }}</div>
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-light">"{{ $quote }}"</li>
                            <li class="list-group-item list-group-item-light">Author: {{ $author }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection