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
				Contributeurs
			</li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Liste des <span class="text-bold">Contributeurs</span></h4>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12 space20">
						<a href="{{ URL::route('Users.create') }}" class="btn btn-green"><span class="fa fa-plus"></span> Ajouter</a>
					</div>
				</div>
				@if ($users->count())
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Nom</th>
							<th>Prénom</th>
							<th>Mail</th>
							<th>Fonction</th>
							<th>Statut</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($users as $user)
						<tr>
							<td>{{{ $user->userNom }}}</td>
							<td>{{{ $user->userPrenom }}}</td>
							<td>{{{ $user->mail }}}</td>
							<td>{{{ $user->userFonction }}}</td>
							<td>
								{{ Form::model($user, array('class' => 'form-horizontal', 'method' => 'PATCH', 'route' => array('Users.update', $user->id))) }}
								<div class="col-md-6">
								<div class="col-md-6">	
								<select name="userStatut" class="form-control contributor-permits" >
									<option value="admin">Admin</option>
									<option value="manager">Manager</option>
									<option value="responsable">Responsable</option>
									<option value="utilisateur">Contributeur</option>
								</select>
							</div>
								<div class="col-md-3">	
								<a class="btn btn-xs btn-green" ><i class="fa fa-share"></i></a>
							</div>
								</div>
								{{ Form::close() }}
							</td>
							<td>
								{{ link_to_route('Users.edit', 'Noter', array($user->id), array('class' => 'edit-row')) }}
								{{ link_to_route('Users.edit', 'Supprimer', array($user->id), array('class' => 'delete-row')) }}
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@else
				There are no users
				@endif
			</div>
		</div>
	</div>
</div>

@stop
