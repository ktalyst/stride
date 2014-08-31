@extends('layouts.template')

@include('layouts.top_bar')

@include('layouts.menu_horizontal')

@include('layouts.toolbar')

@section('main')

<h1>All Applications</h1>

<p>{{ link_to_route('applications.create', 'Add New Application', null, array('class' => 'btn btn-lg btn-success')) }}</p>

@if ($applications->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th>ApplicationCode</th>
				<th>ApplicationLibelle</th>
				<th>Domaine_id</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($applications as $application)
				<tr>
					<td>{{{ $application->applicationCode }}}</td>
					<td>{{{ $application->applicationLibelle }}}</td>
					<td>{{{ $application->domaine_id }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('applications.destroy', $application->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('applications.edit', 'Edit', array($application->id), array('class' => 'btn btn-info')) }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no applications
@endif

@stop
