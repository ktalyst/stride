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
				Commandes
			</li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Liste des <span class="text-bold">Commandes</span></h4>
			</div>

			<div class="panel-body">

				@if ($commandes->count())
				<table class="table display" id="table">
					<thead>
						<tr>
							<th>Code</th>
							<th>Contrat</th>
							<th>Client</th>
							<th>Montant</th>
							<th>Actions</th>
						</tr>
					</thead>

					<tbody>
						@foreach ($commandes as $commande)
						<tr>
							<td>{{{ $commande->commandeCode }}}</td>
							<td>{{{ $commande->contrat->contratCode }}}</td>
							<td>{{{ $commande->contrat->client->clientNom }}}</td>
							<td></td>
							<td>
								<a href="{{ URL::route('commandes.show', $commande->id) }}" class="btn btn-xs btn-green tooltips"><i class="fa fa-share"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@else
				There are no commandes
				@endif
				</br></br>
				<a href="{{ URL::route('commandes.create') }}" class="btn btn-green">Ajouter</a>
			</div>
		</div>
	</div>
</div>
@stop
