<?php namespace App\Http\Controllers;

use App\Http\Requests\CreateRaceRequest;
use App\Race;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        $races = Race::all();
        return view('race_overview')->with('races', $races);
	}

    public function create()
    {
        return view('race_form');
    }

    public function overview()
    {
        $races = Race::all();
        return view('race_overview')->with('races', $races);
    }

    public function store(CreateRaceRequest $request){
        $input = $request->all();
        Race::create($input);
        return $this->overview();
    }



}
