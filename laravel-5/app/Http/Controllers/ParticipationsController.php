<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Participation;
use App\User;
use App\Race;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Database\Query;

class ParticipationsController extends Controller {

    public function __Construct(){
        $this->middleware('auth');
    }

	public function index(){
        $participations = Participation::all();
        $years = Participation::select('year')->groupBy('year')->get()->fetch('year');
        $distances = Race::select('distance')->groupBy('distance')->get()->fetch('distance');
        return view('participations/index', compact('participations', 'years', 'distances'));
    }


    public function race($id){
        $race = Race::findOrFail($id);
        $participations = $race->participations;
        return view('participations/race', compact('race', 'participations'));
    }

    public function user($id){
        $user = User::findOrFail($id);
        $participations = $user->participations;
        return view('/participations/user', compact('user', 'participations'));
    }
    public function edit($id, $year){
        $participation = Participation::where('user_id' , $id)->where('year', $year)->get()->first();
        return view('participations/edit', compact('participation'));
    }

    public function update($id, $year, Request $request){
        $participation = Participation::where('user_id' , $id)->where('year', $year)->get()->first();
        $participation->update(['race_id' => $participation->race_id, 'year' => $year, 'user_id' => $id,
            'raceNumber' => $participation->raceNumber, 'chipNumber' => $participation->chipNumber,
            'time' => $participation->time, 'paid' => $request->input('paid'),
            'wiredTransfer' => $request->input('wiredTransfer'),
            'signedUpOnline' => $participation->signedUpOnline]);
        flash()->success(Lang::get('messages.update_participation'));
        return redirect('participations');
    }

    public function filter(Request $request)
    {
        if ($request->ajax()) {
            $years = $request->input('years');
            $distances = $request->input('distances');
            $query = null;
            if ($distances) {
                $query = Participation::join('races', 'participations.race_id', '=', 'races.id')
                    ->whereIn('distance', $distances);
            }
            if ($years) {
                if ($query) {
                    $query = $query->whereIn('year', $years);
                } else {
                    $query = Participation::whereIn('year', $years);
                }
            }
            if ($query) {
                $participations = $query->get();
            } else {
                $participations = Participation::all();
            }
            $years = Participation::select('year')->groupBy('year')->get()->fetch('year');
            $distances = Race::select('distance')->groupBy('distance')->get()->fetch('distance');
            return view('participations.table', compact('participations', 'years', 'distances'));
        }
    }
}
