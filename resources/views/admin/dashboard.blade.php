@extends('adminlte::page')

@section('plugins.Chartjs', true)

@section('title', 'Admin Panel')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <livewire:admin />
@stop