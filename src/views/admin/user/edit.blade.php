@extends('adm_theme::layouts.app')
@section('page_heading','Modifica Utente')

@section('content')
@include('backend::includes.flash')
@include('backend::includes.components')

@include('lu::admin.user.edit.nav')

{!! Form::bsOpen($row,'update') !!}

{{ Form::bsText('cognome') }}
{{ Form::bsText('nome') }}
{{ Form::bsText('email') }}
{{ Form::bsText('handle') }}
{{ Form::bsText('passwd') }}

{{-- Form::bsSelect('giust',null,$row->giust_opts()) --}}

{{Form::submit('Salva ed esci',['class'=>'submit btn btn-success green-meadow'])}}
{!! Form::close() !!}

@endsection
