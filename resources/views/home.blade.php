@extends('layouts.app')

@section('title', 'Home Page')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Posts') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ route('posts.create') }}" class="btn btn-secondary margin-create">Create Post</a>

                    <div class="container">
                        @foreach ($posts as $post)
                            <li class="list-group-item list-group-item-light">
                                <a href="{{ route('posts.show', ['post'=>$post]) }}" class="btn btn-light">{{ $post->post_title }}</a>
                            </li>
                        @endforeach
                    </div>
                    
                    <div class="container">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
