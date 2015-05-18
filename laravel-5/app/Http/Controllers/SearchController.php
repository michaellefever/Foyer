<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Database;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller {

    public function __Construct(){
        $this->middleware('auth');
    }


    public function autocomplete(){

        $term = Input::get('term');

        $results = array();

        $queries = DB::table('users')
            ->where('firstName', 'LIKE', '%'.$term.'%')
            ->orWhere('name', 'LIKE', '%'.$term.'%')
            ->take(5)->get();

        foreach ($queries as $query)
        {
            $results['id'] = $query->id;
            $results['label'] = "$query->firstName $query->name ($query->dateOfBirth)";
            $test[] = $results;
        }
        $test = array_slice($test, 0, 5);
        return response()->json($test);
    }
}
