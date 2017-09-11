@extends('adm_theme::layouts.app')
@section('page_heading','Modifica Aree Utente')

@section('content')
@include('backend::includes.flash')
@include('backend::includes.components')

@include('lu::admin.user.edit.nav')

{{-- per update ci vuole id_area .. --}}
{!! Form::bsOpen($rows,'index','store') !!}

{{ Form::bsMultiSelect('area_id',$rows->get(),\XRA\LU\Models\Area::all()) }}

{{Form::submit('Salva ed esci',['class'=>'submit btn btn-success green-meadow'])}}

{!! Form::close() !!}

@endsection
