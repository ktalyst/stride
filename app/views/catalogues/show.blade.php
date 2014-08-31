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
				<a href="{{ URL::route('catalogues.index') }}">
					Catalogues
				</a>
			</li>
			<li class="active">
				{{ $catalogue->catalogueCode }}
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
						@forelse ($catalogue->services as $service)
						<div class="space20 padding-4 border-bottom border-dark">
							<h4 class="pull-left no-margin space5">Service {{ $service->serviceCode }}</h4>
							<div class="clearfix"></div>
							<span class="text-dark">{{ $service->serviceLibelle }} </span><a class="btn btn-green btn-xs" href="{{ URL::route('services.edit', $service->id) }}"><i class="fa fa-plus"></i></a>
						</div> 
						@empty
						<div class="space20 padding-5 border-bottom border-dark">
							<h4 class="pull-left no-margin space5">Service</h4>
							<div class="clearfix"></div>
							<span class="text-dark">Il n'y a pas de services</span>
						</div>
						@endforelse
					</div>							
					<div class="col-md-7">
						<div class="space20 padding-5 border-bottom border-dark">
							<h4 class="pull-left no-margin space5">Code</h4>
							<div class="clearfix"></div>
							<span class="text-dark">{{ $catalogue->catalogueCode }}</span>
						</div>
						<div class="space20 padding-5 border-bottom border-dark">
							<h4 class="pull-left no-margin space5">Libellé</h4>
							<div class="clearfix"></div>
							<span class="text-dark">{{ $catalogue->catalogueLibelle }}</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 space20">
						<a href="{{ URL::route('catalogues.edit', $catalogue->id) }}" class="btn btn-green">Ajouter des services <i class="fa fa-plus"></i></a>
					</div>
				</div>
                
			</div>
		</div>
	</div>
</div>
@stop
