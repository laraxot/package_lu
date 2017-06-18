@extends('adm_theme::layouts.app')
@section('page_heading','lista diritti')

@section('content')
    @include('backend::includes.flash')
    @include('backend::includes.components')

{!! Form::bsOpen($row, 'store') !!}

<h1> Crea un nuovo permesso</h1>
    <table class="table">
        <thead>
          <th>Nome permesso</th>
          <th>Implicito</th>
          <th>Livello</th>
        </thead>
        <tbody>
            <tr>
                <td>{{ Form::bsText('right_define_name')}}</td>
                <td>{{ Form::bsText('has_implied')}}</td>
                <td>{{ Form::bsText('has_level')}}</td>
            </tr>
        </tbody>
    </table>
    {{ Form::bsSubmit('Crea permesso') }}
{{ Form::close() }}
@endsection
