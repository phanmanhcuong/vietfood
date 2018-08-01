@extends ('layouts.app')

@section ('content')
    <h1>Like Ranking</h1>
    @include('posts.posts', ['posts' => $posts]);
@endsection