@extends('adm_theme::layouts.app')
@section('page_heading','events list')

@section('content')
@include('backend::includes.flash')
@include('backend::includes.components')

<table class="table">
	<thead>
		<tr>
			<td>Vendor</td>
			<td>Pack</td>
			<td>Name</td>
			<td></td>
		</tr>
	</thead>
@foreach($events as $event)
<tr>
	<td>{{ $event->vendor }}</td>
	<td>{{ $event->pack }}</td>
	<td>{{ $event->name }}</td>
	<td>
		<a href="{{ route('lu.event.edit',$event->namespace) }}" class="btn btn-primary">
			<i class="fa fa-eye"></i>
		</a>
	</td>
</tr>
@endforeach
</table>

@endsection