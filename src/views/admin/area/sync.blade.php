@extends('adm_theme::layouts.app')
@section('page_heading','Sincronizza Aree/Packages')

@section('content')
@include('backend::includes.flash')
@include('backend::includes.components')
{{-- per update ci vuole id_area .. --}}

{!! Form::bsOpen($row,'sync','store') !!}
<h3>Add</h3>
{!! Form::bsMultiSelectCollection('add',collect([]),$add) !!}
<h3>Sub</h3>
{!! Form::bsMultiSelectCollection('sub',collect([]),$sub) !!}

{{Form::submit('Salva ed esci',['class'=>'submit btn btn-success green-meadow'])}}

{!! Form::close() !!}

@endsection
