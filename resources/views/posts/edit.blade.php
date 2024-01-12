@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Post - {{ $post->title }}</h1>
    <form action="{{ route('posts.update', $post) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}">
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" id="content" class="form-control" rows="10">{{ $post->content }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection