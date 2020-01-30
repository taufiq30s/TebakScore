<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

    // Override Default Function
    public function login(Request $request){
        $this->validate($request, [
            'user' => 'required',
            'password' => 'required',
        ]);

        $input = $request->all();

        $fieldType = filter_var($request->user, FILTER_VALIDATE_EMAIL) ? 'email' : 'idUser';
        if(auth()->attempt(array($fieldType => $input['user'], 'password' => $input['password'])))
        {
            if(auth()->user()->admin) return redirect('/admin');
            else return redirect('/');
        }else{
            return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.');
        }
    }
}
