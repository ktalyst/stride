@extends('layouts.template')

@include('layouts.top_bar')

@include('layouts.menu_horizontal')

@include('layouts.toolbar')

@section('main')
<div class="row">
    <div class="col-md-10 col-md-offset-2">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                {{ implode('', $errors->all('<li class="error">:message</li>')) }}
            </ul>
        </div>
        @endif
    </div>
</div>
<div class="container full" style="padding-bottom:20px;">
    <div class="col-md-8 col-md-offset-2">
        @if(Session::has('message'))
        {{Session::get('message')}}
        @endif
        {{ Form::model($user, array('class' => 'form-horizontal', 'method' => 'PATCH', 'route' => array('Users.update', $user->id))) }}
        <h3>Modifier le profil</h3>
        <div class="row">          
            <div class="col-md-6" style="padding-right:40px;">
                <div class="form-group">
                    <input class="contributor-id hide" type="text">
                    <label class="control-label">
                        Nom 
                    </label>
                    <input class="form-control contributor-firstname" placeholder="Nom" name="userNom" type="text" value="{{ Auth::user()->userNom }}">
                </div>
                <div class="form-group">
                    <label class="control-label">
                        Prénom 
                    </label>
                    <input class="form-control contributor-lastname" placeholder="Prenom" name="userPrenom" type="text" value="{{ Auth::user()->userPrenom }}">
                </div>
                <div class="form-group">
                    <label class="control-label">
                        Adresse email
                    </label>
                    <input class="form-control contributor-email" placeholder="Champ de texte" name="email" type="text" value="{{ Auth::user()->email }}">
                </div>
                <div class="form-group">
                    <label class="control-label">
                        Mot de passe de l'adresse email
                    </label>
                    <input class="form-control contributor-password" name="mdpmail" type="password" value="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">
                        Mot de passe 
                    </label>
                    {{ Form::input('password', 'password', '', array('class'=>'form-control contributor-password')) }}
                </div>
                <div class="form-group">
                    <label class="control-label">
                        Confirmer le mot de passe 
                    </label>
                    {{ Form::input('password', 'password_confirmation', '', array('class'=>'form-control contributor-password')) }}
                </div>
                <div class="form-group">
                    <label class="control-label">
                        Matricule 
                    </label>

                    <input class="form-control contributor-firstname" placeholder="Insérer le matricule" name="userMatricule" type="text" value="{{ Auth::user()->userMatricule }}">   
                </div>
                <div class="form-group">
                    <label class="control-label">
                        Pseudonyme
                    </label>
                    {{ Form::text('username', Input::old('username'), array('class'=>'form-control contributor-firstname', 'placeholder'=>'Insérer le pseudo')) }}    
                </div>
                <div class="form-group">
                    <label class="control-label">
                        Fonction
                    </label>
                    <input class="form-control" placeholder="Insérer la fonction" name="userFonction" type="text" value="{{ Auth::user()->userFonction }}">
                </div>
            </div>
        </div>
        <div class="pull-left">
            <div class="btn-group">
                <a href="#" class="btn btn-green">
                    Close
                </a>
            </div>
            <div class="btn-group">
                <button class="btn btn-green" type="submit">
                    Save
                </button>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}

@stop