<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Participation extends Model {

    protected $fillable = array('year','raceNumber','chipNumber','time','paid','wiredTransfer','signedUpOnline');

    public function user(){
        return $this->hasOne('User');
    }

    public function race(){
        return $this->hasOne('Race');
    }

}
