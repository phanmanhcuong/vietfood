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
            </div>
        </div>
        
        <div class="col-md-3 col-sm-6 col-xs-12">
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
        </div>
    </div>
@endsection