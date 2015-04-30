<?php namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller {

    public function index(){
        return User::all();
    }

    public function store(CreateUserRequest $request){
        $input = $request->all();
        User::create($input);
        return redirect('users');
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('users/edit', compact('user'));
    }

    public function update($id, Request $request){
        $user = User::findOrFail($id);
        $user->update($request->all());
        return redirect('users');
    }

}
