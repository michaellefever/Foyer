@extends('...app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-offset-4">
                    <h1 class="title">{{Lang::get('user_create.title')}}</h1>
                </div>
                <br>
                @include('errors.list')
                {!! Form::open(['method' => 'POST', 'action' => ['UsersController@store'], 'class' =>'form-horizontal']) !!}
                @include('users.form',['submitBtnText' => Lang::get('buttons.createbtn'), 'iconBtn' => 'ok', 'races' => $races, "user" => null])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    {!! Html::script('/javascript/autocomplete.js')!!}
    {!! Html::script('/javascript/datepicker.js')!!}
@endsection
