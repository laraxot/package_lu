@extends('adm_theme::layouts.app')
@section('page_heading','Modifica Gruppi Utente')

@section('content')
@include('includes.flash')
@include('backend::includes.components')
{{-- per update ci vuole id_area .. --}}

{!! Form::bsOpen($rows,'index','store') !!}
{{dd($rows->get())}}
{{ Form::bsMultiSelect('group_id',$rows->get(),$rows->first()->full()->get()) }}

{{Form::submit('Salva ed esci',['class'=>'submit btn btn-success green-meadow'])}}

{!! Form::close() !!}

@endsection
