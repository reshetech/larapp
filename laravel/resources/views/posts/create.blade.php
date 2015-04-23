@extends('app')

@section('content')
    <div class="row">
    <div class="col-md-8 col-md-offset-2">

    <h1>Create new blog post</h1>

    {!! Form::open(['action' => 'PostController@store']) !!}

    @include('posts._form-fields', ['submitText' => 'Create'])

    {!! Form::close() !!}
    </div>
    </div>
@stop