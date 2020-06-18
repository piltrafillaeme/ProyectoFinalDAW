<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    /* protected $redirectTo = RouteServiceProvider::HOME; */
    public function redirectTo()
    {
        
        // User role
        $clase = Auth::user()->clase;
        
        // Check user role
        switch ($clase) {
            case '0':
                return 'profesor';
                break;
            case '1':
                return 'primero';
                break;
            case '2':
                return 'segundo';
                break;
            case '3':
                return 'tercero';
                break;
            case '4':
                return 'cuarto';
                break;
            case '5':
                return 'quinto';
                break;
            case '6':
                return 'sexto';
                break;
            default:
                return 'alumnas';
                break;
        }
    }

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
}
