@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1>Gestión de Clientes</h1>
@stop

@section('content')
    @livewire('cliente-manager')
@stop

@section('css')
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Clientes page loaded');
            
            // Verificar que Livewire esté disponible
            if (typeof window.Livewire !== 'undefined') {
                console.log('Livewire is available and ready');
                
                // Escuchar eventos de Livewire usando el método correcto
                if (window.Livewire.hook) {
                    window.Livewire.hook('message.processed', () => {
                        console.log('Component refreshed');
                    });
                }
            } else {
                console.error('Livewire not found');
            }
        });
    </script>
@stop