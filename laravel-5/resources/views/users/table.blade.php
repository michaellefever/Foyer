<table id="myTable" class="table table-striped table-bordered tablesorter">
    <thead>
        <tr>
            <td><input type="checkbox" name="selectAll" id="selectAll"/></td>
            <th>{{Lang::get('users.firstname')}}</th>
            <th>{{Lang::get('users.name')}}</th>
            <th style="width: 15%" class="sorter-ddmmyy">{{Lang::get('users.dateofbirth')}}</th>
            <th>{{Lang::get('users.email')}}</th>
            <th>{{Lang::get('users.address')}}</th>
            <th>{{Lang::get('users.city')}}</th>
            <th>{{Lang::get('users.club')}}</th>
            <td></td>
        </tr>
    </thead>
                    <tbody>
                    @foreach($users as $key => $user)
                        <tr>
                            <td><input type="checkbox" name="user" id="{{ $user->id }}" value="{{ $user->id }}"  /> </td>
                            <td>{{ $user->firstName }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{Carbon\Carbon::createFromFormat('d/m/Y',$user->dateOfBirth)->format('d/m/Y') . ' (' . Carbon\Carbon::createFromFormat('d/m/Y', $user->dateOfBirth)->age . ')'}}</td>
                            <td>{{ $user->emailAddress }}</td>
                            <td>{{ $user->address . ' ' . $user->zipCode . ' ' . $user->city}}</td>
                            <td>{{ $user->city}}</td>
                            <td>{{ $user->clubD}}</td>
                            <td>
                                <div class="form-group">
                                    <a href="{{url('users/'.$user->id).'/edit'}}" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-wrench"></span>{{Lang::get('buttons.editbtn')}}</a>
                                </div>
                                <div class="form-group">
                                {!! Form::open(['action' => ['UsersController@destroy', $user->id], 'method' => 'delete', 'style' => 'display:inline']) !!}
                                    {!! Form::button('<span class="glyphicon glyphicon-trash"></span>' . Lang::get("buttons.deletebtn"), ['class'=>'btn btn-danger btn-sm', 'type'=>'submit']) !!}
                                {!! Form::close() !!}
                                </div>
                                    <a href="{{url('participations/user/'.$user->id)}}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-list-alt"></span>{{Lang::get('buttons.showparticipationsbtn')}}</a>
                            </td>
                         </tr>
                    @endforeach
                    </tbody>
                </table>
<script>
    $('#selectAll').click(function(event) {
        if(this.checked) {
            $(':checkbox').each(function () {
                this.checked = true;
            });
        }
        else {
            $(':checkbox').each(function() {
                this.checked = false;
            });
        }
    });

</script>