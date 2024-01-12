@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>

    <p>{!! $post->content !!}</p>

    <h4>Posted by: {{ $post->author->name }} on {{ $post->created_at->format('M d, Y') }}</h4>

    @auth
    <button class="btn btn-primary" onclick="likePost({{ $post->id }})">Like</button>
    @endauth
    <h5>Comments:</h5>
    <ul>
        @foreach ($post->comments as $comment)
        <li data-comment-id="{{ $comment->id }}">
            <strong>{{ $comment->author->name }}</strong>: {{ $comment->content }}
            @auth
            <button class="btn btn-sm btn-secondary" onclick="replyToComment({{ $comment->id }})">Reply</button>
            @endauth

            <ul class="list-unstyled">
                @foreach ($comment->replies->sortByDesc('created_at') as $reply)
                <li>
                    <strong>{{ $reply->author->name }}</strong>: {{ $reply->content }}
                </li>
                @endforeach
            </ul>
        </li>
        @endforeach
    </ul>

    @auth
    <hr>
    <h4>Leave a Comment:</h4>
    <form action="{{ route('comment.store') }}" method="post">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <div class="form-group">
            <label for="content">Comment</label>
            <textarea name="content" id="content" class="form-control" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    @endauth
</div>

<script>
    function likePost(postId) {
        event.preventDefault();

        fetch(`/posts/${postId}/like`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const likeCountElement = document.querySelector(`#like-count[data-post-id="${postId}"]`);
                likeCountElement.textContent = parseInt(likeCountElement.textContent) + 1;
            } else {
                console.error('Error liking post:', data.message);
            }
        })
        .catch(error => {
            console.error('Network error:', error);
        });
    }

    function replyToComment(commentId) {
        const replyForm = document.createElement('form');
        replyForm.action = `/comments/${commentId}/replies`;
        replyForm.method = 'POST';
        replyForm.innerHTML = `
            @csrf
            <div class="form-group">
                <label for="reply-content">Your reply:</label>
                <textarea name="content" id="reply-content" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Reply</button>
        `;

        const commentElement = document.querySelector(`li[data-comment-id="${commentId}"]`);
        commentElement.appendChild(replyForm);
    }
</script>
@endsection