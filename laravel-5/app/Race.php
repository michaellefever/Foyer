<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model {

    protected $fillable = array('nameOfTheRace','firstRaceNumber');

    public function particpations(){
        return $this->hasMany('Participation');
    }
}
