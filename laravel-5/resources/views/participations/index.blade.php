@extends('...app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1 class="title">{{Lang::get('participation_overview.title')}}</h1>
                <br>
                <div class="row">
                    <div class="col-xs-6 col-sm-4">
                        <a href="{{url('/users')}}" class="btn btn-lg btn-primary"></span>{{Lang::get('buttons.useroverviewbtn')}}</a>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                        <div class="panel panel-default ">
                            <div class="panel-heading">
                                {{Lang::get('participation_overview.filteroptions')}}
                            </div>
                            <div class="panel-body"  style="padding: 5px">
                                {!! Form::open(['method' => 'POST', 'action' => ['ParticipationsController@filter'], 'class' =>'form-horizontal']) !!}
                                <ul class="list-group" style="margin-bottom: 0px">
                                    <li class="list-group-item"  style="padding: 0px 15px">
                                        {!! Form::label('year', Lang::get('participations.year'), ['class' =>'control-label', 'style' => 'float:left']) !!}
                                        <ul class="list-inline">
                                            @foreach($years as $year)
                                                <li>
                                                    {!! Form::label('year', $year, ['class' =>'control-label', 'style' => 'padding:7px']) !!}
                                                    {!! Form::checkbox('year', $year, null, ['class' => 'filter']) !!}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li class="list-group-item" style="padding: 0px 15px">
                                        {!! Form::label('distance', Lang::get('participations.distance'), ['class' =>'control-label', 'style' => 'float:left']) !!}
                                        <ul class="list-inline">
                                            @foreach($distances as $distance)
                                                <li>
                                                    {!! Form::label('distance', $distance, ['class' =>'control-label', 'style' => 'padding:7px']) !!}
                                                    {!! Form::checkbox('distance', $distance, null, ['class' => 'filter']) !!}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    <!-- Optional: clear the XS cols if their content doesn't match in height -->
                    <div class="clearfix visible-xs-block"></div>
                    <div class="col-xs-6 col-sm-4">
                        <a href="{{url('csv/export/participations')}}" class="btn btn-sm btn-dark pull-right"><span class="glyphicon glyphicon-floppy-save"></span> {{Lang::get('buttons.exportbtn')}}</a>
                    </div>
                </div>
                <div id="table">
                    @include('participations.table', ['participations' => $participations])
                </div>
            </div>
        </div>
    </div>
@stop