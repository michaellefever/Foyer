<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Foyer jogging</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="//cloud.github.com/downloads/lafeber/world-flags-sprite/flags32.css"/>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    -->
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Foyer jogging</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
                @if (Auth::guest())
				    <li><a href="{{ url('/') }}">{{Lang::get('menu.home')}}</a></li>
				@elseif (App\Registrant::where('email', Auth::user()->email)->get()->first()->isAdmin)
					<li><a href="{{ url('users') }}">{{Lang::get('menu.users')}}</a></li>
					<li><a href="{{ url('races') }}">{{Lang::get('menu.races')}}</a></li>
					<li><a href="{{ url('participations') }}">{{Lang::get('menu.participations')}}</a></li>
					<li><a href="{{ url('timeregistration') }}">{{Lang::get('menu.timeregistration')}}</a></li>
					<li><a href="{{ url('csv/import') }}">{{Lang::get('menu.import')}}</a></li>
                @else
                        <li><a href="{{ url('participations') }}">{{Lang::get('menu.participations')}}</a></li>
				@endif
					<li><a href="{{ url('contact') }}">{{Lang::get('menu.contact')}}</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right f32">
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
					@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li>
                            <a rel="alternate" hreflang="{{$localeCode}}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}" >
                                @if ($localeCode == "en")
                                    <span class="flag gb"></span>
                                @else
                                    <span class="flag {{$localeCode}}"></span>
                                @endif
                            </a>
                        </li>
                    @endforeach
				</ul>
			</div>
		</div>
	</nav>
	@yield('content')
</body>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
@yield('scripts')
  <script>
    $('div.alert').not('alert-important').delay(2500).slideUp(300);
    $(document).ready(function()
        {
        $("#myTable").tablesorter({
            dateFormat : "uk" // default date format
        });
   });
    </script>

</html>
