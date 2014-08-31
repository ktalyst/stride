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
<div class="col-md-8 col-md-offset-2">
    @if(Session::has('message'))
    {{Session::get('message')}}
    @endif
    {{ Form::open(array('route' => 'Users.store', 'class' => 'form-contributor')) }}  
    <h3>Ajouter un nouveau contributeur</h3>
    <div class="row">          
        <div class="col-md-6" style="padding-right:40px;">
            <div class="form-group">
                <input class="contributor-id hide" type="text">
                <label class="control-label">
                    Nom <span class="symbol required"></span>
                </label>
                {{ Form::text('userNom', Input::old('userNom'), array('class'=>'form-control contributor-firstname', 'placeholder'=>'Insérez le nom')) }}
            </div>
            <div class="form-group">
                <label class="control-label">
                    Prénom <span class="symbol required"></span>
                </label>
                {{ Form::text('userPrenom', Input::old('userPrenom'), array('class'=>'form-control contributor-lastname', 'placeholder'=>'Insérez le prénom')) }}
            </div>
            <div class="form-group">
                <label class="control-label">
                    Adresse email<span class="symbol required"></span>
                </label>
                {{ Form::text('email', Input::old('email'), array('class'=>'form-control contributor-email', 'placeholder'=>'Champ de texte')) }}
            </div>
            <div class="form-group">
                <label class="control-label">
                    Mot de passe <span class="symbol required"></span>
                </label>
                {{ Form::input('password', 'password', '', array('class'=>'form-control contributor-password')) }}
            </div>
            <div class="form-group">
                <label class="control-label">
                    Confirmer le mot de passe <span class="symbol required"></span>
                </label>
                {{ Form::input('password', 'password_confirmation', '', array('class'=>'form-control contributor-password')) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">
                    Matricule <span class="symbol required"></span>
                </label>
                {{ Form::text('userMatricule', Input::old('userMatricule'), array('class'=>'form-control contributor-firstname', 'placeholder'=>'Insérer le matricule')) }}    
            </div>
            <div class="form-group">
                <label class="control-label">
                    Pseudonyme <span class="symbol required"></span>
                </label>
                {{ Form::text('username', Input::old('username'), array('class'=>'form-control contributor-firstname', 'placeholder'=>'Insérer le pseudo')) }}    
            </div>
            <div class="form-group">
                <label class="control-label">
                    Fonction <span class="symbol required"></span>
                </label>
                {{ Form::text('userFonction', Input::old('userFonction'), array('class'=>'form-control', 'placeholder'=>'Insérer la fonction')) }}
            </div>
            <div class="form-group">
                <label class="control-label">
                    Statut <span class="symbol required"></span>
                </label>
                <select name="userStatut" class="form-control contributor-permits" >
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                    <option value="ustilisateur">Utilisateur</option>
                </select>
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

{{ Form::close() }}

@stop


