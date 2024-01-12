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

    @auth
    <hr>
    <h4>Leave a Comment:</h4>
    <form action="{{ route('comment.store', ['postId' => $post->id]) }}" method="post">
        @csrf
        <div class="form-group">
            <label for="content">Comment</label>
            <textarea name="content" id="content" class="form-control" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    @endauth

    <hr>
    @endforeach
</div>
@endsection