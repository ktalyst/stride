@extends('layouts.template')

@include('layouts.top_bar')

@include('layouts.menu_horizontal')

@include('layouts.toolbar')

@section('main')
<style type="text/css">
td{text-align:center}
th{text-align:center}
</style>

<?php
    $taches = User::find(Auth::user()->id)->tachesteps();
?>
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
                <div class="panel-title">Step semaine {{{ date('W') }}} pour la ressource {{{ Auth::user()->username }}}</div>
            </div>   
            <div class="box-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                    </ul>
                </div>
                @endif
                {{ Form::open(array('route' => 'effectuetaches.store', 'class' => 'form-horizontal')) }}
                <table id="tableau" class="table table-bordered">
                  <tr>
                    <th rowspan="2" style="text-align:center">ID ressource</th>
                    <th rowspan="2">Lot</th>
                    <th>{{{ Auth::user()->username }}}</th>
                    <th colspan="4" rowspan="2">Semaine précédente</th>
                    <th colspan="5">Semaine {{{ date('W') }}}</th>
                    <th rowspan="2">Total</th>
                    <th rowspan="2">raf</th>
                    <th rowspan="2">Nouveau reest</th>
                </tr>
                <tr>
                    <td><b>{{{ Auth::user()->username }}}</b></td>
                    <td colspan="5"><b>Constaté en JO</b></td>
                </tr>
                <tr>
                    <th><b>ID tache</b></th>
                    <th>Lot</th>
                    <th><b>Tache</b></th>
                    <th>Init</th>
                    <th>Reest</th>
                    <th>RAF</th>
                    <th>Constate</th>
                    <th><b>L</b></th>
                    <th><b>M</b></th>
                    <th><b>M</b></th>
                    <th><b>J</b></th>
                    <th><b>V</b></th>
                    <th id="total">0</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach($taches as $tache)
                <tr>

                    <td>{{{ $tache->tachestepCode }}}</td>
                    <td>{{{ Demandeclient::find($tache->demandeclient_id)->demandeclientCode }}}</td>
                    <td>{{{ $tache->tachestepLibelle }}}</td>
                    <td>{{{ $tache->chargeInit }}}</td>
                    <td></td>
                    <td><p>{{{ $tache->raf }}}</p></td>
                    <td></td>
                    <td><input class='form-control' onchange="calculTotal(this)" name='charges[lundi][$tache->id][]' placeholder='' size="2" type='text'></td>
                    <td><input class='form-control' onchange="calculTotal(this)" name='charges[mardi][$tache->id][]' placeholder='' size="2" type='text'></td>
                    <td><input class='form-control' onchange="calculTotal(this)" name='charges[mercredi][$tache->id][]' placeholder='' size="2" type='text'></td>
                    <td><input class='form-control' onchange="calculTotal(this)" name='charges[jeudi][$tache->id][]' placeholder='' size="2" type='text'></td>
                    <td><input class='form-control' onchange="calculTotal(this)" name='charges[vendredi][$tache->id][]' placeholder='' size="2" type='text'></td>
                    <td><p name="p"></p></td>
                    <td><p></p></td>
                    <td></td>
                </tr>
                @endforeach
                <tr>
                    <th bgcolor="#cccccc" colspan="3"></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th id="totalL"></th>
                    <th id="totalM"></th>
                    <th id="totalMe"></th>
                    <th id="totalJ"></th>
                    <th id="totalV"></th>
                    <th id="total2">0</th>
                    <th bgcolor="#cccccc"  colspan="2"></th>
                </tr>
            </table>
            <div class="box-footer">
                {{ Form::submit('Create', array('class' => 'btn btn-primary')) }}
                <a href = "{{ URL::previous() }}" class = 'btn btn-default'>Back</a>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
</div>

@stop

@section('script')

<script type="text/javascript">


function calculTotal(input)
{
    var tot = 0;
    var tt = 0;
    var tr = input.parentNode.parentNode;
    var ancienRAF = parseFloat(tr.cells.item(4).firstChild.innerHTML);
    var total = document.getElementById("total");
    var total2 = document.getElementById("total2");
    var tab = document.getElementById("tableau");
    for(var i = 6; i < 11; i++)
    {
        if(!isNaN(parseFloat(tr.cells.item(i).firstChild.value)))
        {
            tot = tot + parseFloat(tr.cells.item(i).firstChild.value);
        }
    }
    tr.cells.item(11).firstChild.innerHTML = tot;
    tr.cells.item(12).firstChild.innerHTML = ancienRAF - tot;
    for(var i = 3; i < tab.rows.length-1; i++)
    {
        var tr = tab.rows.item(i);
        if(!isNaN(parseFloat(tr.cells.item(11).firstChild.innerHTML)))
        {
            tt = tt + parseFloat(tr.cells.item(11).firstChild.innerHTML);
        }

    }
    total.innerHTML = tt;
    total2.innerHTML = tt;

    var L = 0;
    var M = 0; 
    var Me = 0;
    var J = 0; 
    var V = 0;
    var totalL = document.getElementById("totalL");
    var totalM = document.getElementById("totalM");
    var totalMe = document.getElementById("totalMe");
    var totalJ = document.getElementById("totalJ");
    var totalV = document.getElementById("totalV");
    for(var i = 3; i < tab.rows.length-1; i++)
    {
        var tr = tab.rows.item(i);
        if(!isNaN(parseFloat(tr.cells.item(6).firstChild.innerHTML)))
        {
            L = L + parseFloat(tr.cells.item(6).firstChild.innerHTML);
        }
        /*if(!isNaN(parseFloat(tr.cells.item(7).firstChild.innerHTML)))
        {
            M = M + parseFloat(tr.cells.item(7).firstChild.innerHTML);
        }
        if(!isNaN(parseFloat(tr.cells.item(8).firstChild.innerHTML)))
        {
            Me = Me + parseFloat(tr.cells.item(8).firstChild.innerHTML);
        }
        if(!isNaN(parseFloat(tr.cells.item(9).firstChild.innerHTML)))
        {
            J = J + parseFloat(tr.cells.item(9).firstChild.innerHTML);
        }
        if(!isNaN(parseFloat(tr.cells.item(10).firstChild.innerHTML)))
        {
            V = V + parseFloat(tr.cells.item(10).firstChild.innerHTML);
        }*/

    }
    totalL.innerHTML = L;
    totalM.innerHTML = M;
    totalMe.innerHTML = Me;
    totalJ.innerHTML = J;
    totalV.innerHTML = V;

}

</script>
@stop
