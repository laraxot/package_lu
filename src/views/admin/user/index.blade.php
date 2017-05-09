@extends('adm_theme::layouts.app')
@section('page_heading','lista utenti')
@section('content')
@include('backend::includes.flash')
@include('backend::includes.components')
{!! Form::bsFormSearch() !!}
<table class="table">
@foreach($rows as $row)
<tr>
	<td>{{ $row->auth_user_id}}</td>
	<td>{{ $row->handle}}</td>
	<td>{{ $row->cognome}}</td>
	<td>{{ $row->nome}}</td>
	<td>{{ $row->email}}</td>
	<td>{!! Form::bsBtnEdit(['id_user'=>$row->auth_user_id]) !!}</td>

</tr>
@endforeach
</table>

@endsection