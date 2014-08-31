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
                Assignation
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Assigner des <span class="text-bold">Contributeurs</span></h4>
            </div>
            {{ Form::open(array('route' => 'allocation', 'class' => 'form-horizontal')) }}
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2  control-label">
                        Domaine <span class="symbol required"></span>
                    </label>
                    <div class="col-sm-5">
                        <select class="form-control input-sm" id="domaine_id" name="domaine_id">
                            <option selected disabled>Selectionner un domaine</option>
                            <?php $domaines = Domaine::all(); ?>
                            @foreach ($domaines as $domaine)
                            <option value={{{ $domaine->id }}}>{{{ $domaine->domaineCode}}} {{{ $domaine->domaineLibelle }}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2  control-label">
                        Responsable <span class="symbol required"></span>
                    </label>
                    <div class="col-sm-5">
                        <select class="form-control input-sm" id="responsable" name="responsable">
                            <option selected disabled>Selectionner un reponsable</option>
                            <?php $users = User::all(); ?>
                            @foreach ($users as $user)
                            <option value={{{ $user->id }}}>{{{ $user->username }}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2  control-label">
                        Contributeurs <span class="symbol required"></span>
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
            </div>
        </div>
    </div>
</div>

{{ Form::close() }}

@stop
@section('script')
<?php $users = User::all(); ?>
<script type="text/javascript">
$(function() {
    var ms = $('#ms').magicSuggest({
      data: [@foreach ($users as $user)
      {id:{{{ $user->id }}} , user:'{{{ $user->username }}}'},
      @endforeach],
      displayField: 'user',
      name: 'users'
  });

});
</script>
@stop