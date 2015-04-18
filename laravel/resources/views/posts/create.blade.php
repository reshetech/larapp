@extends('app')

@section('content')
    <div class="row">
    <div class="col-md-8 col-md-offset-2">
    {!! Form::open(array('action' => 'PostController@store')) !!}

    <div class="form-group">
        {!! Form::label('headline','Headline:') !!}
        {!! Form::text('headline',null,array('class'=>'form-control')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('body','Body:') !!}
        {!! Form::textarea('body',null,array('class'=>'form-control')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('published_at','Publish at:') !!}
        {!! Form::date('published_at',\Carbon\Carbon::now(),array('class'=>'form-control')) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Create') !!}
    </div>

    {!! Form::close() !!}
    </div>
    </div>
@stop