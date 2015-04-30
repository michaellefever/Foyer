@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-offset-4">
                    <h1 class="title">{{Lang::get('race_overview.title')}}</h1>
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
                <table class="table table-striped table-bordered table-responsive">
                    <thead>
                    <tr>
                        <td>{{Lang::get('race_overview.nameOfTheRace')}}</td>
                        <td>{{Lang::get('race_overview.firstRaceNumber')}}</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($races as $key => $value)
                        <tr>
                            <td>{{ $value->nameOfTheRace }}</td>
                            <td>{{ $value->firstRaceNumber }}</td>
                            <td><a class="btn btn-sm" href="">Edit</a> </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
