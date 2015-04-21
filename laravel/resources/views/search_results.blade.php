@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <h1>Query result for the term: {{ $q }}</h1>

            @if($posts->count())
                <ul>
                @foreach($posts as $post)
                    <li>{!! link_to("blog/$post->id", $post->headline) !!}</li>
                @endforeach
                </ul>
            @else
               {!! "<p>No search results for the term.</p>" !!}
            @endif
        </div>
    </div>
@stop