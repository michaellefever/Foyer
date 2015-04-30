<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model{

    protected $fillable = array('name','firstName','clubD','emailAddress','isMale','dateOfBirth', 'birthday',
        'address','zipCode','city','valNr','shoeBrand');

    public function participations(){
        return $this->hasMany('Participation');
    }

}
