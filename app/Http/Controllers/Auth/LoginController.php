<?php

namespace App\Http\Controllers\Auth;

use App\Http\Constants\common;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function sendLoginResponse(Request $request)
    {
        try {
            $request->session()->regenerate();

            $this->clearLoginAttempts($request);

            return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->to($this->redirectPath());
        }
        catch (\Exception $ex)
        {
            report($ex);
            return abort(500);
        }

    }

    public function redirectPath()
    {
        try {
            if (method_exists($this, 'redirectTo')) {
                return $this->redirectTo();
            }

            if (Gate::allows(Common::ROLES['SUPER'])) {
                return '/home';
            }

            return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
        }
        catch (\Exception $e)
        {
            report($e);
            return abort(500);
        }
    }

    public function logout(Request $request)
    {
        $roles = Gate::allows(Common::ROLES['SUPER']);
        $this->guard()->logout();
        $request->session()->invalidate();
        if ($roles == true) {
            return $this->loggedOut($request) ?: redirect('/');
        } else
            return $this->loggedOut($request) ?: redirect('/home');
    }
}
