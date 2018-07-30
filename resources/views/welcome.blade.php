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
    
    @include('posts.posts')
@endsection