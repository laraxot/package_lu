@extends('adm_theme::layouts.app')
@section('page_heading','Test Email')

@section('content')
    @include('backend::includes.flash')
    @include('backend::includes.components')

{!! Form::bsOpen($row, 'store') !!}

{{ Form::bsText('from')}}
{{ Form::bsText('to')}}
{{ Form::bsText('subject')}}
{{ Form::bsTextarea('body')}}

{{ Form::bsSubmit('test email') }}
{{ Form::close() }}
@endsection
