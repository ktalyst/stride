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
				Service Requests
			</li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Liste des <span class="text-bold">Service Request</span></h4>
			</div>

			<div class="panel-body">
				@if ($demandeclients->count())
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Code</th>
							<th>Etat</th>
							<th>Date de début</th>
							<th>Date de Fin</th>
							<th>Commande</th>
							<th>Application</th>
							<th>&nbsp;</th>
						</tr>
					</thead>

					<tbody>
						@foreach ($demandeclients as $demandeclient)
						<tr>
							<td>{{{ $demandeclient->demandeclientCode }}}</td>
							<td>{{{ $demandeclient->demandeclientEtat }}}</td>							
							<td>{{{ $demandeclient->dateDebut }}}</td>
							<td>{{{ $demandeclient->dateFinprevue }}}</td>
							<td>{{{ $demandeclient->item->commande->commandeCode }}}</td>
							<td>{{{ $demandeclient->application->applicationCode }}}</td>
							<td>
								<a href="{{ URL::route('demandeclients.show', $demandeclient->id) }}" class="btn btn-green">Affecter</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@else
				There are no service requests
				@endif
				</br></br>
				<a href="{{ URL::route('demandeclients.create') }}" class="btn btn-green">Ajouter</a>
			</div>
		</div>
	</div>
</div>
@stop

