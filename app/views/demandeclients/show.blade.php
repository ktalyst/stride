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
				Service Requests
			</li>
		</ol>
	</div>
</div>
<?php $users = User::all(); ?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Liste des <span class="text-bold">Service Request</span></h4>
			</div>
			<div class="panel-body">
				<div id="users" >
					<h4 class="page-header"></h4>
					{{ Form::open(array('method' => 'post', 'route' => array('allocateResource', $demandeclient->id))) }}
					<div class="box-body table-responsive">
						<h4>Taches transverses</h4>
						<table class="table table-bordered">
							<tbody>
								@foreach($demandeclient->item->commande->contrat->tachetransverses as $tt)
								<tr>
									<td>{{ $tt->tachetransverseCode }}   <a type="button" class="btn btn-green" onClick="adduserTT(this, {{{ $tt->id }}});">Add user</a></td>
									<td>
										<?php
											$pourcentageTT = $tt->tachetransversePourcentage;
											$pourcentageSR = $demandeclient->pourcentage;
											echo($pourcentageTT / 100 * $pourcentageSR);
										?>
									</td>
								</tr>
								@endforeach		
							</tbody>
						</table>
						<h4>Taches de type SR</h4>
						@foreach($demandeclient->services as $service)
						<table class="table table-bordered">
							<thead>
								<tr class="statetablerow">
									<th><i class="fa fa-minus-square-o"></i> {{{ $service->serviceCode }}}</th>
									<?php $tot = 0; 
									foreach($service->tacheservices as $tache)
									{
										$uo = $service->pivot->uo;
										$uw = Unite::where('service_id', '=', $service->id)
										->where('srtype_id', '=', $demandeclient->srtype_id)
										->where('srcomplexite_id', '=', $demandeclient->srcomplexite_id)
										->get()[0]['unitworkload'];
										$p = $tache->tacheservicePourcentage;	
										$tot = $tot + ($uo * $uw * $p / 100);								
									}

									?>
									<th>{{ $tot }}</th>
								</tr>
							</thead>
							<tbody>							
								@foreach($service->tacheservices as $tache)
								<tr>
									<td><i style="margin-left : 20px"></i> {{{ $tache->tacheserviceCode }}}   <a type="button" class="btn btn-green" onClick="adduser(this, {{{ $tache->id }}});">Add user</a></td>
									<?php 
									$uo = $service->pivot->uo;
									$uw = Unite::where('service_id', '=', $service->id)
									->where('srtype_id', '=', $demandeclient->srtype_id)
									->where('srcomplexite_id', '=', $demandeclient->srcomplexite_id)
									->get()[0]['unitworkload'];
									$p = $tache->tacheservicePourcentage;
									?>	
									<td>{{ $uo * $uw * $p / 100}}</td>				
								</tr>
								@endforeach
							</tbody>
						</table>
						@endforeach
					</div>
					<div class="box-footer">
						{{ Form::submit('Create', array('class' => 'btn btn-primary')) }}
						<a href = "{{ URL::route('clients.index') }}" class = 'btn btn-default'>Back</a>
					</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</section>
</div>
</section>				
@stop
@section('script')
<script type="text/javascript">
$('table i.fa.fa-minus-square-o') .click(
	function() {
		$(this) .parents('table') .children('tbody') .toggle();
	}
	)

function adduser(a, num){
	var tr = document.createElement('tr');
	var tdNomuser = document.createElement('td');
	tdNomuser.innerHTML =  "<select class='form-control' id='user' name='taches["+num+"][]'>"+
	"<option selected disabled>Please Select</option>"+
	"@foreach ($users as $user)"+
	"<option value='{{{ $user->id }}}'>{{{ $user->username }}}</option>"+
	"@endforeach"+
	"</select>";
	var tdCharge = document.createElement('td');
	tdCharge.innerHTML = "<input class='form-control' name='taches["+num+"][][]' placeholder='Charge' type='text'>";
	tr.appendChild(tdNomuser);
	tr.appendChild(tdCharge);
	$(a) .parents('tr') .after(tr);
}
function adduserTT(a, num){
	var tr = document.createElement('tr');
	var tdNomuser = document.createElement('td');
	tdNomuser.innerHTML =  "<select class='form-control' id='user' name='tachesTT["+num+"][]'>"+
	"<option selected disabled>Please Select</option>"+
	"@foreach ($users as $user)"+
	"<option value='{{{ $user->id }}}'>{{{ $user->username }}}</option>"+
	"@endforeach"+
	"</select>";
	var tdCharge = document.createElement('td');
	tdCharge.innerHTML = "<input class='form-control' name='tachesTT["+num+"][][]' placeholder='Charge' type='text'>";
	tr.appendChild(tdNomuser);
	tr.appendChild(tdCharge);
	$(a) .parents('tr') .after(tr);
}
</script>

@stop