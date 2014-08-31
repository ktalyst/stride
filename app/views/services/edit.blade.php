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
                <a href="{{ URL::route('services.index') }}">
                    services
                </a>
            </li>
            <li class="active">
                {{ $service->serviceNom }}
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Liste des <span class="text-bold">taches de niveau services</span> du service {{ $service->serviceCode }}</h4>
            </div>
            <div class="panel-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                    </ul>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-12 space20">
                        <button onclick="addRow()" class="btn btn-green add-row">
                            Ajouter <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                {{ Form::open(array('route' => 'tacheservices.store', 'class' => 'form-horizontal')) }}
                <input type="hidden" name="service" value="{{ $service->id }}">
                <table class="table display" id="table">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Libellé</th>  
                            <th>Pourcentage</th>                        
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($service->tacheservices as $tacheservice)
                        <tr id="tacheservice{{{$tacheservice->id}}}">
                            <td>{{{ $tacheservice->tacheserviceCode }}}</td> 
                            <td>{{{ $tacheservice->tacheserviceLibellé }}}</td>    
                            <td>{{{ $tacheservice->tacheservicePourcentage }}}</td>                                                        
                        </tr>
                        @empty
                        @endforelse
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
        '<input type="text" name="tacheservices['+count+'][tacheserviceCode]">',
        '<input type="text" name="tacheservices['+count+'][tacheserviceLibelle]">',
        '<input type="text" name="tacheservices['+count+'][tacheservicePourcentage]">',] );  
}
</script>
@stop
