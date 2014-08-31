@extends('layouts.template')

@include('layouts.top_bar')

@include('layouts.menu_horizontal')

@include('layouts.toolbar')

@section('main')

<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li>
                <a href="{{ URL::route('accueil') }}">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ URL::route('catalogues.index') }}">
                    Catalogues
                </a>
            </li>
            <li>
                <a class="active">
                    Ajout
                </a>
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Ajouter un <span class="text-bold">Catalogue</span></h4>
            </div>
            <div class="panel-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                    </ul>
                </div>
                @endif
                <div class="col-md-8 col-md-offset-2">
                    <div class="row">
                        <div class="col-md-12 space20">
                            <button onclick="addRow()" class="btn btn-green add-row">
                                Ajouter des services <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    {{ Form::open(array('route' => 'catalogues.store', 'class' => 'form-horizontal')) }}
                    <div class="form-group">
                        <label class="col-sm-2  control-label">
                            Code <span class="symbol required"></span>
                        </label>
                        <div class="col-sm-9">
                            {{ Form::text('catalogueCode', Input::old('catalogueCode'), array('class'=>'form-control', 'placeholder'=>'Entrer un code...')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2  control-label">
                            Libellé 
                        </label>
                        <div class="col-sm-9">
                            {{ Form::text('catalogueLibelle', Input::old('catalogueLibelle'), array('class'=>'form-control', 'placeholder'=>'Entrer un libellé...')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2  control-label">
                            Description
                        </label>
                        <div class="col-sm-9">
                            {{ Form::textarea('catalogueDescription', Input::old('catalogueDescription'), array('class'=>'form-control', 'rows' => '3', 'placeholder'=>'Entrer une description...')) }}
                        </div>
                    </div>

                    <table class="table display" id="table">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Libellé</th>                          
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </br>
                {{ Form::submit('Enregistrer tout', array('class' => 'btn btn-green')) }}
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script type="text/javascript">
var count = -1;
function addRow() {
    count++;
    $('#table').dataTable().fnAddData( [
        '<input type="text" name="services['+count+'][code]">',
        '<input type="text" name="services['+count+'][libelle]">',] );  
}
</script>
@stop


