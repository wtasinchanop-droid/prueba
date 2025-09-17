@extends('adminlte::page')

@section('title', 'Detalle de Factura')

@section('content_header')
    <h1>Detalle de Factura #{{ $factura->id }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-file-invoice"></i>
                    Factura #{{ $factura->id }}
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" onclick="window.print()">
                        <i class="fas fa-print"></i> Imprimir
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Información del Cliente</h5>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Nombre:</strong></td>
                                <td>{{ $factura->cliente->nombre }}</td>
                            </tr>
                            <tr>
                                <td><strong>Código:</strong></td>
                                <td>{{ $factura->cliente->codigo }}</td>
                            </tr>
                            <tr>
                                <td><strong>Teléfono:</strong></td>
                                <td>{{ $factura->cliente->numeroTelefono }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5>Información del Producto</h5>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Producto:</strong></td>
                                <td>{{ $factura->producto->producto }}</td>
                            </tr>
                            <tr>
                                <td><strong>Stock Disponible:</strong></td>
                                <td>{{ $factura->producto->cantidad }}</td>
                            </tr>
                            <tr>
                                <td><strong>Fecha de Factura:</strong></td>
                                <td>{{ $factura->created_at->format('d/m/Y H:i:s') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('facturas') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Volver a Facturas
                </a>
            </div>
        </div>
    </div>
</div>
@stop