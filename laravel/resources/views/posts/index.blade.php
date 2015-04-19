@extends('app')

@section('content')
    <div class="row">
    <div class="col-md-8 col-md-offset-2">

        @unless($posts->isEmpty())
            <h1>All the posts</h1>

            @foreach($posts as $post)
                <h2><a href="{{ url('blog/' . $post->id) }}">{{ $post->headline }}</a></h2>
            @endforeach

        @else
            <p>Nothing here.</p>
        @endunless

    </div>
    </div>
@stop