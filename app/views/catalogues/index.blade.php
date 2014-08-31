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
			<li>
				<a class="active">
					Catalogues
				</a>
			</li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Liste des <span class="text-bold">Catalogues</span></h4>
			</div>
			<div class="panel-body">
				@if ($catalogues->count())
				<table class="table display" id="table">
					<thead>
						<tr>
							<th>Code</th>
							<th>Libelle</th>
							<th>Description</th>
							<th>Actions</th>
						</tr>
					</thead>

					<tbody>
						@foreach ($catalogues as $catalogue)
						<tr>
							<td>{{{ $catalogue->catalogueCode }}}</td>
							<td>{{{ $catalogue->catalogueLibelle }}}</td>
							<td>{{{ $catalogue->catalogueDescription }}}</td>
							<td>
								@if(Auth::user()->userStatut == 'admin')<a href="{{ URL::route('catalogues.edit', $catalogue->id) }}" class="btn btn-xs btn-blue tooltips"><i class="fa fa-edit"></i></a>@endif
								<a href="{{ URL::route('catalogues.show', $catalogue->id) }}" class="btn btn-xs btn-green tooltips"><i class="fa fa-share"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@else
				There are no catalogues
				@endif
			</div>
		</div>
	</div>
</div>

@stop