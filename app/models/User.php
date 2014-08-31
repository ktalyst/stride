<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    protected $table = 'users';
    protected $fillable = array('userNom', 'userPrenom', 'email', 'username', 'userMatricule', 'userFonction', 'userStatut');
    protected $guarded = array('password');

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function getReminderEmail()
    {
        return $this->email;
    }

    public function conges()
    {
        $this->hasMany('Conge');
    }

    public function evenements()
    {
        $this->hasMany('Evenement');
    }

    public function effectuetaches()
    {
        $this->hasMany('Effectuetache');
    }

    public function periodes()
    {
        $this->belongsToMany('Periode');
    }

    public function domaines()
    {
        $this->belongsToMany('Domaine');
    }

    public function tachesteps()
    {
        $this->belongsToMany('Tachestep', 'tachestep_user');
    }

    public function demartement()
    {
        $this->belongsTo('Departement');
    }

    public static $rules = array(
        'username' => 'required|Alpha|between:6,64',
        'email' => 'required|email',
        'password' => 'required|AlphaNum|between:6,20|confirmed'
    );

}
