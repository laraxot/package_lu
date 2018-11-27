@extends('adm_theme::layouts.app')
@section('page_heading','lista aree')

@section('content')
@include('backend::includes.flash')
@include('backend::includes.components')

<div style="text-align:center"><a href="{{route('lu.area.index',array_merge($params,['refresh'=>'1'])) }}" class="btn btn-small btn-info"  data-toggle="tooltip" title="Sincronizza Aree con Packages" >
<i class="fa fa-refresh fa-fw" aria-hidden="true"></i>&nbsp;</a></div>
{!! Form::bsFormSearch() !!}
<table class="table">
<thead>
	<tr>
		<th>Area ID</th>
		<th>Application ID</th>
		<th>Area Define Name</th>
		<th></th>
	</tr>	
</thead>	
@foreach($rows as $row)
<tr>
	<td>{{ $row->area_id}}</td>
	<td>{{ $row->application_id}}</td>
	<td>{{ $row->area_define_name}}</td>
	<td>
		{!! Form::bsBtnCrud(['area'=>$row]) !!}
	</td>
</tr>
@endforeach
</table>
{{ $rows->links() }}

@endsection
