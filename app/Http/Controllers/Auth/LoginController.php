<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use Jenssegers\Agent\Agent;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function showLoginForm()
    {

        $agent = new Agent();
        if($agent->isMobile())
        {
            return view('mobile.auth.login');
        }else{
            return view('auth.login');
        }
    }


    public function login(Request $request)
    {
        // Validate form data
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required|min:8'
        ]);

        $user = User::where($this->username(), $request->{$this->username()})->first();

        if ($user && $user->status == 'inactive') {
            return redirect()->back()->withInput($request->only('username', 'remember'))->with('error', trans('auth.active'));
        }

        // Attempt to log the user in
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
            return $this->sendLoginResponse($request);
            // return redirect()->intended(route('admin.home'));
        }

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        // return $this->sendFailedLoginResponse($request);

        // if unsuccessful
        return redirect()->back()->withInput($request->only('username', 'remember'))->with('error', trans('auth.failed'));
    }

    protected function redirectTo()
    {
        // $user = auth()->user();

        // $agent = new Agent();

        // if($agent->isMobile())
        // {
        //     return redirect('/mobile');
        // }else{
        //     return '/';
        // }


        // if ($user->user_type == 'Administrador') {
        //     return 'admin';
        // } elseif ($user->user_type == 'Prestador') {
        //     return 'radiology';
        // } elseif ($user->user_type == 'Operador') {
        //     return 'operator';
        // } else {
        //     return 'home';
        // }
    }

    function authenticated(Request $request, $user)
    {
        // $user->update([
        //     'last_login_at' => Carbon::now()->toDateTimeString(),
        //     'last_login_ip' => $request->getClientIp()
        // ]);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }

}
