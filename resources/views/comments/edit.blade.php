@extends('layouts.app')

@section('title', 'Edit Comment')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Comment:') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('comments.update') }}">
                        @csrf
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Comment Body: </span>
                            </div>
                            <input class="form-control" aria-label="With textarea" type="text" 
                                name="comment_body" value="{{ $comment->comment_body }}"/>
                        </div>
                        <input class="form-control" aria-label="With textarea" type="hidden" 
                            name="post_id" value="{{ $comment->post_id }}"/>
                        <input class="form-control" aria-label="With textarea" type="hidden" 
                            name="comment_id" value="{{ $comment->id }}"/>
                        <input type="submit" value="Submit" class="btn btn-primary">
                        <a href="{{ route('posts.show', ['post' => $comment->post_id]) }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
