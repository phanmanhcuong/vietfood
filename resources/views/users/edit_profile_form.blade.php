@extends ('layouts.app')

@section ('content')
    <div class="text-center">
        <h1>My Profile</h1>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            {!! Form::model($user, ['route' => ['users.edit_profile_post', $user->id], 'method' => 'put']) !!}
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
                    @if ($user->avatar_url != null)
                        {!! $user->avatar_url !!}
                    @endif
                    {!! Form::label('image', 'Avatar') !!}
                    {!! Form::file('image', ['class' => 'form-control']) !!}
                </div>
                <!--<div class="form-group">-->
                <!--    {!! Form::label('email', 'Email') !!}-->
                <!--    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}-->
                <!--</div>-->
                
                <!--<div class="form-group">-->
                <!--    {!! Form::label('password', 'Password') !!}-->
                <!--    {!! Form::password('password', ['class' => 'form-control']) !!}-->
                <!--</div>-->
                
                <!--<div class="form-group">-->
                <!--    {!! Form::label('password_confirmation', 'Confirmation') !!}-->
                <!--    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}-->
                <!--</div>-->
                
                {!! Form::submit('Save', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection