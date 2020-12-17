@extends('layouts.app')

@section('title', 'Show Post')
@section('content')
    <ul>
        <li>Title: {{ $post->post_title}}</li>
        <li>IMAGE TO GO HERE</li>
        <li>{{$post->post_body}}</li>
        <li>Posted By: {{ $postedBy->first_name." ".$postedBy->last_name}}</li>
        <li>Tags:</li>
        @foreach ($tags as $tag) 
            <li>{{ $tag->taggable->mode_title }}</li>   
        @endforeach
    </ul>

    @foreach ($post->comments()->get() as $comment) 
        <ul>
            <li>{{ $comment->comment_body }}</li>
            <li>Commented By: {{ $comment->user->first_name." ".$comment->user->last_name }}</li>
        </ul>
    @endforeach
@endsection