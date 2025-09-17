<div class="card">
    <div class="card-header">
        <h3 class="card-title">Gestión de Facturas</h3>
    </div>
    <div class="card-body">
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Formulario para crear/editar facturas -->
        <form wire:submit.prevent="save">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="id_producto">Producto</label>
                        <select class="form-control @error('id_producto') is-invalid @enderror" 
                                wire:model="id_producto">
                            <option value="">Seleccionar Producto</option>
                            @foreach($productos as $producto)
                                <option value="{{ $producto->id }}">
                                    {{ $producto->producto }} (Stock: {{ $producto->cantidad }})
                                </option>
                            @endforeach
                        </select>
                        @error('id_producto') 
                            <span class="invalid-feedback">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="codigo_cliente">Cliente</label>
                        <select class="form-control @error('codigo_cliente') is-invalid @enderror" 
                                wire:model="codigo_cliente">
                            <option value="">Seleccionar Cliente</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->codigo }}">
                                    {{ $cliente->nombre }} ({{ $cliente->codigo }})
                                </option>
                            @endforeach
                        </select>
                        @error('codigo_cliente') 
                            <span class="invalid-feedback">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i>
                                {{ $editingId ? 'Actualizar Factura' : 'Crear Factura' }}
                            </button>
                            @if($editingId)
                                <button type="button" class="btn btn-secondary ml-2" wire:click="cancel">
                                    <i class="fas fa-times"></i>
                                    Cancelar
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <hr>

        <!-- Tabla de facturas -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Cliente</th>
                        <th>Teléfono Cliente</th>
                        <th>Fecha Creación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($facturas as $factura)
                        <tr>
                            <td>
                                <span class="badge badge-primary">#{{ $factura->id }}</span>
                            </td>
                            <td>
                                <strong>{{ $factura->producto->producto ?? 'N/A' }}</strong>
                                <br>
                                <small class="text-muted">
                                    Stock disponible: {{ $factura->producto->cantidad ?? 0 }}
                                </small>
                            </td>
                            <td>
                                <strong>{{ $factura->cliente->nombre ?? 'N/A' }}</strong>
                                <br>
                                <small class="text-muted">
                                    Código: {{ $factura->cliente->codigo ?? 'N/A' }}
                                </small>
                            </td>
                            <td>
                                <i class="fas fa-phone text-success"></i>
                                {{ $factura->cliente->numeroTelefono ?? 'N/A' }}
                            </td>
                            <td>
                                <i class="fas fa-calendar text-info"></i>
                                {{ $factura->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('factura.detalle', $factura->id) }}" 
                                       class="btn btn-sm btn-primary"
                                       title="Ver detalle">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button class="btn btn-sm btn-warning" 
                                            wire:click="edit({{ $factura->id }})"
                                            title="Editar factura">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" 
                                            wire:click="delete({{ $factura->id }})"
                                            onclick="return confirm('¿Está seguro de eliminar esta factura?')"
                                            title="Eliminar factura">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <button class="btn btn-sm btn-info" 
                                            onclick="window.print()"
                                            title="Imprimir factura">
                                        <i class="fas fa-print"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                <div class="py-4">
                                    <i class="fas fa-file-invoice fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No hay facturas registradas</h5>
                                    <p class="text-muted">Crea tu primera factura seleccionando un producto y un cliente.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Estadísticas rápidas -->
        @if($facturas->count() > 0)
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-info">
                            <i class="fas fa-file-invoice"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Facturas</span>
                            <span class="info-box-number">{{ $facturas->count() }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-success">
                            <i class="fas fa-users"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Clientes Únicos</span>
                            <span class="info-box-number">{{ $facturas->pluck('codigo_cliente')->unique()->count() }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning">
                            <i class="fas fa-box"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Productos Facturados</span>
                            <span class="info-box-number">{{ $facturas->pluck('id_producto')->unique()->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>