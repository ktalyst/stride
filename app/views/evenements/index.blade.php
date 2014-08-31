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
				Calendrier
			</li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"> <span class="text-bold">Calendrier</span></h4>
			</div>
			<div class="panel-body">
				<div class="col-md-8 col-md-offset-2">
					<div class="row">
						<div class="col-md-12 space20">
							<a href="{{ URL::route('evenements.create') }}" class="btn btn-green add-row">
								Ajouter un évenement <i class="fa fa-plus"></i>
							</a>
						</div>
					</div>
					<div id='calendar'></div>
				</div>
			</div>
		</div>
	</div>
</div>

@stop
@section('script')
<script>
jQuery('#calendar').fullCalendar({
	"lang":'fr',
	"height": 600,
	header: {
		left: 'prev,next today',
		center: 'title',
		right: 'month,agendaWeek,agendaDay'
	},
	events: [
	@foreach ($evenements as $evenement)
	{
		title  : '{{{ $evenement->titre }}}',
		start  : '{{{ $evenement->date }}}',
		url    : "{{ URL::route('evenements.edit', array($evenement->id)) }}",
		@if($evenement->dateFin != 0)
		end    : '{{{ $evenement->dateFin }}}'
		@endif
	},
	@endforeach
	],
  	eventClick: function(event) {
  		window.location.href=event.url;
    }
});
</script>
@stop
