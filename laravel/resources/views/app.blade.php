<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    @include('partials.meta')

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>

<div class="navbar navbar-inverse navbar-static-top" role="navigation">

    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" rel="home" href="{{ url('/') }}" title="Homepage">Home</a>
    </div>

    <div class="collapse navbar-collapse navbar-ex1-collapse">

        <ul class="nav navbar-nav">
            <li><a href="/topic/notes/">notes</a></li>
            <li><a href="/topic/dev/">dev</a></li>
            <li><a href="/topic/good-reads/">good-reads</a></li>
            <li><a href="/topic/art/">/</a></li>
            <li><a href="/topic/bookmarks/">bookmarks</a></li>
            <li><a href="/all-topics/">all</a></li>
        </ul>

        <div class="col-sm-3 col-md-3">
            {!! Form::open(['action' => 'PostController@search', 'method' => 'GET', 'role' => 'search', 'class' => 'navbar-form']) !!}
                <input type="text" id="q" name="q" placeholder="Search...">
            {!! Form::close() !!}
        </div>

        <ul class="nav navbar-nav pull-right">
            @if (Auth::guest())
                <li><a href="{{ url('/auth/login') }}">Login</a></li>
                <li><a href="{{ url('/auth/register') }}">Register</a></li>
            @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                    </ul>
                </li>
            @endif
        </ul>

    </div>
</div>











    @if(Session::has('success') || Session::has('failure'))
        @if(Session::has('success'))
        <div class="flash alert alert-success">
            {{ Session::get('success') }}
        @elseif(Session::has('failure'))
        <div class="flash alert alert-danger">
            {{ Session::get('failure') }}
        @endif
            <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    @endif

	@yield('content')

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script>
        (function($){
            var flash = $(".flash"), flashBtn = flash.find("button");
            flashBtn.on('click',function(){
                flash.slideUp();
            });
        }(jQuery));
    </script>
</body>
</html>
