@extends('...app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-offset-4">
                    <h1 class="title">{{Lang::get('results_show.title') }}</h1>
                </div>
                <br>
                <a href="{{url('/races')}}" class="btn btn-lg btn-primary"></span>{{Lang::get('buttons.raceoverviewbtn')}}</a>
                <a href="{{url('/csv/export/results')}}" class="btn btn-sm btn-dark pull-right"><span class="glyphicon glyphicon-floppy-save"></span> {{Lang::get('buttons.exportbtn')}}</a>
                <br>
                <br>
                <div class="table-responsive">
                    @include('results.table', ['users' => $users])
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    {!! Html::script('/javascript/searchAjax.js')!!}
    {!! Html::script('/javascript/jquery.tablesorter.js') !!}
@endsection