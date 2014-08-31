@if ($errors->any())
<div class="alert alert-danger">
 <ul>
    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
</ul>
</div>
@endif


{{ Form::open(array('route' => 'workpackages.store', 'class' => 'form-horizontal')) }}

<div class="form-group">
    <label class="col-sm-2  control-label">
        Libellé <span class="symbol required"></span>
    </label>
    <div class="col-sm-9">
      {{ Form::text('workpackageLibelle', Input::old('workpackageLibelle'), array('class'=>'form-control', 'placeholder'=>'Entrer un libellé...')) }}
  </div>
</div>
<div class="form-group">
    <label class="col-sm-2  control-label">
        Prix de vente <span class="symbol required"></span>
    </label>
    <div class="col-sm-9">
      {{ Form::text('prix', Input::old('prix'), array('class'=>'form-control', 'placeholder'=>'Entrer un prix de vente...')) }}
  </div>
</div>
<div class="form-group">
    <label class="col-sm-2  control-label">
        Contrat <span class="symbol required"></span>
    </label>
    <div class="col-sm-9">
        <select class="form-control input-sm" id="instanciation_id" name="instanciation_id">
            <option selected disabled>Selectionner un contrat</option>
            @foreach ($instanciations as $instanciation)
            <option value={{{ $instanciation->id }}}>{{{ $instanciation->contrat->contratCode }}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2  control-label">
        Services <span class="symbol required"></span>
    </label>
    <div class="col-sm-7">
        <div id="ms"></div>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">&nbsp;</label>
    <div class="col-sm-10">
        {{ Form::submit('Ajouter', array('class' => 'btn btn-green')) }}
    </div>
</div>
{{ Form::close() }}


