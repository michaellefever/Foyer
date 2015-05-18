<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\User;

class UserRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
        $user = User::find($this->users);
        $email_rule = 'email|unique:users';
        if($user){
            $email_rule .= ',emailAddress,' .$user->id;
        }
		$rules  = array(
			'name' => 'required|min:2',
            'firstName' => 'required|min:2',
            'isMale' => 'required',
            'emailAddress' => $email_rule,
            'dateOfBirth' => 'required');

        return $rules;
	}

}
