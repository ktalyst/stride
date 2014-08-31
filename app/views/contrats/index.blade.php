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
				Contrats
			</li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Liste des <span class="text-bold">Contrats</span></h4>
			</div>
			<div class="panel-body">
				@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						{{ implode('', $errors->all('<li class="error">:message</li>')) }}
					</ul>
				</div>
				@endif
				@if ($contrats->count())
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Code</th>
							<th>Libelle</th>
							<th>Client</th>
							<th>Mise à jour</th>
							<th>Statut</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($contrats as $contrat)
						<tr>
							<td>{{{ $contrat->contratCode }}}</td>
							<td>{{{ $contrat->contratLibelle }}}</td>
							<td>{{{ $contrat->client->clientNom }}}</td>
							<td>
								<?php $update = Instanciation::where('contrat_id', '=', $contrat->id)->first(); ?>
								{{{ $update->datecontrat->dateFin }}}
							</td>
							<td>
								@if($update->datecontrat->dateFin < date('Y-m-d'))
								<span class="label label-sm label-warning">Expiré</span>
								@elseif($update->datecontrat->dateDebut > date('Y-m-d'))
								<span class="label label-sm label-inverse">En attente</span>
								@else
								<span class="label label-sm label-success">Actif</span>
								@endif
							</td>
							<td>
								<a href="{{ URL::route('contrats.edit', $contrat->id) }}" class="btn btn-xs btn-blue tooltips"><i class="fa fa-edit"></i> unit workload</a>
								<a href="{{ URL::route('contrats.show', $contrat->id) }}" class="btn btn-xs btn-green tooltips"><i class="fa fa-share"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@else
				There are no contrats
				@endif
				<div class="row" style="padding-top:10px;">
					<div class="col-md-12 space20">
						<a href="{{ URL::route('contrats.create') }}" class="btn btn-green">Ajouter <i class="fa fa-plus"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
