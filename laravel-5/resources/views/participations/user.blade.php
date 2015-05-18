@extends('...app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                    <h1 class="title">{{Lang::get('participation_show.usertitle') . $user->firstName . ' ' . $user->name}}</h1>
                <br>
                @if (App\Registrant::where('email', Auth::user()->email)->get()->first()->isAdmin)
                <div class="col-md-offset-10">
                    <a href="{{url('csv/export/participations/'.$user->id)}}" class="btn btn-sm btn-dark"><span class="glyphicon glyphicon-floppy-save"></span> {{Lang::get('buttons.exportbtn')}}</a>
                </div>
                @endif
                <br>
                @include('participations.table', ['participations' => $participations])
            </div>
        </div>
    </div>
@stop