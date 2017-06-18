@extends('adm_theme::layouts.app')
@section('page_heading','livello utente')
@section('content')
@include('backend::includes.flash')
@include('backend::includes.components')

{!! Form::bsOpen($row, 'index','update', $params) !!}
	{{ Form::bsSelect('perm_type', $row->perm_type, ['0' => 0,'1' => 1,'2' => 2,'3' => 3,'4' => 4,'5' => 5]) }}
	{{Form::submit('Salva ed esci',['class'=>'submit btn btn-success green-meadow'])}}
{{Form::close()}}
@endsection
