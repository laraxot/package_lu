@extends('adm_theme::layouts.app')
@section('page_heading','Carica un nuovo modulo')

@section('content')
    @include('backend::includes.flash')
    @include('backend::includes.components')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
    {{ Form::checkbox('active', 1,false) }}
    {{ Form::bsSubmit('Carica') }}
{{ Form::close() }}
@endsection
