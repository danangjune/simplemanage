@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $post->title }}</h2>
    <p>{{ $post->content }}</p>
    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back to Posts</a>
</div>
@endsection
