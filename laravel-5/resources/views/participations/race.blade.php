@extends('...app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                    <h1 class="title">{{Lang::get('participation_show.racetitle') . $race->nameOfTheRace}}</h1>
                <br>
                <div class="col-md-offset-10">
                    <a href="{{url('csv/export/participations/')}}" class="btn btn-sm btn-dark"><span class="glyphicon glyphicon-floppy-save"></span> {{Lang::get('buttons.exportbtn')}}</a>
                </div>
                <br>
                @include('participations.table', ['participations' => $participations])
            </div>
        </div>
    </div>
@stop