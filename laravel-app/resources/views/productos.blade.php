@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    <h1>Gestión de Productos</h1>
@stop

@section('content')
    @livewire('producto-manager')
@stop

@section('css')
    @livewireStyles
@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Productos page loaded');
            
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