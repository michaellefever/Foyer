<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Race;
use App\Participation;
use App\User;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class ResultsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $users = User::all();
        return view('results/index',compact('users'));
	}

	/**
	 * Display the specified resource.
	 *s
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$race = Race::findOrFail($id);
        $participations = Participation::where('race_id', $race->id)->orderBy('raceNumber', 'asc')->get();
        $users = array();
        foreach ($participations as $participation) {
            $users[] = $participation->user;
        }
        return view('/results/show', compact('users' , 'participations', 'race'));
	}

}
