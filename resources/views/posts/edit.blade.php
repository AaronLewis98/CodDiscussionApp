@extends('layouts.app')

@section('title', 'Edit Post')
@section('content')
    <form method="POST" action="{{ route('posts.update') }}">
        @csrf
        <p>Post Title: <input type="text" name="post_title" value="{{ $post->post_title }}"></p>
        <p>Post Body: <input type="text" name="post_body" value="{{ $post->post_body }}"></p>
        <input type="hidden" name="post_id" value="{{ $post->id }}"/>
        <p>Tag: 
            <select class="form-control" name="tag_id" style="width:250px">
                @foreach($tags as $tag)
                    <option value="{{$tag->id}}">{{$tag->taggable->name}}</option>
                @endforeach
            </select>
        </p>
        <input type="submit" value="Submit">
        <a href="{{ route('posts.show', ['post' => $post]) }}">Cancel</a>
    </form>
@endsection