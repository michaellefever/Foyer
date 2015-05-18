@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-offset-4">
                    <h1 class="title">{{Lang::get('race_form.title')}}</h1>
                </div>
                <br>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> {{Lang::get('participation_form.error_input')}}<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {!! Form::open(['url' => 'race', 'class' =>'form-horizontal']) !!}
                <div class="form-group">
                    {!! Form::label('nameOfTheRace', Lang::get('race_form.nameOfTheRace'), ['class' =>'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                        {!! Form::text('nameOfTheRace', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('firstRaceNumber', Lang::get('race_form.firstRaceNumber'), ['class' =>'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                        {!! Form::text('firstRaceNumber', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        {!! Form::submit(Lang::get('race_form.savebtn'), ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
