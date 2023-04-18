@extends('layouts.pdf')

@php $title = 'Department'; @endphp

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
    <thead class="bg-head">
        <tr>
            <th class="text-center">#</th>
            <th>Name</th>
            <th>Cost Center</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rows as $index => $row)
        <tr>
            <td class="text-center">{{ $index+1 }}</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->cost_center }}</td>
            <td>{{ $row->created_at->format('Y-m-d H:i:s') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection