@extends ('layouts.app')

@section ('content')
    <div class="search">
        <div class="row">
            <div class="text-center">
                {!! Form::open(['route' => ['users.search_posts', 'id' => $user->id], 'method' => 'get', 'class' => 'form-inline']) !!}
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