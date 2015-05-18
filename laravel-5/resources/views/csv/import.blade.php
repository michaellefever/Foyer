@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                    <h1>{{Lang::get('import.title')}}</h1>
                @include('flash::message')
                @include('errors.list')
                {!! Form::open(['method' => 'POST', 'action' => ['CsvController@import'] , 'files' => true]) !!}
                    <div class="form-group">
                            {!! Form::label('file','File',array('id'=>'','class'=>'')) !!}
                        {!! Form::file('file',['class'=>'form-control']) !!}
                    </div>
                <button type="submit" id="importbtn" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-open"></span> {{ Lang::get('buttons.importbtn') }}</button>

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
{!! Html::script('/javascript/spin.js') !!}
<script>
    var opts = {
        lines: 13, // The number of lines to draw
        length: 20, // The length of each line
        width: 10, // The line thickness
        radius: 30, // The radius of the inner circle
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
        top: '50%', // Top position relative to parent
        left: '50%' // Left position relative to parent
    };
    var target = document.getElementById('importbtn');
    var spinner = new Spinner(opts).spin(target);
</script>