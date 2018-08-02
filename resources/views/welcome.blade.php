@extends ('layouts.app')

@section ('content')
    @if (!Auth::check())
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the Vietfood</h1>
                {!! link_to_route('signup.get', 'Sign up now!', null, ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif
    
    <div class="search">
        <div class="row">
            <div class="text-center">
                {!! Form::open(['route' => 'posts.search', 'method' => 'get', 'class' => 'form-inline']) !!}
                    <div class="form-group">
                        @if (isset($keyword))
                            {!! Form::text('keyword', $keyword, ['class' => 'form-control input-lg', 'placeholder' => 'Insert Keyword', 'size' => 40]) !!}
                        @else
                            {!! Form::text('keyword', null, ['class' => 'form-control input-lg', 'placeholder' => 'Insert Keyword', 'size' => 40]) !!}
                        @endif
                        {!! Form::submit('Search', ['class' => 'btn btn-success btn-lg']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    
    @include('posts.posts')
@endsection