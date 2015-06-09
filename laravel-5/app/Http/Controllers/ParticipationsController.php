<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Participation;
use App\User;
use App\Race;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Carbon\Carbon;
use Illuminate\Support\Collection;

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
        $years = Collection::make($participations->lists('year'))->unique();
        $distances = Collection::make($race->distance);
        return view('participations/race', compact('race', 'participations', 'years', 'distances'));
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
            'time' => $participation->time, 'averageSpeed' => $participation->averageSpeed, 'paid' => $request->input('paid'),
            'wiredTransfer' => $request->input('wiredTransfer'),
            'signedUpOnline' => $participation->signedUpOnline]);
        flash()->success(Lang::get('messages.update_participation'));
        return redirect('participations');
    }


    public function time(){
        $races = Race::all();
        return view('pages/timeregistration', compact('races'));
    }

    public function registertime(Request $request){
        $userid = $request->input('userid');
        $participation = Participation::where('user_id',$userid)->where('year', Carbon::now()->year)->get()->first();
        $html = null;
        $error = null;
        if($participation->race->startTime){
            $start = Carbon::createFromFormat("Y-m-d H:i:s", $participation->race->startTime);
            $end = Carbon::now();
            $differenceInSeconds = $end->diffInSeconds($start);
            $time = gmdate("H:i:s", $differenceInSeconds);
            if(!$participation->time){
                $participation->time = $time;
                $participation->averageSpeed = round(($participation->race->distance/($differenceInSeconds/3600)),2);
                $participation->update();
                $html = "<tr><td>" . $participation->user->firstName ."</td>" . "<td>" . $participation->user->name ."</td>" . "<td>" . $participation->raceNumber . "</td> " .
                    "<td>" . $participation->chipNumber ."</td>" . "<td>" . $participation->time . "</td>" .
                    "<td>" . $participation->averageSpeed ."</td>" . "<td>" . $participation->race->nameOfTheRace . "</td>" . "</tr>";
            }else{
                $error = str_replace(':racenumber', $participation->raceNumber, Lang::get('messages.time_already_registered'));
            }
        }else{
            $error = str_replace(':racename', $participation->race->nameOfTheRace, Lang::get('messages.time_not_started'));
        }
        return response()->json(array($participation->race->id, Participation::where('race_id', $participation->race->id)->whereNotNull('time')->count(), $html, $error));
    }

    public function filter(Request $request){
        $id = $request->input('id');
        $years = $request->input('years');
        $distances = $request->input('distances');
        $sex = $request->input('sex');
        $ageMin = $request->input('ageMin');
        $ageMax = $request->input('ageMax');
        $queryString = $request->input('queryString');
        $column = $request->input('filteropt');
        $query = null;
        if($distances){
            $query = Participation::join('races', 'participations.race_id', '=', 'races.id')
                ->whereIn('distance', $distances);
        }
        if($years){
            if($query){
                $query = $query->whereIn('year', $years);
            }else {
                $query = Participation::whereIn('year', $years);
            }
        }
        if($sex){
            if($query){
                $query = $query->join('users', 'participations.user_id', '=', 'users.id')->whereIn('isMale', $sex);
            }else {
                $query = Participation::join('users', 'participations.user_id', '=', 'users.id')->whereIn('isMale', $sex);
            }
        }
        if($queryString){
            $userids = User::where( $column, 'LIKE', '%'.$queryString.'%')->get()->fetch('id');
            if($query){
                if(!$userids->isEmpty()) {
                    $query = $query->whereIn('user_id', $userids->toArray());
                }
            }else {
                if(!$userids->isEmpty()) {
                    $query = Participation::whereIn('user_id', $userids->toArray());
                }
            }
        }
        if($ageMin > 3 || $ageMax < 100){
            $users = User::all()->filter(function($user) use ($ageMin,$ageMax) {
                if (Carbon::createFromFormat('d/m/Y', $user->dateOfBirth)->between(
                    Carbon::now()->addYears(-$ageMin), Carbon::now()->addYears(-$ageMax))) return true;
            });
            if($query) {
                $query = $query->whereIn('user_id', $users->lists('id'));
            }else{
                $query = Participation::whereIn('user_id', $users->lists('id'));
            }
        }
        if($query){
            if($id){
                $participations = $query->where('race_id', $id)->get();
            }else{
                $participations = $query->get();
            }
        }else{
            if($id){
                $race = Race::findOrFail($id);
                $participations = $race->participations;
            }else{
                $participations = Participation::all();
            }
        }
        $years = Participation::select('year')->groupBy('year')->get()->fetch('year');
        $distances = Race::select('distance')->groupBy('distance')->get()->fetch('distance');
        return view('participations.table', compact('participations', 'years', 'distances'));
    }
}
