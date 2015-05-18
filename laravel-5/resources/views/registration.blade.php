@extends('...app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-offset-4">
                    <h1 class="title">{{Lang::get('participation_form.title')}}</h1>
                </div>
                <br>
                @include('errors.list')
                {!! Form::open(['method' => 'POST', 'action' => ['UsersController@store'], 'class' =>'form-horizontal']) !!}
                @include('users.form',['submitBtnText' => Lang::get('participation_form.registerbtn'), 'iconBtn' => 'ok'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
