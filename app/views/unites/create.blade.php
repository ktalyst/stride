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
            Unit workload
        </li>
    </ol>
</div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Ajout des<span class="text-bold">units</span></h4>
            </div>
            <div class="panel-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                    </ul>
                </div>
                @endif
                <div class="form-group">
                    {{ Form::label('Contrat - Catalogue:') }} 
                    <select class="form-control input-sm" id="inst" >
                        <option selected disabled>Please Select</option>
                        <?php $instanciations = Instanciation::all(); ?>
                        @foreach ($instanciations as $instanciation)
                        <option value={{{ $instanciation->id }}}>{{{ $instanciation->contrat->contratCode }}} - {{{ $instanciation->catalogue->catalogueCode }}}</option>
                        @endforeach
                    </select>
                </div>
                @if(isset($contrat))
                {{ Form::open(array('route' => 'unites.store')) }}
                <table class="table table-bordered">
                    <tr>
                        <?php $cpt = 0; ?>
                        <th rowspan="2"></th>
                        @foreach($contrat->serviceRequestTypes as $t)
                        <th colspan="{{{ count($contrat->serviceRequestComplexities) }}}">{{{ $t->nom }}}</th>
                        @endforeach
                    </tr>
                    <tr>
                        @foreach($contrat->serviceRequestTypes as $t)
                        @foreach($contrat->serviceRequestComplexities as $c)
                        <td align="center">{{{ $c->nom }}}</td>
                        @endforeach
                        @endforeach
                    </tr>
                    @foreach($catalogue->services as $s)
                    <tr>
                        <td>{{{ $s->nom }}}</td>
                        @foreach($contrat->serviceRequestTypes as $t)
                        @foreach($contrat->serviceRequestComplexities as $c)
                        <?php $cpt++; ?>
                        <td align="center">
                            <input name="input[{{{$cpt}}}][nombre]" placeholder="unit workload" type="text">
                            <input name="input[{{{$cpt}}}][serviceRequestType_id]" type="hidden" value="{{{ $t->id }}}">
                            <input name="input[{{{$cpt}}}][serviceRequestComplexity_id]" type="hidden" value="{{{ $c->id }}}">
                            <input name="input[{{{$cpt}}}][service_id]" type="hidden" value="{{{ $s->id }}}">
                        </td>
                        @endforeach
                        @endforeach
                    </tr>
                    @endforeach
                </table>
                @endif
                <br>
                {{ Form::submit('Create', array('class' => 'btn btn-primary')) }}
                <a class="btn btn-primary" href="{{ URL::previous() }}">Return</a>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop
@section('script')

<script type="text/javascript">
jQuery(document).ready(
    function($){
        $('#inst').change(function(){
            $.get("{{ url('api/dropdowninst')}}",
                { option: $(this).val() },
                function(data) {
                    
                });
        });
    });
</script>
@stop
