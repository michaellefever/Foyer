<?php namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\User;
use App\Registrant;
use App\Race;
use App\Participation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller {

    public function __Construct(){
        $this->middleware('auth',['except' => 'store']);
    }

    public function index()
    {
        $users = User::all()->sortBy('name');
        return view('users/index', compact('users'));
    }

    public function create()
    {
        $races = Race::all();
        if($races->isEmpty()){

        }
        return view('users/create', compact('races'));
    }

    public function store(UserRequest $request){
        $input = $request->all();
        $user = User::create($input);
        if ($user->emailAddress) {
            $password = random_password();
            $registrant = new Registrant(['name' => $user->firstName . ' '. $user->name,'user_id' => $user->id,'email' => $user->emailAddress, 'password' => bcrypt($password)]);
            $registrant->save();
            Mail::send('users.mails.password', array('email' => $registrant->email, 'password' => $password, 'name' => $registrant->name),  function($message) use ($registrant){
                $message->to($registrant->email)->subject('Account info');
            });
        }
        $race = Race::find(Input::get('distance'));
        if($race){
            $participation = new Participation(['race_id'=> $race->id,'year' => Carbon::now()->year,'user_id' => $user->id,
                                                'raceNumber' =>$user->id, 'chipNumber' => 0,
                                                "time"=>Carbon::now(),'paid' => 1,
                                                'wiredTransfer' => 1, 'signedUpOnline' => 1]);
            $user->participations()->save($participation);
        }
        $message = str_replace(':name', $user->firstName . ' '. $user->name, Lang::get('messages.create_user'));
        flash()->success($message);
        return redirect('users');
    }

    public function edit($id){
        $user = User::findOrFail($id);
        $races = Race::all();

        return view('users/edit', compact('user', 'races'));
    }

    public function update($id, UserRequest $request){
        $user = User::findOrFail($id);
        $user->update($request->all());
        $registrant = Registrant::where('user_id', $user->id)->get()->first();
        $updatedUser = $request->all();
        if (!is_null($registrant) && ($updatedUser['emailAddress'])!=''){
            $registrant->email = $updatedUser['emailAddress'];
            $registrant->update();
            $password = random_password();
            Mail::send('users.mails.password', array('email' => $registrant->email, 'password' => $password, 'name' => $registrant->name),  function($message) use ($registrant){
                $message->to($registrant->email)->subject('Account info');
            });
        } elseif (!is_null($registrant) && ($updatedUser['emailAddress'])==''){
            $registrant->destroy($registrant->id);
        } elseif (is_null($registrant) && ($updatedUser['emailAddress'])!=''){
            $password = random_password();
            $registrant = new Registrant(['name' => $user->firstName . ' '. $user->name,'user_id' => $user->id,'email' => $user->emailAddress, 'password' => bcrypt($password)]);
            $registrant->save();
            Mail::send('users.mails.password', array('email' => $registrant->email, 'password' => $password, 'name' => $registrant->name),  function($message) use ($registrant){
                $message->to($registrant->email)->subject('Account info');
            });
        }
        $participation = Participation::where('user_id', $user->id)->get()->first();
        $participation->update(['race_id' => $request->input('distance'), 'year' => Carbon::now()->year,
                                'user_id' => $user->id,'raceNumber' => $user->id, 'chipNumber' => 0,
                                "time"=>Carbon::now(),'paid' => 1, 'wiredTransfer' => 1, 'signedUpOnline' => 1]);
        flash()->success(Lang::get('messages.update_user'));
        return redirect('users');
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $registrant = Registrant::where('user_id', $user->id)->get()->first();
        $user->destroy($id);
        if (!is_null($registrant)) {
            $registrant->destroy($registrant->id);
        }
        $message = str_replace(':name', $user->firstName . ' '. $user->name, Lang::get('messages.delete_user'));
        flash()->success($message);
        return redirect('users');
    }

    public function filter(Request $request){
        if($request->ajax()) {
            $years = $request->input('years');
            $distances = $request->input('distances');
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
            if($query){
                $participations = $query->get();
            }else{
                $participations = Participation::all();
            }
            $years = Participation::select('year')->groupBy('year')->get()->fetch('year');
            $distances = Race::select('distance')->groupBy('distance')->get()->fetch('distance');
            return view('participations.table', compact('participations', 'years', 'distances'));
        }
    }



}
function random_password( $length = 8 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}

