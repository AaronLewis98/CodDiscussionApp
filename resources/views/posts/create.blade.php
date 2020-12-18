@extends('layouts.app')

@section('title', 'Show Post')
@section('content')
    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <p>Post Title: <input type="text" name="post_title" value="{{ old('post_title') }}"></p>
        <p>Post Body: <input type="text" name="post_body" value="{{ old('post_body') }}"></p>
        <input type="submit" value="Submit">
        <a href="{{ route('home') }}">Cancel</a>
    </form>
@endsection