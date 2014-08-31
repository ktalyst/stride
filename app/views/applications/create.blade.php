@extends('layouts.template')

@include('layouts.top_bar')

@include('layouts.menu_horizontal')

@include('layouts.toolbar')

@section('main')
<?php
    $contacts = Contact::all(); 
    $domaines = Domaine::all();
?>
<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li>
                <a href="{{ URL::route('accueil') }}">
                    Dashboard
                </a>
            </li>
            <li class="active">
                Application
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Ajout d'<span class="text-bold">Application</span></h4>
            </div>
            <div class="panel-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                    </ul>
                </div>
                @endif
                {{ Form::open(array('route' => 'applications.store', 'class' => 'form-horizontal')) }}
                <div class="form-group">
                    <label class="col-sm-2  control-label">
                        Contact <span class="symbol required"></span>
                    </label>
                    <div class="col-sm-9">
                    <select class="form-control input-sm" id="contact_id" name="contact_id">
                        <option selected disabled>Select contact</option>
                        @foreach ($contacts as $contact)
                            <option value={{{ $contact->id }}}>{{{ $contact->contactNom }}} {{{ $contact->contactPrenom }}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2  control-label">
                        Domaine <span class="symbol required"></span>
                    </label>
                    <div class="col-sm-9">
                    <select class="form-control input-sm" id="domaine_id" name="domaine_id">
                        <option selected disabled>Select domaine</option>
                        @foreach ($domaines as $domaine)
                            <option value={{{ $domaine->id }}}>{{{ $domaine->domaineCode}}} {{{ $domaine->domaineLibelle }}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2  control-label">
                        Code <span class="symbol required"></span>
                    </label>
                    <div class="col-sm-9">
                        {{ Form::text('applicationCode', Input::old('applicationCode'), array('class'=>'form-control', 'placeholder'=>'Entrer un code...')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">
                        Libellé 
                    </label>
                    <div class="col-sm-9">
                        {{ Form::text('applicationLibelle', Input::old('applicationLibelle'), array('class'=>'form-control', 'placeholder'=>'Entrer un libellé...')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">&nbsp;</label>
                    <div class="col-sm-10">
                        {{ Form::submit('Ajouter', array('class' => 'btn btn-green')) }}
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@stop


