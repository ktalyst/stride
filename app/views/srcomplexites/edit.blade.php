@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h1>Edit Srcomplexite</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::model($srcomplexite, array('class' => 'form-horizontal', 'method' => 'PATCH', 'route' => array('srcomplexites.update', $srcomplexite->id))) }}

        <div class="form-group">
            {{ Form::label('srcomplexiteCode', 'SrcomplexiteCode:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('srcomplexiteCode', Input::old('srcomplexiteCode'), array('class'=>'form-control', 'placeholder'=>'SrcomplexiteCode')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('srcomplexiteLibelle', 'SrcomplexiteLibelle:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('srcomplexiteLibelle', Input::old('srcomplexiteLibelle'), array('class'=>'form-control', 'placeholder'=>'SrcomplexiteLibelle')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('contrat_id', 'Contrat_id:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::input('number', 'contrat_id', Input::old('contrat_id'), array('class'=>'form-control')) }}
            </div>
        </div>


<div class="form-group">
    <label class="col-sm-2 control-label">&nbsp;</label>
    <div class="col-sm-10">
      {{ Form::submit('Update', array('class' => 'btn btn-lg btn-primary')) }}
      {{ link_to_route('srcomplexites.show', 'Cancel', $srcomplexite->id, array('class' => 'btn btn-lg btn-default')) }}
    </div>
</div>

{{ Form::close() }}

@stop