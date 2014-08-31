@extends('layouts.template')

@include('layouts.top_bar')

@include('layouts.menu_horizontal')

@include('layouts.toolbar')

@section('main')

<div class="container full">
    <div class="col-md-8 col-md-offset-2">
        <h3>{{ trans('form.titre-form-evt') }}</h3>
        {{ Form::open(array('route' => 'evenements.store', 'class' => 'form-note')) }}
        <div class="form-group">
            <input class="event-name form-control" placeholder="{{ trans('form.placeholder-evt-1') }}" name="titre" type="text">
        </div>
        <div class="form-group">
            {{ Form::text('date', Input::old('date'), array('class'=>' form-control', 'id'=>'datetimepicker', 'placeholder'=>'2014/08/09 14:00')) }}
        </div>
        <div class="form-group">
            {{ Form::text('dateFin', Input::old('dateFin'), array('class'=>'form-control', 'id'=>'datetimepickerfin', 'placeholder'=>'2014/08/09 14:00')) }}
        </div>
        <div class="form-group">
            <select name="categorie" class="form-control">
                <option value="to do" selected="selected">to do</option>
                <option value="note">note</option>
                <option value="réunion">{{ trans('form.placeholder-evt-2') }}</option>
                <option value="milestone">milestone</option>
            </select>
        </div>
        <div class="form-group">
            <textarea class="form-control" rows="3" placeholder="{{ trans('form.placeholder-evt-3') }}" name="text" cols="50"></textarea>
        </div>
        <div class="form-group">
            <input class="btn btn-green" type="submit" value="{{ trans('form.submit') }}">
        </div>
    </div>
</div>

{{ Form::close() }}

@stop


