@extends('adm_theme::layouts.app')
@section('page_heading','lista gruppi')
@section('content')
@include('backend::includes.flash')
@include('backend::includes.components')
{!! Form::bsBtnCreate() !!}
{!! Form::bsFormSearch() !!}

<table class="table">
@foreach($rows as $row)
<tr>
	<td>{{ $row->group_id}}</td>
	<td>{{ $row->group_type}}</td>
	<td>{{ $row->group_define_name}}</td>
	<td>{{ $row->owner_user_id}}</td>
	<td>{{ $row->owner_group_id}}</td>
	<td>{{ $row->is_active}}</td>

	<td>{!! Form::bsBtnCrud(['id_group'=>$row->group_id]) !!}</td>
</tr>
@endforeach
</table>
{{ $rows->links() }}
@endsection
