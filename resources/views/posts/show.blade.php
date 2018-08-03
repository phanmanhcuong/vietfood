@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6 col-sm-8 col-xs-12 col-md-offset-2">
            <div class="post-image">
                <div class="panel panel-default">
                    <div class="panel panel-heading text-center">
                        <img src="{{ $post->image_url }}" width="100%" height="100%" alt=""></img>
                    </div>
                    
                    @if (isset($post->like_count))
                        <?php $like_number = $post->like_count ?>
                    @else
                        <?php $like_number = 0 ?>
                    @endif
                    
                    <div class="like-number">
                        <p class="text-center">{{ $like_number }} Likes</p>
                    </div>
                    
                    <div class="panel panel-body buttons text-center">
                        @if (Auth::check())
                            @include('posts.like_button', ['post' => $post])
                        @endif
                        
                    </div>
                </div>
            
                @if (count($comments) > 0)
                    <div class="panel panel-default">
                        <div class="panel panel-heading text-center">
                            <p>Comments</p>
                        </div>
                        <div class="panel panel-body comment-content">
                            @foreach ($comments as $comment)
                                @if ($comment->avatar_url != null)
                                    <img src="{{ $comment->avatar_url}}" width="20px" height="20px"></img> 
                                @else
                                    <img src="{{ Gravatar::src($comment->email, 20) }}" alt="">
                                @endif
                                
                                <a href="{{ route('users.show_posts', $comment->user_id) }}">{{ $comment->user_name }}</a>
                                {{ ($comment->content) }}<p></p>
                            @endforeach
                            
                        </div>
                    </div>        
                @endif
                
            </div>
        </div>
        
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="post-writer">
                <div class="panel panel-default">
                    <div class="panel panel-heading text-center">
                        Writer
                    </div>
                    <div class="panel panel-body">
                        <a href="{{ route('users.show_posts', $post->user_id) }}">{{ $post->user_name }}</a>
                    </div>
                </div>
            </div>
            
            <div class="post-title">
                <div class="panel panel-default">
                    <div class="panel panel-heading text-center">
                        Title
                    </div>
                    <div class="panel panel-body">
                        {{ $post->title }}
                    </div>
                </div>
            </div>
            
            <div class="post-content">
                <div class="panel panel-default">
                    <div class="panel panel-heading text-center">
                        Content
                    </div>
                    <div class="panel panel-body">
                        {{ nl2br(e($post->content)) }}
                    </div>
                </div>
            </div>
            
            <div class="post-restaurant_name">
                <div class="panel panel-default">
                    <div class="panel panel-heading text-center">
                        Restaurant
                    </div>
                    <div class="panel panel-body">
                        {{ $post->restaurant_name }}
                    </div>
                </div>
            </div>
                      
            @if (Auth::id() == $post->user_id)
                <div class="buttons-showview">
                    {!! link_to_route('posts.edit', 'Edit Post', ['id' => $post->id], ['class' => 'btn btn-success']) !!}
                            
                    {!! Form::model($post, ['route' => ['posts.destroy', $post->id], 'method' => 'delete', 'style' => 'display:inline-block']) !!}  
                        {!! Form::submit('Delete Post', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </div>
            @endif
            
            @if (Auth::check())
                <div class="comment-form">
                    {!! Form::open(['route' => ['comments.create', Auth::id(), $post->id]]) !!}
                        <div class="form-group">
                            {!! Form::label('content', 'Write Comment') !!}
                            {!! Form::text('content', old('content'), ['class' => 'form-control']) !!}
                       </div>
                        
                        {!! Form::submit('Comment', ['class' => 'btn btn-primary btn-block']) !!}
                    {!! Form::close() !!}
                </div>
            @endif

        </div>
    </div>
@endsection