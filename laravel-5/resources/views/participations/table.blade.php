
<table id="myTable" class="table table-striped table-bordered tablesorter">
    <thead>
                    <tr>
                        <th>{{Lang::get('participations.year')}}</th>
                        <th>{{Lang::get('users.firstname')}}</th>
                        <th>{{Lang::get('users.name')}}</th>
                        <th>{{Lang::get('users.dateofbirth')}}</th>
                        <th>{{Lang::get('participations.racenumber')}}</th>
                        <th>{{Lang::get('participations.chipnumber')}}</th>
                        <th>{{Lang::get('participations.time')}}</th>
                        <th>{{Lang::get('participations.average')}}</th>
                        <th>{{Lang::get('participations.distance')}}</th>
                        <th>{{Lang::get('races.race')}}</th>
                        <th>{{Lang::get('participations.paid')}}</th>
                        @if (App\Registrant::where('email', Auth::user()->email)->get()->first()->isAdmin)
                        <td></td>
                        @endif
                    </tr>
                    </thead>
                        <tbody id="tbody">
                        @foreach($participations as $key => $participation)
                        <tr>
                            <td>{{ $participation->year }}</td>
                            <td>{{ $participation->user->firstName }}</td>
                            <td>{{ $participation->user->name }}</td>
                            <td>{{ $participation->user->dateOfBirth }}</td>
                            <td>{{ $participation->raceNumber }}</td>
                            <td>{{ $participation->chipNumber }}</td>
                            <td>{{ $participation->time }}</td>
                            <td>{{ $participation->averageSpeed }}</td>
                            <td>{{ $participation->race->distance  }}</td>
                            @if (App\Registrant::where('email', Auth::user()->email)->get()->first()->isAdmin)
                            <td>
                                <a href="{{url('races/'.$participation->race->id).'/edit'}}">{{ $participation->race->nameOfTheRace }}</a>
                            </td>
                                <td>@if($participation->paid) {{Lang::get('participations.yes')}}@else {{Lang::get('participations.no')}}@endif</td>
                            <td>
                                <div class="form-group">
                                    <a href="{{url('participations/'.$participation->user_id.'/'. $participation->year.'/edit')}}" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-wrench"></span>{{Lang::get('buttons.editbtn')}}</a>
                                </div>
                            </td>
                            @else
                                <td>{{ $participation->race->nameOfTheRace }}</td>
                            @endif
                         </tr>
                    @endforeach
                    </tbody>
                </table>