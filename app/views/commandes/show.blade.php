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
				<a href="{{ URL::route('commandes.index') }}">
					Commandes
				</a>
			</li>
			<li class="active">
				{{ $commande->commandeCode }}
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
						@forelse ($commande->items as $item)
						<div class="space20 padding-4 border-bottom border-dark">
							<h4 class="pull-left no-margin space5"> {{ $item->itemCode }}</h4>
							<div class="clearfix"></div>
							<span class="text-dark">{{ $item->itemLibelle }}</span>
						</div>
						@empty
						<div class="space20 padding-5 border-bottom border-dark">
							<h4 class="pull-left no-margin space5">item</h4>
							<div class="clearfix"></div>
							<span class="text-dark">Il n'y a pas de items</span>
						</div>
						@endforelse
					</div>							
					<div class="col-md-7">
						<div class="space20 padding-5 border-bottom border-dark">
							<h4 class="pull-left no-margin space5">Code</h4>
							<div class="clearfix"></div>
							<span class="text-dark">{{ $commande->commandeCode }}</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
