@extends('...app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('flash::message')
                <div class="col-md-offset-4">
                    <h1 class="title">{{Lang::get('race_overview.title')}}</h1>
                </div>
                <br>
                <div class="row" style="margin-bottom: 15px">
                    <div class="col-xs-12 col-sm-4">
                        <a href="{{url('races/create')}}" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-plus"></span>{{Lang::get('race_overview.createbtn')}}</a>
                    </div>
                    <div class="clearfix visible-xs-block"></div>
                    <div class="col-sm-4"></div>
                    <div class="col-xs-12 col-sm-4">
                        <a href="{{url('csv/export/races')}}" class="btn btn-sm btn-dark pull-right"><span class="glyphicon glyphicon-floppy-save"></span> {{Lang::get('buttons.exportbtn')}}</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped table-bordered tablesorter">
                        <thead>
                        <tr>
                            <th>{{Lang::get('races.nameOfTheRace')}}</th>
                            <th>{{Lang::get('races.firstRaceNumber')}}</th>
                            <th>{{Lang::get('races.distance')}}</th>
                            <th>{{Lang::get('races.startTime')}}</th>
                            <th>{{Lang::get('race_overview.numberparticipants')}}</th>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($races as $key => $race)
                            <tr>
                                <td>{{ $race->nameOfTheRace }}</td>
                                <td>{{ $race->firstRaceNumber }}</td>
                                <td>{{ $race->distance }}</td>
                                <td>{{ $race->startTime }}</td>
                                <td>{{ count($race->participations->where('year', Carbon\Carbon::now()->year)) }}</td>
                                <td>
                                    <a href="{{url('races/'.$race->id).'/edit'}}" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-wrench"></span>{{Lang::get('buttons.editbtn')}}</a>

                                    {!! Form::open(['action' => ['RacesController@destroy', $race->id], 'method' => 'delete', 'style' => 'display:inline']) !!}
                                        {!! Form::button('<span class="glyphicon glyphicon-trash"></span>' . Lang::get('buttons.deletebtn'), ['class'=>'btn btn-danger btn-sm', 'type'=>'submit']) !!}
                                    {!! Form::close() !!}
                                    <a href="{{url('participations/race/'.$race->id)}}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-list-alt"></span>{{Lang::get('buttons.showparticipationsbtn')}}</a>                            </td>
                                </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    {!! Html::script('/javascript/jquery.tablesorter.js') !!}
@endsection
