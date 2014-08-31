@extends('layouts.template')

@include('layouts.top_bar')

@include('layouts.menu_horizontal')

@include('layouts.toolbar')

@section('main')
<?php $users = User::all(); ?>	
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
				@if ($users->count())
				{{ Form::open(array('class' => 'form-horizontal', 'route' => array('periodes.store'))) }}
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Nom</th>
							<th>Prénom</th>
							<th>Mail</th>
							<th>Fonction</th>
							<th>Statut</th>
							<th>Coefficient</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($users as $user)
						<tr>
							<td>{{{ $user->userNom }}}</td>
							<td>{{{ $user->userPrenom }}}</td>
							<td>{{{ $user->mail }}}</td>
							<td>{{{ $user->userFonction }}}</td>
							<td>{{{ $user->userStatut }}}</td>
							<td>							
								<div class="col-md-6">
									<div class="col-md-6">	
										<input name="coefficient[{{$user->id}}]" type="text" value="">
									</div>
								</div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@else
				There are no users
				@endif
				 {{ Form::submit('Enregistrer tout', array('class' => 'btn btn-green')) }}
			</div>
		</div>
	</div>
</div>
{{ Form::close() }}
@stop
