@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
		<div class="col-md-offset-4">
            <h1 class="title">{{Lang::get('participation_edit.title')}}</h1>
        </div>
        <br>
            @include('errors.list')
            {!! Form::model($participation, ['method' => 'PATCH', 'action' => ['ParticipationsController@update', $participation->user_id, $participation->year], 'class' =>'form-horizontal']) !!}
            <div class="form-group">
                {!! Form::label('paid', Lang::get('participations.paid'), ['class' =>'col-md-4 control-label']) !!}
                {!! Form::checkbox('paid', 1, $participation->paid) !!}
            </div>
            <div class="form-group">
                {!! Form::label('wiredTransfer', Lang::get('participations.wiredtransfer'), ['class' =>'col-md-4 control-label']) !!}
                {!! Form::checkbox('wiredTransfer', 1, $participation->wiredTransfer) !!}
            </div>
            <br>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class='btn btn-primary btn-success'><span class='glyphicon glyphicon-ok'></span>{{Lang::get('buttons.editbtn')}}</button>
                    <a href="{{url('participations')}}" class="btn btn-primary btn-danger"><span class="glyphicon glyphicon-ban-circle"></span> {{Lang::get('buttons.cancelbtn')}}</a>
                </div>
            </div>
		{!! Form::close() !!}
		</div>
    </div>
</div>
@stop


