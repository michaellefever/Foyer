<?php namespace App\Services;

use App\Registrant;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:registrants',
			'password' => 'required|confirmed|min:6',
		]);
	}

	/**
	 * Create a new admin instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return Registrar
	 */
	public function create(array $data)
	{
		return Registrant::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
		]);
	}

}
