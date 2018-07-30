@if (Auth::user()->is_like($post->id))
    {!! Form::open(['route' => ['user_like.unlike', $post->id], 'method' => 'delete']) !!}
        {!! Form::submit('Unlike', ['class' => 'btn btn-danger btn-block']) !!}
    {!! Form::close() !!}
@else
    {!! Form::open(['route' => ['user_like.like', $post->id]]) !!}
        {!! Form::submit('Like', ['class' => 'btn btn-primary btn-block']) !!}
    {!! Form::close() !!}
@endif