@extends('adm_theme::layouts.app')
@section('page_heading','lista utenti')
@section('content')
@include('backend::includes.flash')
@include('backend::includes.components')
{!! Form::bsBtnCreate() !!}
{!! Form::bsFormSearch() !!}
<h3>N Records: {{ $rows->total() }}</h3>
<table class="table">
<thead>
<tr>
	<th>ID</th>
	<th>Handle</th>
	<th>Cognome</th>
	<th>Nome</th>
	<th>Email</th>
	<th>Last Login</th> 
	<th></th>

</tr>
</thead>
<tbody>
@foreach($rows as $row)
<tr>
	<td>{{ $row->auth_user_id}}</td>
	<td>{{ $row->handle}}</td>
	<td>{{ $row->cognome}}</td>
	<td>{{ $row->nome}}</td>
	<td>{{ $row->email}}</td>
	<td>at: {{ $row->last_login_at }}<br/>
		ip: {{ $row->last_login_ip }}</td>
	<td>{!! Form::bsBtnCrud(['user'=>$row]) !!}</td>

</tr>
@endforeach
</tbody>
</table>
{{ $rows->links() }}
@endsection
