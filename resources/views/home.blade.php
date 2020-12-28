@extends('layouts.app')

@section('title', 'Home Page')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/7.0.2/pusher.min.js"></script>
<script>
    Pusher.logToConsole = true;

    var pusher = new Pusher("0b12ee2b3fe81e7dda7f", {
        cluster: "eu",
        forceTLS: true
    });

    var channel = pusher.subscribe('post-commented-channel');

    channel.bind('comment-event', function(data) {
        var currentUser = {!! json_encode(auth()->user()->email) !!}
        
        if(data.email == currentUser) {
            alert(JSON.stringify(data.commentEmail));
        }
    });

</script>
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
                    <a href="{{ route('quote') }}" class="btn btn-secondary margin-create">Daily Quote</a>

                    <div class="container">
                        @foreach ($posts as $post)
                            <li class="list-group-item list-group-item-light">
                                <a href="{{ route('posts.show', ['post'=>$post]) }}" class="btn post-btn-home">{{ $post->post_title }}</a>
                            </li>
                        @endforeach
                    </div>
                    
                    <div class="paginate-center">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
