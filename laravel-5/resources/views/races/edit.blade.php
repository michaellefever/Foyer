@extends('...app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-offset-4">
                    <h1 class="title">{{Lang::get('race_edit.title')}}</h1>
                </div>
                <br>
                @include('errors.list')
                {!! Form::model($race, ['method' => 'PATCH', 'action' => ['RacesController@update', $race->id], 'class' =>'form-horizontal']) !!}
                @include('races.form',['submitBtnText' => Lang::get('buttons.savebtn'), 'iconBtn' => 'floppy-disk'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
