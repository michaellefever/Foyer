<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Participation;
use Illuminate\Http\Request;

class ParticipationsController extends Controller {

	public function index(){
        return Participation::all();
    }

    public function store(Request $request){
        return $request->input('name');
    }
}
