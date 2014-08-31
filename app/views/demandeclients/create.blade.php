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
                <a class="active">
                    Catalogue
                </a>
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Ajouter une <span class="text-bold">Service Request</span></h4>
            </div>
            <div class="panel-body">
                {{ Form::open(array('route' => 'demandeclients.store', 'class' => 'form-horizontal')) }}
                <div id="wizard" class="swMain">
                    <ul>
                        <li>
                            <a href="#step-1">
                                <label class="stepNumber">1</label>
                                <span class="stepDesc"> PO
                                    <br>
                                    <small>Sélectionner une commande</small> 
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#step-2">
                                <label class="stepNumber">2</label>
                                <span class="stepDesc"> Application
                                    <br>
                                    <small>Sélectionner une application</small> 
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#step-3">
                                <label class="stepNumber">3</label>                               
                                <span class="stepDesc"> Step 2
                                    <br>
                                    <small>Sélectionner un type de projet</small> 
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#step-4">
                                <label class="stepNumber">4</label>
                                <span class="stepDesc"> Step 3
                                    <br>
                                    <small>Sélectionner une complexité</small> 
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#step-5">
                                <label class="stepNumber">5</label>
                                <span class="stepDesc"> Step 4
                                    <br>
                                    <small>Sélectionner des services</small> 
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#step-6">
                                <label class="stepNumber">6</label>
                                <span class="stepDesc"> Step 5
                                    <br>
                                    <small>Créer la service request</small> 
                                </span>
                            </a>
                        </li>
                    </ul>

                    <div id="step-1">
                        <div class="col-md-10 ">
                            <div class="form-group">
                                <label class="col-sm-3  control-label">
                                    Client <span class="symbol required"></span>
                                </label>
                                <div class="col-sm-9"> 
                                    <select class="form-control" id="client_id">
                                        <option selected disabled>Please Select</option>
                                        <?php $clients = Client::all(); ?>
                                        @foreach ($clients as $client)
                                        <option value={{{ $client->id }}}>{{{ $client->clientNom }}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3  control-label">
                                    Contrat <span class="symbol required"></span>
                                </label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="contrat_id">
                                        <option selected disabled>Please Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3  control-label">
                                    Commande <span class="symbol required"></span>
                                </label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="commande_id">
                                        <option selected disabled>Please Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3  control-label">
                                    Item <span class="symbol required"></span>
                                </label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="item_id" name="item_id">
                                        <option selected disabled>Please Select</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="step-2">
                        <div class="col-md-10 ">
                            <div class="form-group">
                                <label class="col-sm-3  control-label">
                                    Application <span class="symbol required"></span>
                                </label>
                                <div class="col-sm-7">
                                    <select class="form-control input-sm" id="app_id" name="app_id">
                                        <option selected disabled>Selectionner une application</option>
                                        <?php $applications = Application::all(); ?>
                                        @foreach ($applications as $app)
                                        <option value={{{ $app->id }}}>{{{ $app->applicationCode }}} {{{ $app->applicationLibelle }}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="step-3">
                        <div class="form-group">
                            <label class="col-sm-3  control-label">
                                Types <span class="symbol required"></span>
                            </label>
                            <div class="col-sm-7">
                                <select class="form-control input-sm" name="type_id">
                                    <option selected disabled>Selectionner un type</option>
                                    <?php $types = Srtype::all(); ?>
                                    @foreach ($types as $type)
                                    <option value={{{ $type->id }}}>{{{ $type->srtypeCode }}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="step-4" >
                        <div class="col-md-10 ">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">
                                    Complexité <span class="symbol required"></span>
                                </label>
                                <div class="col-sm-7">
                                    <select class="form-control input-sm" id="comp_id" name="comp_id">
                                        <option selected disabled>Selectionner une comp</option>
                                        <?php $comp = Srcomplexite::all(); ?>
                                        @foreach ($comp as $c)
                                        <option value={{{ $c->id }}}>{{{ $c->srcomplexiteCode }}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="step-5">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="form-group">
                            </br>
                            <table class="table table-display">
                                <thead>
                                    <th>Service</th>
                                    <th>Nombre d'UO</th>
                                </thead>
                                <tbody id="service_id">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="step-6">
                    <div class="form-group">
                        <label class="col-sm-3  control-label">
                            Code <span class="symbol required"></span>
                        </label>
                        <div class="col-sm-9">
                            {{ Form::text('demandeclientcode', Input::old('demandeclientcode'), array('class'=>'form-control', 'placeholder'=>'Entrer le code de la service request')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3  control-label">
                            Titre 
                        </label>
                        <div class="col-sm-9">
                            {{ Form::text('demandeclientTitre', Input::old('demandeclientTitre'), array('class'=>'form-control', 'placeholder'=>'Entrer un titre pour la service request')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3  control-label">
                            Date début <span class="symbol required"></span>
                        </label>
                        <div class="col-sm-9">
                            {{ Form::text('dateDebut', Input::old('dateDebut'), array('class'=>' form-control', 'id'=>'datepick', 'placeholder'=>'2014/08/09')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3  control-label">
                            Date de fin prévue <span class="symbol required"></span>
                        </label>
                        <div class="col-sm-9">
                            {{ Form::text('dateFinPrevue', Input::old('dateFinPrevue'), array('class'=>' form-control', 'id'=>'datepick2', 'placeholder'=>'2014/08/09')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::submit('Enregistrer tout', array('class' => 'btn btn-green')) }}
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
</div>
</div> 
@stop
@section('script')
<script type="text/javascript">
$(function() {

    var ms = $('#ms').magicSuggest({
        <?php $services = Service::all(); ?>
        data: [@foreach ($services as $service)
        {id:{{{ $service->id }}} , service:'{{{ $service->serviceCode }}} - {{{ $service->serviceLibelle }}}'},
        @endforeach],
        displayField: 'service',
        name: 'services'
    });
    $('#datepick').datepicker({
        format: 'yyyy/mm/dd',
    });
    $('#datepick2').datepicker({
        format: 'yyyy/mm/dd',
    });
});
jQuery(document).ready(
    function($){
        $('#client_id').change(function(){
            $.get("{{ url('api/dropdowncommande')}}",
                { option: $(this).val() },
                function(data) {
                    var contrat = $('#contrat_id');
                    contrat.empty();
                    contrat.append('<option selected="" disabled="">Please Select</option>');
                    $.each(data, function(index,element) {
                        contrat.append("<option value='"+ index +"''>" + element + "</option>");
                    });
                });
        });
        $('#contrat_id').change(function(){
            $.get("{{ url('api/dropdownpo')}}",
                { option: $(this).val() },
                function(data) {
                    var commande = $('#commande_id');
                    commande.empty();
                    commande.append('<option selected="" disabled="">Please Select</option>');
                    $.each(data, function(index,element) {
                        commande.append("<option value='"+ index +"''>" + element + "</option>");
                    });
                });
        });
        $('#contrat_id').change(function(){
            $.get("{{ url('api/dropdowncatalogue')}}",
                { option: $(this).val() },
                function(data) {
                    var service = $('#service_id');
                    service.empty();
                    service.append('<option selected="" disabled="">Please Select</option>');
                    $.each(data["services"], function(index, element) {
                        var tr = service.append("<tr>");
                        tr.append("<td><input name='service["+index+"][]' type='checkbox' value='" + element['id'] + "' >"+ element['serviceCode']);
                        tr.append("<td><input name='service["+index+"][]' type='text' >");
                    });
                });
        });
        $('#commande_id').change(function(){
            $.get("{{ url('api/dropdownitem')}}",
                { option: $(this).val() },
                function(data) {
                    var item = $('#item_id');
                    item.empty();
                    item.append('<option selected="" disabled="">Please Select</option>');
                    $.each(data, function(index,element) {
                        item.append("<option value='"+ index +"''>" + element + "</option>");
                    });
                });
        });
    });
</script>
@stop


