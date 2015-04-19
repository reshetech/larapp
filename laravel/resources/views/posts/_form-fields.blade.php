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

<h2>Meta tags</h2>

<div class="form-group">
    {!! Form::label('description','Description:') !!}
    @if(isset($post) && $post->meta()!==null)
        {!! Form::textarea('title',  $post->meta->description, ['class'=>'form-control']) !!}
    @else
        {!! Form::textarea('description', Request::input('meta.description'), ['class'=>'form-control']) !!}
    @endif
</div>

<div class="form-group">
    {!! Form::label('twitter_card','Twitter card:') !!}
    @if(isset($post) && $post->meta()!==null)
        {!! Form::textarea('title',  $post->meta->twitter_card, ['class'=>'form-control']) !!}
    @else
        {!! Form::textarea('twitter_card', Request::input('twitter_card'), ['class'=>'form-control']) !!}
    @endif
</div>

<div class="form-group">
    {!! Form::label('og_title','Og title:') !!}
    @if(isset($post) && $post->meta()!==null)
        {!! Form::textarea('title',  $post->meta->og_title, ['class'=>'form-control']) !!}
    @else
        {!! Form::textarea('og_title', Request::input('og_title'), ['class'=>'form-control']) !!}
    @endif
</div>

<div class="form-group">
    {!! Form::label('og_image','Og image:') !!}
    @if(isset($post) && $post->meta()!==null)
        {!! Form::textarea('title',  $post->meta->og_image, ['class'=>'form-control']) !!}
    @else
        {!! Form::text('og_image', Request::input('og_image'), ['class'=>'form-control']) !!}
    @endif
</div>

<div class="form-group">
    {!! Form::label('og_description','Og description:') !!}
    @if(isset($post) && $post->meta()!==null)
        {!! Form::textarea('og_description', $post->meta->og_description, ['class'=>'form-control']) !!}
    @else
        {!! Form::textarea('og_description', Request::input('og_description'), ['class'=>'form-control']) !!}
    @endif

</div>

<hr />

<div class="form-group">
    {!! Form::submit( $submitText, ["class" => "btn btn-default"]) !!}
</div>