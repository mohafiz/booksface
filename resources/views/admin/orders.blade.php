@extends('adminlte::page')

@section('plugins.Datatables', true)

@section('title', 'Manage Orders')

@section('content_header')
    <h1>Manage Orders</h1>
@stop

@section('content')

    <livewire:admin-orders />

@stop