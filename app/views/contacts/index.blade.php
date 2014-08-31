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
				<h4 class="panel-title">Liste des <span class="text-bold">Contacts</span></h4>
			</div>

			<div class="panel-body">

				@if ($contacts->count())
				<table class="table display" id="table">
					<thead>
						<tr>
							<th>Nom</th>
							<th>Prenom</th>
							<th>Client</th>
							<th>Statut</th>
							<th>Actions</th>
						</tr>
					</thead>

					<tbody>
						@foreach ($contacts as $contact)
						<tr>
							<td>{{{ $contact->contactNom }}}</td>
							<td>{{{ $contact->contactPrenom }}}</td>
							<td>{{{ $contact->client['clientNom'] }}}</td>
							<td>
								@if(count($contact->applications)) 
								<span class="label label-sm label-success">Actif</span>
								@else  
								<span class="label label-sm label-inverse">En attente</span>
								@endif
							</td>
							<td>
								<a href="{{ URL::route('contacts.show', $contact->id) }}" class="btn btn-xs btn-green tooltips"><i class="fa fa-share"></i></a>
								<a href="#" class="btn btn-xs btn-red tooltips" id="{{$contact->id}}"><i class="fa fa-times fa fa-white"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@else
				There are no contacts
				@endif
				</div>
			</div>

		</div>
	</div>
</div>
				@stop
@section('script')
<script type="text/javascript">
$(function(){ 
	$('.btn-red').click(function(e) {
		if(confirm('Voulez vous vraiment supprimer ce contact ?')) {
			e.preventDefault();
			$.ajax({
				url: 'contacts/' + $(this).attr('id'),
				type: 'delete'
			})
			.done(function(data) { 
				$('#' + data["0"]).parents('tr').remove();
			});
		}
		else return false;
	});
});
</script>
@stop