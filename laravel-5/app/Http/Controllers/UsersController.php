<?php namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Registrant;
use App\Race;
use App\Participation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
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
            $password = $this->random_password();
            $registrant = new Registrant(['name' => $user->firstName . ' '. $user->name,'user_id' => $user->id,'email' => $user->emailAddress, 'password' => bcrypt($password)]);
            $registrant->save();
            /*Mail::send('users.mails.password', array('email' => $registrant->email, 'password' => $password, 'name' => $registrant->name),  function($message) use ($registrant){
                $message->to($registrant->email)->subject('Account info');
            });*/
        }
        $race = Race::find(Input::get('distance'));
        if($race){
            $participation = new Participation(['race_id'=> $race->id,'year' => Carbon::now()->year,'user_id' => $user->id,
                'raceNumber' =>$user->id, 'chipNumber' => 0,
                "time"=>'', "averageSpeed" => null, 'paid' => 0,
                'wiredTransfer' => 0, 'signedUpOnline' => 0]);
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
        if (!is_null($registrant) && ($updatedUser['emailAddress'])!='' && $registrant->email != $updatedUser['emailAddress']){
            $registrant->email = $updatedUser['emailAddress'];
            $registrant->update();
            //$password = $this->random_password();
            /*Mail::send('users.mails.password', array('email' => $registrant->email, 'password' => $password, 'name' => $registrant->name),  function($message) use ($registrant){
                $message->to($registrant->email)->subject('Account info');
            });*/
        } elseif (!is_null($registrant) && ($updatedUser['emailAddress'])==''){
            $registrant->destroy($registrant->id);
        } elseif (is_null($registrant) && ($updatedUser['emailAddress'])!=''){
            $password = $this->random_password();
            $registrant = new Registrant(['name' => $user->firstName . ' '. $user->name,'user_id' => $user->id,'email' => $user->emailAddress, 'password' => bcrypt($password)]);
            $registrant->save();
            /*Mail::send('users.mails.password', array('email' => $registrant->email, 'password' => $password, 'name' => $registrant->name),  function($message) use ($registrant){
                $message->to($registrant->email)->subject('Account info');
            });*/
        }
        $participation = Participation::where('user_id', $user->id)->where('year', Carbon::now()->year)->get()->first();
        if($participation){
            $participation->race_id = $request->input('distance');
            $participation->update();
        }else{
            $participation = new Participation(['race_id'=> $request->input('distance'),'year' => Carbon::now()->year,'user_id' => $user->id,
                'raceNumber' =>$user->id, 'chipNumber' => 0,
                "time"=>'', "averageSpeed" => null, 'paid' => 0,
                'wiredTransfer' => 0, 'signedUpOnline' => 0]);
            $user->participations()->save($participation);
        }
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
            $sex = $request->input('sex');
            $ageMin = $request->input('ageMin');
            $ageMax = $request->input('ageMax');
            $queryString = $request->input('queryString');
            $column = $request->input('filteropt');
            $query = null;
            if($sex){
                $query = User::whereIn('isMale', $sex);
            }
            if($queryString){
                if($query){
                    $query = $query->where( $column, 'LIKE', '%'.$queryString.'%');
                }else{
                    $query = User::where( $column, 'LIKE', '%'.$queryString.'%');
                }
            }
            if($query){
                $users = $query->get();
            }else{
                $users = User::all();
            }
            if($ageMin > 3 || $ageMax < 100){
                $users = $users->filter(function($user) use ($ageMin,$ageMax) {
                    if (Carbon::createFromFormat('d/m/Y', $user->dateOfBirth)->between(
                        Carbon::now()->addYears(-$ageMin), Carbon::now()->addYears(-$ageMax))) return true;
                });
            }
            return view('users.table', compact('users'));
        }
    }

    public function email(Request $request){
        $usersid = $request->input('users');
        if (is_null($usersid)){
            $message = Lang::get('messages.send_mail_danger');
            $alert = "alert alert-danger alert-dismissable";
        } else {
            $message = Lang::get('messages.send_mail_success');
            $alert = "alert alert-success alert-dismissable";
            foreach ($usersid as $id){
                $registrant = Registrant::where('user_id', $id)->get()->first();
                $user = User::findOrFail($usersid)->first();
                if (!is_null($registrant) ){
                    $password = $this->random_password();
                    $registrant->password = bcrypt($password);
                    $registrant->update();
                    Mail::send('users.mails.password', array('email' => $registrant->email, 'password' => $password, 'name' => $registrant->name),  function($message) use ($registrant){
                        $message->to($registrant->email)->subject('Account info');
                    });
                } elseif (is_null($registrant) && !is_null($user->emailAddress)){
                    $password = $this->random_password();
                    $registrant = new Registrant(['name' => $user->firstName . ' '. $user->name,'user_id' => $user->id,'email' => $user->emailAddress, 'password' => bcrypt($password)]);
                    $registrant->save();
                    Mail::send('users.mails.password', array('email' => $registrant->email, 'password' => $password, 'name' => $registrant->name),  function($message) use ($registrant){
                        $message->to($registrant->email)->subject('Account info');
                    });
                }
                else {
                    $message = Lang::get('messages.send_mail_warning');
                    $alert = "alert alert-warning alert-dismissable";
                }
            }
        }

        return response()->json(array('message' => $message, 'alert' => $alert));

    }

    private function random_password( $length = 8 ) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $password = substr( str_shuffle( $chars ), 0, $length );
        return $password;
    }

}
