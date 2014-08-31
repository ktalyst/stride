@extends('layouts.template')

@include('layouts.top_bar')

@include('layouts.menu_horizontal')

@include('layouts.toolbar')

@section('main')
<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    Dashboard
                </a>
            </li>
            <li class="active">
                {{ trans('menu.accueil') }}
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-body">
                <div class="jumbotron">
                    <h1>{{ trans('menu.accueil') }}</h1>
                    <p class="lead">
                        
                    </p>

                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>
    </div>
</div>
@stop
