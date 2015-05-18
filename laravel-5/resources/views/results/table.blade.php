 <table id="myTable" class="table table-striped table-bordered table-responsive tablesorter">
    <thead>
        <tr>
            <th class="header">{{Lang::get('users.firstname')}}</th>
            <th class="header">{{Lang::get('users.name')}}</th>
            <th>{{Lang::get('users.dateofbirth')}}</th>
            <th>{{Lang::get('participations.time')}}</th>
            <th>{{Lang::get('participations.year')}}</th>
            <th>{{Lang::get('races.race')}}</th>
         </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            @foreach($user->participations as $participation)
                <tr>
                    <td>{{ $user->firstName }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->dateOfBirth }}</td>
                    <td>{{ $participation->time }}</td>
                    <td>{{ $participation->year }}</td>
                    <td>{{ $participation->race->nameOfTheRace }}</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>