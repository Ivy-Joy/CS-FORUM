<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

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

    /**
     * login function
     */
    public function login(HttpRequest $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        if (strstr($request->username, '/')) {
            if (Auth::attempt(['regnumber' => $request->username, 'password' => $request->password])) {
                return redirect()->route('home');
            } else {
                return redirect()->back()
                    ->with('danger', 'Registration Number/username And Password Are Wrong.');
            }
        } else {
            if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
                return redirect()->route('home');
            } else {
                return redirect()->back()
                    ->with('danger', 'Registration Number/username And Password Are Wrong.');
            }
        }
    }
}
