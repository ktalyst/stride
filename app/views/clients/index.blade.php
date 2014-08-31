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
				Clients
			</li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Liste des <span class="text-bold">Clients</span></h4>
			</div>
			<div class="panel-body">
				@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						{{ implode('', $errors->all('<li class="error">:message</li>')) }}
					</ul>
				</div>
				@endif
				<div class="col-md-8 col-md-offset-2">
					<div class="row">
						<div class="col-md-12 space20">
							<button onclick="addRow()" class="btn btn-green add-row">
								Ajouter <i class="fa fa-plus"></i>
							</button>
						</div>
					</div>
					{{ Form::open(array('route' => 'clients.store', 'class' => 'form-horizontal')) }}
					<table class="table display" id="table">
						<thead>
							<tr>
								<th>Client</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($clients as $client)
							<tr>
								<td>{{{ $client->clientNom }}}</td>
								<td>
									<a href="{{ URL::route('clients.show', $client->id) }}" class="btn btn-xs btn-green tooltips"><i class="fa fa-share"></i></a>
								</td>
							</tr>
							@empty
							@endforelse
						</tbody>
					</table>
					{{ Form::submit('Enregistrer tout', array('class' => 'btn btn-green')) }}
				</div>
			</div>
		</div>
	</div>
</div>
{{ Form::close() }}

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script type="text/javascript">
function addRow() {
	$('#table').dataTable().fnAddData( [
		'<input type="text" name="clientNom[]">','',] );
}
</script>
@stop
