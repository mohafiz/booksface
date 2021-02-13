@extends('adminlte::page')

@section('plugins.Datatables', true)

@section('title', 'Manage Books')

@section('content_header')
    <h1>Manage Books</h1>
@stop

@section('content')

    <livewire:admin-books />

@stop