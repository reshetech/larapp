@extends('app')

@section('content')
    <div class="row">
    <div class="col-md-8 col-md-offset-2">

    <h1>Edit the blog post</h1>

    {!! Form::model($post,['route' => ["blog.update", $post->id], 'method' => 'PATCH']) !!}

    @include('posts._form-fields', ['submitText' => 'Edit'])

    {!! Form::close() !!}
    </div>
    </div>
@stop