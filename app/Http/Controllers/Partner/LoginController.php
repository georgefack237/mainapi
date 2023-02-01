<?php

namespace App\Http\Controllers\Partner;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

   /**
   * Where to redirect admins after login.
   *
   * @var string
   */
   protected $redirectTo = '/partner';

   /**
   * Create a new controller instance.
   *
   * @return void
   */
   public function __construct()
   {
        $this->middleware('guest:partner')->except('logout');
   }

   /**
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
   public function showLoginForm()
   {
        return view('partner.login');
   }

   public function login(Request $request)
   {
       $this->validate($request, [
           'email'   => 'required|email',
           'password' => 'required|min:6'
       ]);
       if (Auth::guard('partner')->attempt([
           'email' => $request->email,
           'password' => $request->password
       ], $request->get('remember'))) {
           return redirect()->intended(route('partner.dashboard'));
       }
       return back()->withInput($request->only('email', 'remember'));
   }

   public function logout(Request $request)
    {
        Auth::guard('partner')->logout();
        $request->session()->invalidate();
        return redirect()->route('partner.login');
    }
}
