@extends('adm_theme::layouts.app')
@section('page_heading','Carica un nuovo modulo')

@section('content')
    @include('backend::includes.flash')
    @include('backend::includes.components')

{{-- Form::open($row, 'upload','postUpload') --}}
{!! Form::open(['method' => 'post', 'route' => 'lu.area.postUpload', 'files' => true]) !!}
<h1> Carica un nuovo plugin</h1>
    <table class="table">
        <thead>
          <th>Inserisci archivio</th>
        </thead>
        <tbody>
            <tr>
              <td>{{ Form::file('file_zip')}}</td>
            </tr>
        </tbody>
    </table>
    {{ Form::label('Attiva subito', false) }}
    {{ Form::checkbox('active', false) }}
    {{ Form::bsSubmit('Carica') }}
{{ Form::close() }}
@endsection
