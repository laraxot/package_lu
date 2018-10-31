@extends('adm_theme::layouts.app')
@section('page_heading','Modifica Diritti Utente')

@section('content')
@include('backend::includes.flash')
@include('backend::includes.components')

@include('lu::admin.user.edit.nav')

{{-- per update ci vuole id_area .. --}}
{!! Form::bsOpen($rows,'index','store') !!}

{{-- dd($user->allRights()) --}}
{{ Form::bsMultiSelect('right_id',$user->rights,$user->allRights()) }}
{{--
--}}
{{Form::submit('Salva ed esci',['class'=>'submit btn btn-success green-meadow'])}}

{!! Form::close() !!}

@endsection
