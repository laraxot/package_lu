@extends('adm_theme::layouts.app')
@section('page_heading','Modifica Gruppi Utente')

@section('content')
@include('backend::includes.flash')
@include('backend::includes.components')

@include('lu::admin.user.edit.nav')

{{-- per update ci vuole id_area .. --}}

{!! Form::bsOpen($rows,'index','store') !!}

{{-- Form::bsMultiSelect('group_id',$rows->get(),$rows->first()->full()->get()) --}}
{{ Form::bsMultiSelect('group_id',$user->groups,lu::groups() ) }}

{{Form::submit('Salva ed esci',['class'=>'submit btn btn-success green-meadow'])}}

{!! Form::close() !!}

@endsection
