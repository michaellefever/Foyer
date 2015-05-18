<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model {

    protected $fillable = array('nameOfTheRace','firstRaceNumber','distance');

    public function participations(){
        return $this->hasMany('App\Participation');
    }
}
