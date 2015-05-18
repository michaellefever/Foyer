<div class="form-group">
    {!! Form::label('firstName', Lang::get('participation_form.firstname'), ['class' =>'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('firstName', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('name', Lang::get('participation_form.name'), ['class' =>'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('address', Lang::get('participation_form.address'), ['class' =>'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('address', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('zipCode', Lang::get('participation_form.zipcode'), ['class' =>'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::input('number', 'zipCode', null, ['class' => 'form-control', 'min' => '1000', 'max' => '9999', 'step' => '1']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('city', Lang::get('participation_form.city'), ['class' =>'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('city', null, ['class' => 'form-control']) !!}
    </div>
            </div>
            <div class="form-group">
                {!! Form::label('emailAddress', Lang::get('participation_form.email'), ['class' =>'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::text('emailAddress', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('dateOfBirth', Lang::get('participation_form.dateofbirth'), ['class' =>'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::text('dateOfBirth', null, ['class' => 'form-control', 'id' => 'datepicker']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('isMale', Lang::get('participation_form.sex'), ['class' =>'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::label('male', Lang::get('participation_form.male')) !!}
                    {!! Form::radio('isMale', 1) !!}
                    {!! Form::label('female', Lang::get('participation_form.female')) !!}
                    {!! Form::radio('isMale', 0) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('clubD', Lang::get('participation_form.club'), ['class' =>'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::text('clubD', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('valNr', Lang::get('participation_form.valnr'), ['class' =>'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::input('number', 'valNr', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('shoe Brand', Lang::get('participation_form.shoebrand'), ['class' =>'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::text('shoeBrand', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
            {!! Form::label('distance', Lang::get('participation_form.distance'), ['class' =>'col-md-4 control-label']) !!}
            <div class="col-md-6">
                @foreach($races as $race)
                    {!! Form::label($race->distance . 'km',$race->distance . ' km') !!}
                    @if(!$user || $user->participations->isEmpty())
                        {!! Form::radio('distance', $race->id, true) !!}
                    @else
                        @if($race->distance == $user->participations->last()->race->distance)
                            {!! Form::radio('distance', $race->id, true) !!}
                        @else
                             {!! Form::radio('distance', $race->id, false) !!}
                        @endif
                    @endif
                @endforeach
            </div>

            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    {!! Form::submit($submitBtnText, ['class' => 'btn btn-primary']) !!}
                    <a href="{{url('users')}}" class="btn btn-primary btn-danger"><span class="glyphicon glyphicon-ban-circle"></span> {{Lang::get('buttons.cancelbtn')}}</a>
                </div>
            </div>