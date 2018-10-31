@extends('adm_theme::layouts.app')
@section('page_heading','livello utente')
@section('content')
@include('backend::includes.flash')
@include('backend::includes.components')

@include('lu::admin.user.edit.nav')
@php
	$params['permuser']=$user->perm;
@endphp
{!! Form::bsOpen($user, 'index','update', $params) !!}  {{-- per fare updare bisogna passare id_permuser --}}
	@if(isset($user->perm))
	{{ Form::bsSelect('perm_type', $user->perm->perm_type, ['0' => 0,'1' => 1,'2' => 2,'3' => 3,'4' => 4,'5' => 5]) }}
	@else
		permesso non assegnato
	@endif
	{{Form::submit('Salva ed esci',['class'=>'submit btn btn-success green-meadow'])}}
{{Form::close()}}
@endsection
