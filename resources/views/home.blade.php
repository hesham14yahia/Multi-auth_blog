@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach($posts as $post)
                <h1>{{ $post->title }}</h1>
                <small>Written on Day: {{ $post->created_at->toDateString() }} Time: {{ $post->created_at->format('h:m') }} by {{ $post->admin->name }}</small>
                <a href="/viewpost/{{ $post->id }}" class="btn btn-info" style="margin-left:20px">Show</a>
                <hr>
            @endforeach
        </div>
    </div>
</div>
@endsection
