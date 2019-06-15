@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Zmień hasło</div>

                <form method="post" action="{{ route('resetPassword', ['token' => $token]) }}">

                    {{ csrf_field() }}

                    <div class="form-group">
                        {!! Form::label('password', 'Nowe hasło') !!}
                        {!! Form::text('password', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('passwordConfirmation', 'Potwierdzenie hasła') !!}
                        {!! Form::text('passwordConfirmation', null, ['class' => 'form-control']) !!}
                    </div>

                    {!! Form::submit('Zmień hasło', ['class' => 'btn btn-info']) !!}

                </form>
            </div>
        </div>
    </div>
</div>
@endsection