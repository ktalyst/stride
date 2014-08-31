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
                Tache externe
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
                {{ Form::open(array('route' => 'tacheexternes.store', 'class' => 'form-horizontal')) }}

                <div class="form-group">
                    <label class="col-sm-2  control-label">
                        Code <span class="symbol required"></span>
                    </label>
                    <div class="col-sm-9">
                      {{ Form::text('tacheExterneCode', Input::old('tacheExterneCode'), array('class'=>'form-control', 'placeholder'=>'Entrer un code...')) }}
                  </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2  control-label">
                    Libellé <span class="symbol required"></span>
                </label>
                <div class="col-sm-9">
                  {{ Form::text('tacheExterneLibelle', Input::old('tacheExterneLibelle'), array('class'=>'form-control', 'placeholder'=>'Entrer un libellé...')) }}
              </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">&nbsp;</label>
            <div class="col-sm-10">
                {{ Form::submit('Ajouter', array('class' => 'btn btn-green')) }}
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>
</div>
@stop



