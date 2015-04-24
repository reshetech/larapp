@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <h1>Contact us</h1>

            {!! Form::open(['action' => 'PageController@postContact']) !!}

            <div class="form-group">
                {!! Form::label('name','Name:') !!}
                {!! Form::text('name', Request::input('name'), ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('phone','Phone:') !!}
                {!! Form::text('phone', Request::input('phone'), ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('mail','Mail:') !!}
                {!! Form::input('email', 'mail', Request::input('mail'), ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('message','Message:') !!}
                {!! Form::textarea('message', Request::input('message'), ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit( 'Submit', ["class" => "btn btn-default"]) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@stop