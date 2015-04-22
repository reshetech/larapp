@if ($errors->has())
    <div class="flash alert alert-danger">
        @foreach ($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
        <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
@endif


<div class="form-group">
    {!! Form::label('headline','Headline:') !!}
    {!! Form::text('headline', Request::input('headline'), ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('body','Body:') !!}
    {!! Form::textarea('body', Request::input('body'), ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('published_at','Publish at:') !!}
    {!! Form::date('published_at', \Carbon\Carbon::now(), ['class'=>'form-control']) !!}
</div>

<hr />

<h2>Url</h2>

<div class="form-group">
    {!! Form::label('slug','Slug:') !!}
    @if(isset($post))
        {!! Form::text('slug', $post->slug->slug, ['class'=>'form-control']) !!}
    @else
        {!! Form::text('slug', Request::input('slug'), ['class'=>'form-control']) !!}
    @endif
</div>

<hr />

<h2>Meta tags</h2>

<hr />

<div class="form-group">
    {!! Form::submit( $submitText, ["class" => "btn btn-default"]) !!}
</div>