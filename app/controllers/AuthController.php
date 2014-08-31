<?php

class AuthController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('auth', array('only' => 'getLogout'));
        $this->beforeFilter('guest', array('except' => 'getLogout'));
        $this->beforeFilter('csrf', array('on' => 'post'));
    }

    /**
    * Affiche le formulaire de login
     *
    * @return View
    */
    protected function createView($name)
    {
        return View::make($name); 
    }  

    /**
    * Affiche le formulaire de login
    *
    * @return View
    */
    public function getLogin()
    {
        return View::make('auth.login');
    }

    /**
    * Affiche le formulaire d'inscription
    *
    * @return View
    */
    public function getInscription()
    {
        return $this->createView('auth.inscription');
    }   

    /**
    * Traitement du formulaire de login
    *
    * @return Redirect
    */
    public function postLogin()
    {
        $user = array('username' => Input::get('username'), 'password' => Input::get('password'));
        if (Auth::attempt($user, true)) 
        {
            return Redirect::intended('/')->with('flash_notice', 'You have been successfully connected with the login' . Auth::user()->username);
        }
        return Redirect::to('auth/login')->with('message', Helper::notification('Uername ou mot de passe incorrect','danger'))->withInput();       
    }

    /**
    * Traitement du formulaire d'inscription
    *
    * @return Redirect
    */
    public function postInscription()
    {
        $user = new User; 
        $user->username = Input::get('username'); 
        $user->email = Input::get('email'); 
        $user->password = Hash::make(Input::get('password')); 
        $user->save(); 
        return Redirect::route('accueil')->with('flash_notice', 'Your account has been created.'); 
    }  

    /**
    * Effectue le logout
    *
    * @return Redirect
    */
    public function getLogout()
    {
        Auth::logout(); 
        return Redirect::route('accueil')->with('flash_notice', 'You have been successfully logged out.');
    }

}