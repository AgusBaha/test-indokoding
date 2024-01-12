@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($post as $post)
    <h1>{{ $post->title }}</h1>

    <p>{!! $post->content !!}</p>

    <h4>Posted by: {{ $post->author->name }} on {{ $post->created_at->format('M d, Y') }}</h4>

    <h5>Comments:</h5>
    <ul>
        @foreach ($post->comments as $comment)
        <li>
            <strong>{{ $comment->author->name }}</strong>: {{ $comment->content }}
        </li>
        @endforeach
    </ul>
    @endforeach
</div>
@endsection