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

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
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

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
 <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  {!! Html::script('/javascript/jquery.tablesorter.js') !!}
{!! Html::script('/javascript/spin.js') !!}
  <script>
    $(function() {
      $( "#datepicker" ).datepicker({
        dateFormat: "dd/mm/yy",
        changeMonth: true,
        changeYear: true,
        maxDate: "-2Y",
        minDate: "-100Y",
        yearRange: "-100:-2"
        });
      });

      $(function () {
                  $("#firstName").autocomplete({
                      source: "search/autocomplete",
                      minLength: 2,
                      select: function (event, ui) {
                          //$('#firstName').val(ui.item.value);
                          var id = ui.item.id;
                          window.location =  id + '/edit';
                      }
                  });
              });

    $('div.alert').not('alert-important').delay(2500).slideUp(300);
    $(document).ready(function()
        {
            $('.filter').change(function(){
                var years = $('input[name=year]:checked').map(function(){
                    return this.value;
                }).get();
                var distances = $('input[name=distance]:checked').map(function(){
                    return this.value;
                }).get();
                $.ajax({
                    url: 'participations/filter',
                    type: "POST",
                    data: {'years':years,'distances':distances,'_token': $('input[name=_token]').val()},
                    success: function(response){
                        $('#table').html(response);
                        $("#myTable").tablesorter({
                            dateFormat : "uk" // default date format
                        });
                    }
                });
            });

        $("#myTable").tablesorter({
            dateFormat : "uk" // default date format
          });
    });
    </script>
<script>
    var opts = {
        lines: 11, // The number of lines to draw
        length: 7, // The length of each line
        width: 6, // The line thickness
        radius: 15, // The radius of the inner circle
        corners: 1, // Corner roundness (0..1)
        rotate: 0, // The rotation offset
        direction: 1, // 1: clockwise, -1: counterclockwise
        color: '#000', // #rgb or #rrggbb or array of colors
        speed: 1, // Rounds per second
        trail: 60, // Afterglow percentage
        shadow: false, // Whether to render a shadow
        hwaccel: false, // Whether to use hardware acceleration
        className: 'spinner', // The CSS class to assign to the spinner
        zIndex: 2e9, // The z-index (defaults to 2000000000)
        top: '100%', // Top position relative to parent
        left: '50%' // Left position relative to parent
    };
    var target = document.getElementById('importbtn');
    $('#importbtn').click(function(){
        var spinner = new Spinner(opts).spin(target);
        target.appendChild(spinner.el);
    });

</script>
</html>
