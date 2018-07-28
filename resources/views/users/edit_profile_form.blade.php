@extends ('layouts.app')

@section ('content')
    <div class="text-center">
        <h1>My Profile</h1>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            {!! Form::model($user, ['route' => ['users.edit_profile_post', $user->id], 'method' => 'put', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('gentle', 'Gentle') !!}
                    <div>
                        @if ($user->gentle == 'Male' || $user->gentle === null)
                            {!! Form::radio('gentle', 'Male', true) !!} Male
                            {!! Form::radio('gentle', 'Female') !!} Female
                        @else
                            {!! Form::radio('gentle', 'Male') !!} Male
                            {!! Form::radio('gentle', 'Female', true) !!} Female
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('birthday', 'Birthday') !!}
                    {!! Form::text('birthday', $user->birthday, array('class' => 'form-control', 'placeholder' => '2000-01-31')) !!}
                </div>
    
                <div class="form-group">
                    {!! Form::label('image', 'Avatar') !!}
                    <div class="avatar">
                        @if ($user->avatar_url != null)
                            <center><img src="{!! $user->avatar_url !!}" width="20%" height="20%" align="center"></center>
                        @endif
                    </div>
                    {!! Form::file('image1', ['class' => 'form-control']) !!}
                </div>
                
                {!! Form::submit('Save', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection