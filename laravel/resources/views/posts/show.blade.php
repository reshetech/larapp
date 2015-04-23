@extends('app')

@section('content')
    <div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h1>{{ $post->headline }}</h1>
        <p>Published at: {{ $post->published_at->toFormattedDateString() }} | By: {{ $post->user->name }}</p>
        <div>
            {!! $post->body !!}
        </div>

    </div>
    </div>

@stop