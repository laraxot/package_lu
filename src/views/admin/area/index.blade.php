@extends('adm_theme::layouts.app')
@section('page_heading','lista aree')

@section('content')
@include('backend::includes.flash')
@include('backend::includes.components')

<div style="text-align:center"><a href="{{route('lu.area.sync',$params)}}" class="btn btn-small btn-info"  data-toggle="tooltip" title="Sincronizza Aree con Packages" >
<i class="fa fa-refresh fa-fw" aria-hidden="true"></i>&nbsp;</a></div>

<table class="table">
@foreach($rows as $row)
<tr>
	<td>{{ $row->area_id}}</td>
	<td>{{ $row->application_id}}</td>
	<td>{{ $row->area_define_name}}</td>
	<td>{!! Form::bsBtnEdit(['id_area'=>$row->area_id]) !!}</td>
</tr>
@endforeach
</table>
{{ $rows->links() }}
@endsection
