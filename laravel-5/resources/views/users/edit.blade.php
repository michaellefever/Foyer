@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
		<div class="col-md-offset-4">
            <h1 class="title">{{Lang::get('user_edit.title')}}</h1>
        </div>
        <br>
            @include('errors.list')
            {!! Form::model($user, ['method' => 'PATCH', 'action' => ['UsersController@update', $user->id], 'class' =>'form-horizontal']) !!}
            @include('users.form',['submitBtnText' => Lang::get('buttons.savebtn'), 'iconBtn' => 'ok', 'races' => $races, 'user' => $user])
		{!! Form::close() !!}
		</div>
    </div>
</div>
@stop


