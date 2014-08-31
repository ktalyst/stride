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
				Contacts
			</li>
			<li class="active">
				Domaine
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
						@forelse ($domaine->users as $user)
						<div class="space20 padding-5 border-bottom border-dark">
							<h4 class="pull-left no-margin space5">{{ $user->username }}</h4>
							<div class="clearfix"></div>
							<span class="text-dark">{{ $user->userNom }} {{ $user->userPrenom }}</span>
						</div>
						@empty
						<div class="space20 padding-5 border-bottom border-dark">
							<h4 class="pull-left no-margin space5">Contributeur</h4>
							<div class="clearfix"></div>
							<span class="text-dark">Il n'y a pas de contributeurs</span>
						</div>
						@endforelse
					</div>							
					<div class="col-md-7">
						<div class="space20 padding-5 border-bottom border-dark">
							<h4 class="pull-left no-margin space5">Code</h4>
							<div class="clearfix"></div>
							<span class="text-dark">{{ $domaine->domaineCode }}</span>
						</div>
						<div class="space20 padding-5 border-bottom border-dark">
							<h4 class="pull-left no-margin space5">Libellé</h4>
							<div class="clearfix"></div>
							<span class="text-dark">{{ $domaine->domaineLibelle }}</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 space20">
						<a href="{{ URL::route('allocation') }}" class="btn btn-green">Ajouter <i class="fa fa-plus"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
