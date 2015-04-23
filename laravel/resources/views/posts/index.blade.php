@extends('app')

@section('content')
    <div class="row">
    <div class="col-md-8 col-md-offset-2">

        @unless($posts->isEmpty())
            <h1>All the posts</h1>

            @foreach( $posts -> chunk(3) as $row )
                <div class="row">
                @foreach(  $row as $post )
                    <article class="col-md-4">
                    <h2><a href="{{ url( 'blog/' . $post->slug->slug ) }}">{{ $post->headline }}</a></h2>
                    </article>
                @endforeach
                </div>
            @endforeach

            {!! $posts -> render() !!}

        @else
            <p>Nothing here.</p>
        @endunless

    </div>
    </div>
@stop