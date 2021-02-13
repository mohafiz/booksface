@extends('adminlte::page')

@section('plugins.Datatables', true)

@section('title', 'New Users')

@section('content_header')
    <h1>List of new users</h1>
@stop

@section('content')

    <livewire:admin-new-users />

@stop