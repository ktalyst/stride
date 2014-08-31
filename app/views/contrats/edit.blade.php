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
                <a href="{{ URL::route('accueil') }}">
                    Contrats
                </a>
            </li>
            <li>
                <a href="{{ URL::route('accueil') }}">
                    {{ $contrat->contratCode }}
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
                <h4 class="panel-title">Remplir les <span class="text-bold">unit workload</span></h4>
            </div>
            <div class="panel-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                    </ul>
                </div>
                @endif
                {{ Form::model($contrat, array('class' => 'form-horizontal', 'method' => 'PATCH', 'route' => array('contrats.update', $contrat->id))) }}
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
                            <input name="input[{{{$cpt}}}][unitworkload]" placeholder="UW" type="text">
                            <input name="input[{{{$cpt}}}][srtype_id]" type="hidden" value="{{{ $t->id }}}">
                            <input name="input[{{{$cpt}}}][srcomplexite_id]" type="hidden" value="{{{ $c->id }}}">
                            <input name="input[{{{$cpt}}}][service_id]" type="hidden" value="{{{ $s->id }}}">
                            <input name="input[{{{$cpt}}}][datecontrat_id]" type="hidden" value="{{{ $inst->datecontrat_id }}}">
                        </td>
                        @endforeach
                        @endforeach
                    </tr>
                    @endforeach
                    @endif
                    @endforeach

                </table>
                <br>
                {{ Form::submit('Create', array('class' => 'btn btn-green')) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop

