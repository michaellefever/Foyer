<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\RaceRequest;
use App\Race;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

class RacesController extends Controller {

    public function __Construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $races = Race::all();
        return view('races/index')->with('races', $races);
    }

    public function create()
    {
        return view('races/create');
    }

    public function store(RaceRequest $request){
        $input = $request->all();
        $race = Race::create($input);
        $message = str_replace(':name', $race->nameOfTheRace, Lang::get('messages.create_race'));
        flash()->success($message);
        return redirect('races');
    }

    public function edit($id){
        $race = Race::findOrFail($id);
        return view('races/edit', compact('race'));
    }

    public function update($id, RaceRequest $request){
        $race = Race::findOrFail($id);
        $race->update($request->all());
        flash()->success(Lang::get('messages.update_race'));
        return redirect('races');
    }

    public function destroy($id){
        $race = Race::findOrFail($id);
        $race->destroy($id);
        $message = str_replace(':name', $race->nameOfTheRace, Lang::get('messages.delete_race'));
        flash()->success($message);
        return redirect('races');
    }

}
