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
				<a href="{{ URL::route('contacts.index') }}">
					Contacts
				</a>
			</li>
			<li class="active">
				{{ $contact->contactNom }} {{ $contact->contactPrenom }}
			</li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-5">
						@forelse ($contact->applications as $application)
						<div class="space20 padding-5 border-bottom border-dark">
							<h4 class="pull-left no-margin space5">Application</h4>
							<div class="clearfix"></div>
							<span class="text-dark">{{ $application->applicationCode }}</span>
						</div>
						@empty
						<div class="space20 padding-5 border-bottom border-dark">
							<h4 class="pull-left no-margin space5">Application</h4>
							<div class="clearfix"></div>
							<span class="text-dark">Il n'y a pas d'applications</span>
						</div>
						@endforelse
					</div>							
					<div class="col-md-7">
						<div class="space20 padding-5 border-bottom border-dark">
							<h4 class="pull-left no-margin space5">Nom</h4>
							<div class="clearfix"></div>
							<span class="text-dark">{{ $contact->contactNom }}</span>
						</div>
						<div class="space20 padding-5 border-bottom border-dark">
							<h4 class="pull-left no-margin space5">Prénom</h4>
							<div class="clearfix"></div>
							<span class="text-dark">{{ $contact->contactPrenom }}</span>
						</div>
						<div class="space20 padding-5 border-bottom border-dark">
							<h4 class="pull-left no-margin space5">Adresse</h4>
							<div class="clearfix"></div>
							<span class="text-dark">{{ $contact->adresse->numero }} {{ $contact->adresse->rue }} </br> {{ $contact->adresse->codepostal }} </br> {{ $contact->adresse->ville }}</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 space20">
						<a href="{{ URL::route('applications.create') }}" class="btn btn-green">Ajouter <i class="fa fa-plus"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
