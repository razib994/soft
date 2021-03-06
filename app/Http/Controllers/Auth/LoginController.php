<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
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
    protected $redirectTo = RouteServiceProvider::ADMIN_DASHBOARD;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function shologinForm(){
        return view('frontend.pages.login');
    }
    public function login(Request $request)
    {

        // Validate Login Data
        $request->validate([
            'email' => 'required|max:50',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $credentialed = $request->only('username', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            // Authentication passed...
            session()->flash('success', 'Successully Logged in !');
            return redirect()->intended(('admin'));

        } else {
            if (Auth::guard('admin')->attempt($credentialed)) {
                // Authentication passed...
                session()->flash('success', 'Successully Logged in !');
                return redirect()->intended(('admin'));

            }
            // Error ----
            session()->flash('error', 'Invalid email and password');
            return back();
        }
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
