@extends('layouts.template')

@include('layouts.top_bar')

@include('layouts.menu_horizontal')

@include('layouts.toolbar')

@section('main')

@if(Session::get('tab_actif'))
    <?php $tab_actif=Session::get('tab_actif'); ?>
@else
    <?php $tab_actif=1; ?>
@endif

<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li>
                <a href="{{ URL::route('accueil') }}">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ URL::route('contrats.index') }}">
                    Contrats
                </a>
            </li>
            <li class="active">
                Ajout
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-white panel-tabs">
            <div class="panel-heading">
                <h4 class="panel-title">Création d'un <span class="text-bold">Contrat</span></h4>
            </div>
            <div class="panel-body">
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li @if($tab_actif==1)class="active"@endif><a href="#domaine" data-toggle="tab">Domaines</a></li>
                        <li @if($tab_actif==2)class="active"@endif><a href="#type" data-toggle="tab">Service Request Types</a></li>
                        <li @if($tab_actif==3)class="active"@endif><a href="#complexity" data-toggle="tab">Service Request Complexites</a></li>
                        <li @if($tab_actif==4)class="active"@endif><a href="#tasks" data-toggle="tab">Taches transverses</a></li>
                        <li @if($tab_actif==5)class="active"@endif><a href="#contrat" data-toggle="tab">Contrat</a></li>
                        <li @if($tab_actif==6)class="active"@endif><a href="#wp" data-toggle="tab">Work Package</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane @if($tab_actif==1) active @endif" id="domaine" >
                            <div class="col-sm-7 col-md-offset-2">
                                <h4 class="page-header">Ajouter des domaines</h4>
                                @include('domaines.create')
                            </div>
                        </div>
                        <div class="tab-pane @if($tab_actif==2) active @endif" id="type" >
                            <div class="col-sm-7 col-md-offset-2">
                                <h4 class="page-header">Ajouter des types de projets</h4>
                                @include('srtypes.create')
                            </div>
                        </div>
                        <div class="tab-pane @if($tab_actif==3) active @endif" id="complexity" >
                            <div class="col-sm-7 col-md-offset-2">
                                <h4 class="page-header">Ajouter des complexités</h4>
                                @include('srcomplexites.create')
                            </div>
                        </div>
                        <div class="tab-pane @if($tab_actif==4) active @endif" id="tasks" >
                            <div class="col-sm-7 col-md-offset-2">
                                <h4 class="page-header">Ajouter des tâches transverses</h4>
                                @include('tachetransverses.create')
                            </div>
                        </div>
                        <div class="tab-pane @if($tab_actif==5) active @endif" id="contrat" >
                            <div class="col-md-8 col-md-offset-2">
                                <h4 class="page-header">Créer un contrat</h4>
                                <div class="box-body">
                                    <?php
                                    $clients = Client::all(); 
                                    $catalogues = Catalogue::all();
                                    $domaines = Domaine::where('contrat_id')->get();
                                    $srtypes = Srtype::where('contrat_id')->get();
                                    $srcomplexites = Srcomplexite::where('contrat_id')->get();
                                    $tachetransverses = Tachetransverse::where('contrat_id')->get();
                                    $instanciations = Instanciation::all();
                                    ?>
                                    {{ Form::open(array('route' => 'contrats.store', 'class' => 'form-horizontal')) }}
                                    <div class="row">
                                        <div class="col-md-6" style="padding-right:40px;">
                                            <div class="form-group">
                                                <label class="col-sm-3  control-label">
                                                    Client <span class="symbol required"></span>
                                                </label>
                                                <div class="col-sm-9">
                                                    <select class="form-control input-sm" id="client_id" name="client_id">
                                                        <option selected disabled>Selectionner un client</option>
                                                        @foreach ($clients as $client)
                                                        <option value={{{ $client->id }}}>{{{ $client->clientNom }}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3  control-label">
                                                    Catalogues <span class="symbol required"></span>
                                                </label>
                                                <div class="col-sm-9">
                                                    <div id="mscatalogue"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3  control-label">
                                                    Date début <span class="symbol required"></span>
                                                </label>
                                                <div class="col-sm-9">
                                                    {{ Form::text('date', Input::old('date'), array('class'=>' form-control', 'id'=>'datepick', 'placeholder'=>'3014/08/09')) }}
                                                </div>
                                                <span class="help-block">
                                                    <i class="fa fa-info-circle"></i> La date d'update est automatiquement enregistrée et est égale à la date ci dessus auquel s'ajoute un an 
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3  control-label">
                                                    Code <span class="symbol required"></span>
                                                </label>
                                                <div class="col-sm-9">
                                                    {{ Form::text('contratCode', Input::old('contratCode'), array('class'=>'form-control', 'placeholder'=>'Entrer le code du contrat')) }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3  control-label">
                                                    Libellé 
                                                </label>
                                                <div class="col-sm-9">
                                                    {{ Form::text('contratLibelle', Input::old('contratLibelle'), array('class'=>'form-control', 'placeholder'=>'ContratLibelle')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="padding-right:40px;">
                                            <div class="form-group">
                                                <label class="col-sm-3  control-label">
                                                    Domaines <span class="symbol required"></span>
                                                </label>
                                                <div class="col-sm-9">
                                                    <div id="msdomaine"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3  control-label">
                                                    Types de projet <span class="symbol required"></span>
                                                </label>
                                                <div class="col-sm-9">
                                                    <div id="mstype"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3  control-label">
                                                    Complexités <span class="symbol required"></span>
                                                </label>
                                                <div class="col-sm-9">
                                                    <div id="mscomplexity"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3  control-label">
                                                    Taches transverses <span class="symbol required"></span>
                                                </label>
                                                <div class="col-sm-9">
                                                    <div id="mstask"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">&nbsp;</label>
                                        <div class="col-sm-10">
                                            {{ Form::submit('Ajouter', array('class' => 'btn btn-green')) }}
                                        </div>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane @if($tab_actif==6) active @endif" id="wp" >
                            <div class="col-sm-7 col-md-offset-2">
                                <h4 class="page-header">Créer des work package</h4>
                                @include('workpackages.create')
                            </div>
                        </div>    
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
    $('#datepick').datepicker({
        format: 'yyyy/mm/dd',
    });
    var ms = $('#ms').magicSuggest({
        <?php $services = Service::where('workpackage_id')->get(); ?>
        data: [@foreach ($services as $service)
        {id:{{{ $service->id }}} , service:'{{{ $service->serviceCode }}} - {{{ $service->serviceLibelle }}}'},
        @endforeach],
        displayField: 'service',
        name: 'services'
    });
    var ms1 = $('#mscatalogue').magicSuggest({
      data: [@foreach ($catalogues as $key => $catalogue)
      {id:{{{ $catalogue->id }}} , catalogue:'{{{ $catalogue->catalogueCode }}} - {{{ $catalogue->catalogueLibelle }}}'},
      @endforeach],
      displayField: 'catalogue',
      name: 'catalogues'
  });
    var ms2 = $('#mscomplexity').magicSuggest({
        data: [
        @foreach ($srcomplexites as $src) 
        {id:{{{ $src->id }}} , src:'{{{ $src->srcomplexiteCode }}} - {{{ $src->srcomplexiteLibelle }}}'},
        @endforeach],
        displayField: 'src',
        name: 'srcs'
    });
    var ms3 = $('#mstype').magicSuggest({
        data: [
        @foreach ($srtypes as $srt)
        {id:{{{ $srt->id }}} , srt:'{{{ $srt->srtypeCode }}} - {{{ $srt->srtypeLibelle }}}'},
        @endforeach],
        displayField: 'srt',
        name: 'srts'
    });
    var ms4 = $('#msdomaine').magicSuggest({
        data: [
        @foreach ($domaines as $domaine)
        {id:{{{ $domaine->id }}} , domaine:'{{{ $domaine->domaineCode }}} - {{{ $domaine->domaineLibelle }}}'},
        @endforeach],
        displayField: 'domaine',
        name: 'domaines'
    });
    var ms5 = $('#mstask').magicSuggest({
        data: [
        @foreach ($tachetransverses as $tache)
        {id:{{{ $tache->id }}} , tache:'{{{ $tache->tachetransverseCode }}} - {{{ $tache->tachetransverseLibelle }}}'},
        @endforeach],
        displayField: 'tache',
        name: 'taches'
    });
});
</script>
@stop
