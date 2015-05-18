<?php namespace App\Http\Middleware;

use Closure;
use App\Registrant;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;

class RedirectIfNotAdmin {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */

    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

	public function handle($request, Closure $next)
	{
        if ($this->auth->check()) {
            $registrant = Registrant::where('email', $this->auth->user()->email)->get()->first();
            $segment = $request->segments();
            if (array_key_exists(3, $segment)) {
                if (!$registrant->isAdmin && $segment[3] != $registrant->user_id) {
                    return redirect('/participations/user/' . $registrant->user_id);
                    //'/participations/user/{userid}/'
                }
            }else {
                if (!$registrant->isAdmin){
                    return redirect('/participations/user/' . $registrant->user_id);
                    //return redirect('participations/' . $registrant->user_id . '/show');
                }
            }
        }
		return $next($request);
	}

}
