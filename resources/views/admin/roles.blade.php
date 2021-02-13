@extends('adminlte::page')

@section('plugins.Datatables', true)

@section('title', 'Manage Roles')

@section('content_header')
    <h1>Manage roles and permissions</h1>
@stop

@section('content')

    <livewire:admin-roles />

@stop