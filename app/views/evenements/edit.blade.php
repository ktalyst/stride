@extends('layouts.template')

@include('layouts.top_bar')

@include('layouts.menu_horizontal')

@include('layouts.toolbar')

@section('main')

<div class="container" style="background:white; width=110%">
    <div class="noteWrap col-md-8 col-md-offset-2">
        <h3>Modifier un évènement</h3>
        {{ Form::model($evenement, array('class' => 'form-horizontal', 'method' => 'PATCH', 'route' => array('evenements.update', $evenement->id))) }}
        <div class="form-group">
            {{ Form::text('titre', Input::old('titre'), array('class'=>'event-name form-control', 'placeholder'=>'Titre')) }}
        </div>
        <div class="form-group">
            {{ Form::text('date', Input::old('date'), array('class'=>'form-control', 'id'=>'datetimepicker', 'placeholder'=>'Date')) }}
        </div>
        <div class="form-group">
            {{ Form::text('dateFin', Input::old('dateFin'), array('class'=>'form-control', 'id'=>'datetimepickerfin', 'placeholder'=>'DateFin')) }}
        </div>
        <div class="form-group">
            <select name="categorie" class="form-control" value="{{ Input::old('categorie') }}">
                <option value="to do" selected="selected">to do</option>
                <option value="note">note</option>
                <option value="réunion">réunion</option>
                <option value="milestone">milestone</option>
            </select>
        </div>
        <div class="form-group">
          {{ Form::textarea('text', Input::old('text'), array('class'=>'form-control', 'rows'=>'3', 'placeholder'=>'Text')) }}
        </div>
        <div class="form-group">
            {{ Form::submit('Enregistrer', array('class' => 'btn btn-green')) }}
            {{ Form::submit('Fermer', array('class' => 'btn btn-green')) }}
        </div>
    </div>
</div>
{{ Form::close() }}

@stop