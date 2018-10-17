@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <a href="/home" class="btn btn-info">Go Back</a>
                <br>
                <br>
                <h1>{{ $post->title }}</h1>
                <br>
                <div>
                    {!! $post->body !!}
                </div>
                <hr>
                <small>Written on {{ $post->created_at }} by {{ $post->admin->name }}</small>
                <hr>
                <small>
                    @if($like_exist)
                    Like
                    @else
                    <a href="/like/{{ $post->id }}">Like</a>
                    @endif
                    {{ $post->likes }} || 
                    @if($dislike_exist)
                    Dislike
                    @else
                    <a href="/dislike/{{ $post->id }}">Dislike</a>
                    @endif
                    {{ $post->dislikes }}
                    </small>
                <hr>
                <small>View count {{ $post->views_count }} </small>
                <hr>
        </div>
    </div>
</div>
@endsection
