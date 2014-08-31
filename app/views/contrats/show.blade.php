@extends('layouts.template')

@include('layouts.top_bar')

@include('layouts.menu_horizontal')

@include('layouts.toolbar')

@section('main')
<?php $instanciations = Instanciation::where('contrat_id', '=', $contrat->id)->get(); ?>
<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li>
				<a href="{{ URL::route('accueil') }}">
					Dashboard
				</a>
			</li>
			<li>
				<a href="{{ URL::route('contrats.index') }}">
					Contrats
				</a>
			</li>
			<li class="active">
				{{ $contrat->contratCode }}
			</li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<table class="table table-bordered">
					<tr>
						<?php $cpt = 0; ?>
						<th rowspan="2"></th>
						@foreach($contrat->srtypes as $t)
						<th colspan="{{{ count($contrat->srcomplexites) }}}">{{{ $t->srtypeCode }}}</th>
						@endforeach
					</tr>
					<tr>
						@foreach($contrat->srtypes as $t)
						@foreach($contrat->srcomplexites as $c)
						<td align="center">{{{ $c->srcomplexiteCode }}}</td>
						@endforeach
						@endforeach
					</tr>
					@foreach($instanciations as $inst)
					@if($inst->datecontrat->dateFin > date('Y-m-d'))
					@foreach($inst->catalogue->services as $s)
					<tr>
						<td>{{{ $s->serviceCode }}} {{{ $s->serviceLibelle }}} </td>
						@foreach($contrat->srtypes as $t)
						@foreach($contrat->srcomplexites as $c)
						<?php $cpt++; ?>
						<td align="center">
							<?php echo Unite::where('srtype_id', '=', $t->id)->where('srcomplexite_id', '=', $c->id)->where('service_id', '=', $s->id)->where('datecontrat_id', '=', $inst->datecontrat_id)->pluck('unitworkload');?>
						</td>
						@endforeach
						@endforeach
					</tr>
					@endforeach
					@endif
					@endforeach
				</table>
			</div>
		</div>
	</div>
</div>
@stop
