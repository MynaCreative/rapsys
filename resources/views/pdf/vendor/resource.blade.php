@extends('layouts.pdf')

@php $title = 'Vendor'; @endphp

@section('title', $title)

@section('showPage', true)

@section('content')
<header>
    <h1>{{ $title }}</h1>
    <table class="export-info">
        <tr>
            <th>Exported By</th>
            <th>:</th>
            <td>{{ auth()->user()->name ?? '' }}</td>
        </tr>
        <tr>
            <th>Exported At</th>
            <th>:</th>
            <td>{{ now()->format('Y-m-d H:i:s') }}</td>
        </tr>
    </table>
</header>
<table class="table-bordered" width="100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Code</th>
            <th>Name</th>
            <th>Type</th>
            <th>SBU</th>
            <th>Sites</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rows as $index => $row)
        <tr>
            <td>{{ $index+1 }}</td>
            <td>{{ $row->code }}</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->type }}</td>
            <td>{{ $row->sbu->name ?? '' }}</td>
            <td>{{ json_encode($row->sites->pluck('name')) }}</td>
            <td>{{ $row->created_at->format('Y-m-d H:i:s') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection