@extends('layouts.app')

@section('title', 'Show Post')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Comments:') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('posts.store') }}">
                        @csrf
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Post Title: </span>
                            </div>
                            <input class="form-control" aria-label="With textarea" type="text" 
                                name="post_title" value="{{ old('post_title') }}"/>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Post Body:</span>
                            </div>
                            <input class="form-control" aria-label="With textarea" type="text" 
                                name="post_body" value="{{ old('post_body') }}"/>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Post Body:</span>
                            </div>
                            <select class="form-control custom-select-lg" name="tag_id">
                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}">{{$tag->taggable->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="submit" value="Submit" class="btn btn-primary">
                        <a href="{{ route('home') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection