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
				<?php $mesconges = Conge::where('user_id','=', Auth::user()->id)->get(); ?>
				@if ($mesconges->count())
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Du</th>
							<th>Au</th>
							<th>Type de congé</th>
							<th>Validé</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($mesconges as $conge)
						<tr>
							<td>{{{ $conge->datedebutConge }}}</td>
							<td>{{{ $conge->datefinConge }}}</td>
							<td>{{{ $conge->typeConges }}}</td>
							<td>{{{ $conge->congeStatut }}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@else
				There are no conges
				@endif
			</div>
		</div>
	</div>
</div>
@stop
