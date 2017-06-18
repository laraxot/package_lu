@extends('adm_theme::layouts.app')
@section('page_heading','lista diritti')

@section('content')
    @include('backend::includes.flash')
    @include('backend::includes.components')

    <table class="table">
        <thead>
        <th>ID permesso</th>
        <th>ID area</th>
        <th>Nome permesso</th>
        <th>Implicito</th>
        <th>Livello</th>
        <th>Azioni</th>
        </thead>
        <tbody>
        @foreach($rows as $row)
            <tr>
                <td>{{ $row->right_id}}</td>
                <td>{{ $row->area_id}}</td>
                <td>{{ $row->right_define_name}}</td>
                <td>{{ $row->has_implied}}</td>
                <td>{{ $row->has_level}}</td>
                <td>{!! Form::bsBtnEdit(['id_right'=>$row->right_id]) !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $rows->links() }}
@endsection
