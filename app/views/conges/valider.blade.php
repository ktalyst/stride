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
				Contacts
			</li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Mes <span class="text-bold">congés</span></h4>
			</div>
			<div class="panel-body">
				@if(Auth::user()->userStatut == 'admin' || Auth::user()->userStatut == 'manager')
				<?php $mesconges = Conge::where('congeStatut','=', 'en attente')->get(); ?>
				@elseif(Auth::user()->userStatut == 'responsable')
				<?php $domaines = Collab::find(Auth::user()->id)->domaines->where('estResponsable', '=', Auth::user()->id); ?>
				@endif
				@if ($mesconges->count())
				{{ Form::open(array('route' => 'conges.valider', 'class' => 'form-horizontal')) }}
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Collaborateur</th>
							<th>Du</th>
							<th>Au</th>
							<th>Type de congé</th>
							<th>Validé</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($mesconges as $conge)
						<tr>
							<td>{{{ $conge->user->username }}}</td>
							<td>{{{ $conge->datedebutConge }}}</td>
							<td>{{{ $conge->datefinConge }}}</td>
							<td>{{{ $conge->typeConges }}}</td>
							<td>                
								<select name="conges[{{ $conge->id }}]" class="form-control contributor-permits">
									<option value="accepte">Accepté</option>
									<option value="refuse">Refusé</option>
									<option value="en attente">En attente</option>
								</select>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@else
				There are no conges
				@endif
				<div class="form-group">
					<label class="col-sm-2 control-label">&nbsp;</label>
					<div class="col-sm-10">
						{{ Form::submit('Valider', array('class' => 'btn btn-green')) }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
{{ Form::close() }}
@stop
