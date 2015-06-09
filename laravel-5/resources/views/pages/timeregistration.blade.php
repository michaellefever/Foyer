@extends('app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
		    <div id="alert" class="alert alert-danger" style="display: none"></div>
			<div class="panel panel-default">
				<div class="panel-heading">{{Lang::get('timeregistration.title')}}</div>

				<div class="panel-body">
					{!! Form::open(['method' => 'POST', 'class' =>'form-horizontal', 'id' => 'timeform']) !!}
                    <div class="form-group">
                        <div class="col-md-6">
                            {!! Form::text('userid', null, ['class' => 'form-control', 'id' => 'userid', 'autofocus']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
				</div>
			</div>
			{!! Form::button('<span class="glyphicon glyphicon-stop"></span>' . Lang::get('buttons.stopbtn'), ['class'=>'btn btn-danger btn-sm pull-right', 'id' => 'stopbtn', 'style' => 'margin-left: 10px']) !!}
            {!! Form::button('<span class="glyphicon glyphicon-play"></span>' . Lang::get('buttons.startbtn'), ['class'=>'btn btn-primary btn-sm pull-right', 'id' => 'startbtn', 'style' => 'margin-bottom: 10px']) !!}
		</div>
	</div>
	 <div class="table-responsive">
        <table id="myTable" class="table table-striped table-bordered tablesorter">
            <thead>
                <tr>
                    <td></td>
                    <th>{{Lang::get('races.nameOfTheRace')}}</th>
                    <th>{{Lang::get('races.firstRaceNumber')}}</th>
                    <th>{{Lang::get('races.distance')}}</th>
                    <th>{{Lang::get('race_overview.numberparticipants')}}</th>
                    <th>{{Lang::get('races.numberArrived')}}</th>
                    <th>{{Lang::get('races.startTime')}}</th>
                    <td><b>{{Lang::get('races.time')}}</b></td>
                    <th>{{Lang::get('races.status')}}</th>
                </tr>
            </thead>
            <tbody id="tbody">
                @foreach($races as $key => $race)
                    <tr>
                        <td>{!! Form::checkbox('startstop', $race->id, null) !!}</td>
                        <td>{{ $race->nameOfTheRace }}</td>
                        <td>{{ $race->firstRaceNumber }}</td>
                        <td>{{ $race->distance }}</td>
                        <td>{{ $race->participations->where('year', Carbon\Carbon::now()->year)->count() }}</td>
                        <td id="arrivals{{ $race->id }}"> {{ $race->participations->count() - $race->participations->where('time', null)->count()}}</td>
                        <td id={{"startTime" . $key}}>@if(!$race->startTime) {{"- -  - -  - -"}}@else {{ Carbon\Carbon::createFromFormat("Y-m-d H:i:s",$race->startTime) }}@endif</td>
                        <td id={{"timeDiff" . $key}}>@if($race->status == "STOPPED") <span style="color:#ff3131"> {{Lang::get('races.statusstopped')}}</span> @endif</td>
                        <td>@if($race->status == "STARTED") {{Lang::get('races.statusstarted')}} @elseif($race->status == "STOPPED") <span style="color:#ff3131"> {{Lang::get('races.statusstopped')}}</span>
                            @else {{Lang::get('races.statusnotstarted')}}@endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <h2 style="margin-bottom: 20px">{{Lang::get('timeregistration.recentregistrations')}}</h2>
    <div class="table-responsive">
        @include('pages.timeregtable')
    </div>
</div>
@endsection
@section('scripts')
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    {!! Html::script('/javascript/jquery.tablesorter.js') !!}
    {!! Html::script('/javascript/countup.js') !!}
    {!! Html::script('/javascript/registertimeAjax.js')!!}
    <script>
        $('#startbtn').click(function(event){
           startstop('races/start')
        });

        $('#stopbtn').click(function(event){
            var indexes = $('input[name=startstop]:checked').map(function(){
                return $('input:checkbox').index(this)
            }).get();
            for(var i=0; i < indexes.length; i++){
                window.clearInterval(intervalsArray[indexes[i]]);
            }
            startstop('races/stop');
        });

        function startstop(url){
            var ids = $('input[name=startstop]:checked').map(function(){
                return this.value;
            }).get();
            $.ajax({
                url: url,
                type: "POST",
                data: {'ids':ids,'_token': $('input[name=_token]').val()},
                success: function(response){
                    window.location.replace("/timeregistration");
                }
            });
        }
    </script>
@endsection
