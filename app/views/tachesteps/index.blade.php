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
				Taches
			</li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Liste des <span class="text-bold">Taches</span></h4>
			</div>
			<div class="panel-body">
				@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						{{ implode('', $errors->all('<li class="error">:message</li>')) }}
					</ul>
				</div>
				@endif
				@if(!isset($tache))
				<div class="col-md-8 col-md-offset-2">
					@if ($tachesteps->count())
					<table class="table table-striped table-bordered table-hover table-full-width display"  id="table">
						<thead>
							<tr>
								<th>Code</th>
								<th>Collaborateur</th>
								<th>Chargeinit</th>
								<th>Raf</th>
								<th>Lot</th>
								<th>Application</th>
								<th>Domaine</th>
							</tr>
						</thead>

						<tbody>
							@foreach ($tachesteps as $tachestep)
							<tr>
								<td>{{{ $tachestep->tachestepCode }}}</td>
								<td><?php print_r(Tachestep::find($tachestep->id)->users()); ?></td>
								<td>{{{ $tachestep->chargeinit }}}</td>
								<td>{{{ $tachestep->raf }}}</td>
								<td>{{{ $tachestep->demandeclient_id }}}</td>
								<td>{{{ $tachestep->demandeclient->application }}}</td>
								<td>{{{ $tachestep->demandeclient->application->domaine }}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					@else
					There are no tachesteps
					@endif
				</div>
				@else
				<div class="col-md-8 col-md-offset-2">
					<?php $mestaches = User::find(Auth::user()->id)->tachesteps(); ?>
					@if ($mestaches->count())
					<table class="table table-striped table-bordered table-hover table-full-width display"  id="table">
						<thead>
							<tr>
								<th>Code</th>
								<th>Collaborateur</th>
								<th>Chargeinit</th>
								<th>Raf</th>
								<th>Lot</th>
								<th>Application</th>
								<th>Domaine</th>
							</tr>
						</thead>

						<tbody>
							@foreach ($mestaches as $tachestep)
							<tr>
								<td>{{{ $tachestep->tachestepCode }}}</td>
								<td><?php print_r(Tachestep::find($tachestep->id)->users()); ?></td>
								<td>{{{ $tachestep->chargeinit }}}</td>
								<td>{{{ $tachestep->raf }}}</td>
								<td>{{{ $tachestep->demandeclient_id }}}</td>
								<td>{{{ $tachestep->demandeclient->application }}}</td>
								<td>{{{ $tachestep->demandeclient->application->domaine }}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					@else
					There are no tachesteps
					@endif
				</div>		
				@endif
			</div>
		</div>
	</div>
</div>
@stop
