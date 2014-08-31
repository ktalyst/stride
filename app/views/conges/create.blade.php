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
                {{ Form::open(array('route' => 'conges.store', 'class' => 'form-horizontal')) }}
                <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
                <div class="form-group">
                    <label class="col-sm-2  control-label">
                        Congés souhaités du <span class="symbol required"></span>
                    </label>
                    <div class="col-sm-9">
                        {{ Form::text('datedebutConge', Input::old('datedebutConge'), array('class'=>'form-control', 'id'=>'datepick', 'placeholder'=>'')) }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2  control-label">
                        Congés souhaités au <span class="symbol required"></span>
                    </label>
                    <div class="col-sm-9">
                        {{ Form::text('datefinConge', Input::old('datedebutConge'), array('class'=>'form-control', 'id'=>'datepick2', 'placeholder'=>'')) }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2  control-label">
                        Nombre de jours ouvrés <span class="symbol required"></span>
                    </label>
                    <div class="col-sm-9">
                      {{ Form::text('congeJours', Input::old('congeJours'), array('class'=>'form-control', 'placeholder'=>'')) }}
                    </div>
                </div>

                <div class="form-group">
                <label class="col-sm-2  control-label">
                    Motifs <span class="symbol required"></span>
                </label>
                <div class="col-sm-9">
                <select name="typeConges" class="form-control contributor-permits">
                    <option value="conges payes">Congés Payés</option>
                    <option value="abscence non remunerée">Anscence Non Rémunérée</option>
                    <option value="conges exceptionnels">Congés exceptionnels</option>
                    <option value="recuperation">Récupération</option>
                </select>
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
@section('script')
<script type="text/javascript">
$(function() {
    $('#datepick').datepicker({
        format: 'yyyy/mm/dd',
    });
    $('#datepick2').datepicker({
        format: 'yyyy/mm/dd',
    });
});
</script>
@stop