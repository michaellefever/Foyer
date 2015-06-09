@extends('...app')

@section('content')
    <div class="container-fluid">
        <a href="javascript:" id="return-to-top"><i class="icon-chevron-up"></i></a>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('flash::message')
                <div class="col-md-offset-4">
                    <h1 class="title">{{Lang::get('user_overview.title')}}</h1>
                </div>
                <br>
                @include('errors.list')
                <div id="alert" class="alert alert-dismissible" style="display: none"></div>
                <div class="row" style="margin-bottom: 10px">
                    <div class="col-sm-4">
                        <a href="{{url('users/create')}}" class="btn btn-lg btn-success" style="margin-bottom: 10px"><span class="glyphicon glyphicon-plus"></span>{{Lang::get('user_overview.createbtn')}}</a>
                    </div>
                    <div class="col-sm-4">
                        <div class="panel panel-default ">
                            <div class="panel-heading">
                                {{Lang::get('participation_overview.filteroptions')}}
                            </div>
                            <div class="panel-body" style="padding: 5px">
                                {!! Form::open(['method' => 'POST', 'id' => 'searchform', 'class' => 'form-horizontal']) !!}
                                <ul class="list-group" style="margin-bottom: 0px">
                                    <li class="list-group-item"  style="padding: 0px 15px">
                                        {!! Form::label('year', Lang::get('users.sex'), ['class' =>'control-label', 'style' => 'float:left']) !!}
                                        <ul class="list-inline">
                                            <li>
                                                {!! Form::label('sex', Lang::get('users.male'), ['class' =>'control-label', 'style' => 'padding:7px']) !!}
                                                {!! Form::checkbox('sex', 1, null, ['class' => 'filter']) !!}
                                            </li>
                                            <li>
                                                {!! Form::label('sex', Lang::get('users.female'), ['class' =>'control-label', 'style' => 'padding:7px']) !!}
                                                {!! Form::checkbox('sex', 0, null, ['class' => 'filter']) !!}
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                {!! Form::label('agerange', Lang::get('users.age'), ['class' =>'control-label', 'style' => 'float:left']) !!}
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div id="min" style="display: inline-block; margin:4px"></div>
                                                        <div id="max" style="display: inline-block;float: right; margin:4px"></div>
                                                    </div>
                                                </div>
                                                <div id="slider"></div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="input-group">
                                                    {!! Form::text('filterinput', null, ['class' => 'form-control', 'id' => 'filterinput']) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="input-group" id="adv-search">
                                                    <div class="btn-group" role="group" style="display: inline-flex">
                                                        {!! Form::select('filteropt', array('firstName' => Lang::get('users.firstname'), 'name' => Lang::get('users.name'), 'dateOfBirth' => Lang::get('users.dateofbirth'),
                                                        'emailAddress' => Lang::get('users.email'), 'address' => Lang::get('users.address'), 'city' => Lang::get('users.city'), 'clubD' => Lang::get('users.club')),'firstName', array('class' => 'form-control', 'id' => 'filteropt'));!!}
                                                        {!! Form::close() !!}
                                                        <button type="button" id="search" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <a href="{{url('csv/export/users')}}" class="btn btn-sm btn-dark pull-right"><span class="glyphicon glyphicon-floppy-save"></span> {{Lang::get('buttons.exportbtn')}}</a>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                        <button id="sendMail" class="btn btn-sm btn-dark pull-right" style="margin-top: 10px"><span class="glyphicon glyphicon-envelope"></span> {{Lang::get('buttons.emailbtn')}}</button>
                    </div>
                </div>
                <div id="table" class="table-responsive">
                    @include('users.table', ['users' => $users])
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    {!! Html::script('/javascript/jquery.tablesorter.js') !!}
    {!! Html::script('/javascript/slider.js')!!}
    {!! Html::script('/javascript/searchAjax.js')!!}
    {!! Html::script('/javascript/scrollToTop.js') !!}
    <script>
        $('#sendMail').click(function() {
            var users = $('input[name=user]:checked').map(function(){
                return this.value;
            }).get();
            $.ajax({
                url: 'users/email',
                type: 'POST',
                data: {'users':users, '_token': $('input[name=_token]').val()},
                success: function (response){
                    var selector = $('#alert');
                    //alert(response['alert']);
                    selector.show();
                    setTimeout(function(){$('#alert').slideUp(500)}, 5000);
                    selector.removeClass().addClass(response['alert']);
                    selector.text(response['message']);
                }
            });
        });
    </script>
@endsection
