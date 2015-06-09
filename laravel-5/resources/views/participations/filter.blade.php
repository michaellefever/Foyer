<div class="panel panel-default ">
    <div class="panel-heading">
        {{Lang::get('participation_overview.filteroptions')}}
    </div>
    <div class="panel-body"  style="padding: 5px">
        {!! Form::open(['method' => 'POST', 'id' => 'searchform', 'class' => 'form-horizontal' ]) !!}
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
                    <div class="col-xs-2">
                        {!! Form::label('agerange', Lang::get('users.age'), ['class' =>'control-label', 'style' => 'float:left']) !!}
                    </div>
                    <div class="col-xs-8">
                        <div class="row">
                            <div class="col-xs-12">
                                <div id="min" style="display: inline-block; margin:4px;"></div>
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
                                ),'firstName', array('class' => 'form-control', 'id' => 'filteropt'));!!}
                                <button type="button" id="search" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        {!! Form::close() !!}
    </div>
</div>