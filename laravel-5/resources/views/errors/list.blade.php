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