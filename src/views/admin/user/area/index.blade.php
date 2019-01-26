@extends('adm_theme::layouts.app')
@section('page_heading','Modifica Aree Utente')

@section('content')
@include('backend::includes.flash')
@include('backend::includes.components')

@include('lu::admin.user.edit.nav')
{{-- ddd($params) --}}
{{-- per update ci vuole id_area .. --}}
{!! Form::bsOpen($user,'index','store') !!}

{{-- Form::bsMultiSelect('area_id',$user->areas,\XRA\LU\Models\Area::all()) --}}
{{ Form::bsMultiCheckbox('areas') }}


{{Form::submit('Salva ed esci',['class'=>'submit btn btn-success green-meadow'])}}

{!! Form::close() !!}

@endsection
