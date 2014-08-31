@if ($errors->any())
<div class="alert alert-danger">
   <ul>
        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
    </ul>
</div>
@endif

{{ Form::open(array('route' => 'tachetransverses.store', 'class' => 'form-horizontal')) }}

<div class="form-group">
    <label class="col-sm-2  control-label">
        Code <span class="symbol required"></span>
    </label>
    <div class="col-sm-9">
        {{ Form::text('tachetransverseCode', Input::old('tachetransverseCode'), array('class'=>'form-control', 'placeholder'=>'Entrer un code...')) }}
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2  control-label">
        Libellé 
    </label>
    <div class="col-sm-9">
        {{ Form::text('tachetransverseLibelle', Input::old('tachetransverseLibelle'), array('class'=>'form-control', 'placeholder'=>'Entrer un libellé...')) }}
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2  control-label">
        Pourcentage <span class="symbol required"></span>
    </label>
    <div class="col-sm-9">
        {{ Form::text('tachetransversePourcentage', Input::old('tachetransversePourcentage'), array('class'=>'form-control', 'placeholder'=>'Entrer un pourcentage...')) }}
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">&nbsp;</label>
    <div class="col-sm-10">
        {{ Form::submit('Ajouter', array('class' => 'btn btn-green')) }}
    </div>
</div>
{{ Form::close() }}



