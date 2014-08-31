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
				CRJS
			</li>
		</ol>
	</div>
</div>
<?php $crjs = CRJS::all()->first(); ?>
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Modification du <span class="text-bold">CRJS</span></h4>
			</div>
			<form method="POST" action="http://localhost/stride/public/crjs/{{ $crjs->id }}" accept-charset="UTF-8" class="form-horizontal">
			<div class="panel-body">
				<div class="form-group">
					<label class="col-sm-2  control-label">
						CRJS <span class="symbol required"></span>
					</label>
					<div class="col-sm-9">
						<input class="form-control" name="crjs" placeholder="Entrer un chiffre..." type="text" value="{{ $crjs->crjs }}">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-10">
						{{ Form::submit('Ajouter', array('class' => 'btn btn-green envoyer')) }}
					</div>
				</div>
			</div>
			{{ Form::close() }}
		</div>
	</div>
</div>

@stop


