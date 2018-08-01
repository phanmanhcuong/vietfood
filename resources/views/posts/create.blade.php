@extends ('layouts.app')

@section ('content')
    <div class="text-center">
        <h1>Create Post</h1>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            {!! Form::model($post, ['route' => ['posts.store'], 'enctype' => 'multipart/form-data']) !!}
                <div class="food-iamge">
                    @if ($post->image_url != null)
                        <center><img src="{!! $post->image_url !!}" width="20%" height="20%" align="center"></center>
                    @endif
                </div>
                
                <div class="form-group">
                    {!! Form::label('image', 'Image') !!}
                    {!! Form::file('image', ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('title', 'Title') !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
                </div>
                    
                <div>
                    {!! Form::label('content', 'Content') !!}
                    {!! Form::text('content', old('content'), ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('restaurant_name', 'Restaurant Name') !!}
                    {!! Form::text('restaurant_name', old('restaurant_name'), ['class' => 'form-control']) !!}
                </div>
                
                {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection