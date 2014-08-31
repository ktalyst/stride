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
            <li class="active">
                Commandes
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Ajouter une <span class="text-bold">Commande</span></h4>
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
                                Ajouter des items <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    {{ Form::open(array('route' => 'commandes.store', 'class' => 'form-horizontal')) }}
                    <div class="form-group">
                        <label class="col-sm-2  control-label">
                            Client <span class="symbol required"></span>
                        </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="client_id" name="client_id">
                                <option selected disabled>Please Select</option>
                                <?php $clients = Client::all(); ?>
                                @foreach ($clients as $client)
                                <option value={{{ $client->id }}}>{{{ $client->clientNom }}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2  control-label">
                            Contrat <span class="symbol required"></span>
                        </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="contrat_id" name="contrat_id">
                                <option selected disabled>Please Select</option>
                                <?php $contrats = Contrat::all(); ?>
                                @foreach ($contrats as $key => $contrat)
                                <!--<option value={{{ $key }}}>{{{ $contrat }}}</option>-->
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2  control-label">
                            Code <span class="symbol required"></span>
                        </label>
                        <div class="col-sm-9">
                            {{ Form::text('code', Input::old('code'), array('class'=>'form-control', 'placeholder'=>'Code')) }}
                        </div>
                    </div>

                    <table class="table display" id="table">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Libelle</th>
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
@stop

@section('script')

<script type="text/javascript">
var count = -1;
function addRow() {
    count++;
    $('#table').dataTable().fnAddData( [
        '<input type="text" name="items['+count+'][code]">',
        '<input type="text" name="items['+count+'][libelle]">',] );  
}
jQuery(document).ready(
    function($){
        $('#client_id').change(function(){
            $.get("{{ url('api/dropdowncommande')}}",
                { option: $(this).val() },
                function(data) {
                    var contrat = $('#contrat_id');
                    contrat.empty();
                    $.each(data, function(index,element) {
                        contrat.append("<option value='"+ index +"''>" + element + "</option>");
                    });
                });
        });
    });
</script>
@stop
