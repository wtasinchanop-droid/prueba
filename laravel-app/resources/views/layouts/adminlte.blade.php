@extends('adminlte::page')

@section('title', 'Sistema de Gestión')

@section('content_header')
    <h1>@yield('page_title', 'Dashboard')</h1>
@stop

@section('content')
    @yield('page_content')
@stop

@section('css')
    @livewireStyles
    @yield('extra_css')
@stop

@section('js')
    @livewireScripts
    @yield('extra_js')
@stop