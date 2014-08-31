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
				<a href="{{ URL::route('clients.index') }}">
					Clients
				</a>
			</li>
			<li class="active">
				{{ $client->clientNom }}
			</li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Liste des <span class="text-bold">Contacts</span> de {{ $client->clientNom }}</h4>
			</div>
			<div class="panel-body">
				@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						{{ implode('', $errors->all('<li class="error">:message</li>')) }}
					</ul>
				</div>
				@endif
				<div class="row">
					<div class="col-md-12 space20">
						<button onclick="addRow()" class="btn btn-green add-row">
							Ajouter <i class="fa fa-plus"></i>
						</button>
					</div>
				</div>
				{{ Form::open(array('route' => 'contacts.store', 'class' => 'form-horizontal')) }}
				<input type="hidden" name="client" value="{{ $client->id }}">
				<table class="table display" id="table">
					<thead>
						<tr>
							<th>Nom du contact</th>
							<th>Prénom du contact</th>	
							<th>Adresse</th>						
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($client->contacts as $contact)
						<tr id="contact{{{$contact->id}}}">
							<td>{{{ $contact->contactNom }}}</td> 
							<td>{{{ $contact->contactPrenom }}}</td>	
							<td>{{{ $contact->adresse->numero }}} {{{ $contact->adresse->rue }}} {{{ $contact->adresse->codepostal }}} {{{ $contact->adresse->ville }}}</td>														
							<td><a href="{{ URL::route('contacts.show', $contact->id) }}" class="btn btn-xs btn-green tooltips"><i class="fa fa-share"></i></a></td>
						</tr>
						@empty
						@endforelse
					</tbody>
				</table>
				</br>
				{{ Form::submit('Enregistrer tout', array('class' => 'btn btn-green')) }}
			</div>
		</div>
	</div>
</div>
{{ Form::close() }}
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script type="text/javascript">
var count = -1;
function addRow() {
	count++;
	$('#table').dataTable().fnAddData( [
		'<input type="text" name="contacts['+count+'][nom]">',
		'<input type="text" name="contacts['+count+'][prenom]">',
		'<input type="text" style="margin:2px !important;" placeholder="Numero" name="contacts['+count+'][adresse][numero]"><input type="text" placeholder="Rue" style="margin:2px !important;" name="contacts['+count+'][adresse][rue]"><input type="text" placeholder="Code postal" style="margin:2px !important;" name="contacts['+count+'][adresse][codepostal]"><input type="text" style="margin:2px !important;" placeholder="Ville" name="contacts['+count+'][adresse][ville]">',
		''] );	
}
</script>
@stop
