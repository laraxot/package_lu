@extends('adm_theme::layouts.app')
@section('page_heading','lista diritti')
@section('section')
@include('backend::includes.flash')
@include('backend::includes.components')

<table class="table">
@foreach($rows as $row)
<tr>
	<td>{{ $row->right_id}}</td>
	<td>{{ $row->area_id}}</td>
	<td>{{ $row->right_define_name}}</td>
	<td>{{ $row->has_implied}}</td>
	<td>{{ $row->has_level}}</td>
	<td>{!! Form::bsBtnEdit(['id_right'=>$row->right_id]) !!}</td>
</tr>
@endforeach
</table>
{{ $rows->links() }}
@endsection