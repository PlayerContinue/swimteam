<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class LoginController extends Controller
{
    
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if(auth::check()){
            return "true1";
            
        }

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return "true";//redirect()->intended('dashboard');
        }else{
            return "false";
        }
    }
    
    /**
     * Handle a logout request
     * @param Request $request
     */
    public function logout1(Request $request){
        Auth::logout();
        return "true";
    }
    
   /* private $loginProxy;

    public function __construct(LoginProxy $loginProxy)
    {
        $this->loginProxy = $loginProxy;
    }

    public function login(LoginRequest $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');

        return $this->response($this->loginProxy->attemptLogin($email, $password));
    }

    public function refresh(Request $request)
    {
        return $this->response($this->loginProxy->attemptRefresh());
    }

    public function logout()
    {
        $this->loginProxy->logout();

        return $this->response(null, 204);
    }*/
}
