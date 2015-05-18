<?php namespace App\Http\Controllers;
use App\Participation;
use App\Race;
use App\User;
use App\Http\Requests;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
class CsvController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('csv/import');
    }
    public function import(Request $request){
        $file = Input::file('file');
        if($file){
            Excel::load($file, function($reader){
                $reader->each(function($row){
                    $race = Race::where('nameOfTheRace' ,$row->get('naamwedstrijd'))->get()->first();
                    $user = User::where('name', $row->get('naamd'))->where('firstName', $row->get('voornaam'))->get()->first();
                    if (!$race) {
                        $race = new Race(['nameOfTheRace' => $row->get('naamwedstrijd'), 'firstRaceNumber' => '1800',
                            'distance' => $row->get('naamwedstrijd')]);
                        $race->save();
                    }
                    if (!$user) {
                        $user = new User(['name' => $row->get('naamd'), 'firstName' => $row->get('voornaam'), 'clubD' => $row->get('clubd'),
                            'emailAddress' => $row->get('email'), 'isMale' => $row->get('geslacht') =='M'?1:0,
                            'dateOfBirth' => $row->get('gd')->format('d/m/Y'),
                            'address' => $row->get('adres'),'zipCode' => $row->get('postcode'),'city' => $row->get('plaats'),
                            'valNr' => $row->get('valnr'),'shoeBrand' => $row->get('merkschoenen')]);
                        $user->save();
                    }
                    $participation = Participation::where('user_id' , $user->id)->where('year',$row->get('jaar'))->get()->first();
                    if(!$participation){
                        $participation = new Participation(['race_id' => $race->id, 'year' => $row->get('jaar'), 'user_id' => $user->id,
                            'raceNumber' => $row->get('rugnummer'), 'chipNumber' => $row->get('chipnummer'),
                            'time' => $row->get('tijd'), 'paid' => $row->get('betTerPlaatse')=='TRUE'?1:0,
                            'wiredTransfer' => $row->get('gestort')=='TRUE'?1:0,
                            'signedUpOnline' => $row->get('electronisch')=='TRUE'?1:0]);
                        $participation->save();
                    }
                });
            });
            $message = str_replace(':filename', $file->getClientOriginalName(), Lang::get('messages.import'));
            flash()->success($message);
        }else{
            flash()->error(Lang::get('messages.no_file'));
        }
        return view('csv/import');
    }
    public function export($tablename){
        Excel::create($tablename . '_export_' . Carbon::now()->setTimezone('Europe/Brussels')->toDateTimeString(), function($excel) use ($tablename) {
            $excel->sheet('Sheetname', function($sheet) use($tablename){
                if($tablename == 'users'){
                    $users = \App\User::all();
                    $sheet->fromModel($users);
                }elseif($tablename == 'races'){
                    $races = \App\Race::all();
                    $sheet->fromModel($races);
                }elseif($tablename == 'participations'){
                    $participations = \App\Participation::all();
                    $sheet->fromModel($participations);
                }
            });
        })->download('csv');
    }
    public function exportResults($id){
        $race = Race::findOrFail($id);
        $participations = Participation::where('race_id', $race->id)->orderBy('raceNumber', 'asc')->get();
        $users = array();
        $results = Array(array('firstname', 'name', 'dateofbirth', 'time', 'year'));
        foreach ($participations as $participation) {
            $user = User::find($participation['user_id']);
            $users[] = $participation->user;
            $results[] = array($user->firstName, $user->name, $user->dateOfBirth, $participation->time, $participation->year);
        }
        Excel::create('results', function($excel) use($results){
            $excel->sheet('Sheetname', function($sheet) use($results) {
                $sheet->fromArray($results, null, 'A1', false, false);
            });
        })->download('csv');
    }
    public function exportParticipations($id){
        Excel::create('results', function($excel) use($id){
            $excel->sheet('Sheetname', function($sheet) use($id) {
                $user = User::findOrFail($id);
                $participations = $user->participations;
                $sheet->fromModel($participations);
            });
        })->download('csv');
    }
}