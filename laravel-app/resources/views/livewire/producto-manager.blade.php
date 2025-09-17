<div class="card">
    <div class="card-header">
        <h3 class="card-title">Gestión de Productos</h3>
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

        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Formulario -->
        <form wire:submit.prevent="save">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="producto">Producto</label>
                        <input type="text" class="form-control @error('producto') is-invalid @enderror" 
                               wire:model="producto" placeholder="Nombre del producto">
                        @error('producto') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" class="form-control @error('cantidad') is-invalid @enderror" 
                               wire:model="cantidad" placeholder="Cantidad">
                        @error('cantidad') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="precio_base">Precio Base</label>
                        <input type="number" step="0.01" class="form-control @error('precio_base') is-invalid @enderror" 
                               wire:model="precio_base" placeholder="0.00">
                        @error('precio_base') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="iva_porcentaje">IVA (%)</label>
                        <input type="number" step="0.01" class="form-control @error('iva_porcentaje') is-invalid @enderror" 
                               wire:model="iva_porcentaje" placeholder="15.00">
                        @error('iva_porcentaje') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="precio_con_iva">Precio con IVA</label>
                        <input type="number" step="0.01" class="form-control" 
                               wire:model="precio_con_iva" readonly style="background-color: #f8f9fa;">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            {{ $editingId ? 'Actualizar' : 'Guardar' }}
                        </button>
                        @if($editingId)
                            <button type="button" class="btn btn-secondary" wire:click="cancel">
                                Cancelar
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </form>

        <!-- Tabla de productos -->
        <div class="table-responsive mt-4">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Base</th>
                        <th>IVA (%)</th>
                        <th>Monto IVA</th>
                        <th>Precio con IVA</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($productos as $prod)
                        <tr>
                            <td>{{ $prod->id }}</td>
                            <td>{{ $prod->producto }}</td>
                            <td>{{ $prod->cantidad }}</td>
                            <td>${{ number_format($prod->precio_base, 2) }}</td>
                            <td>{{ number_format($prod->iva_porcentaje, 2) }}%</td>
                            <td>${{ number_format($prod->monto_iva, 2) }}</td>
                            <td><strong>${{ number_format($prod->precio_con_iva, 2) }}</strong></td>
                            <td>
                                <button class="btn btn-sm btn-warning" wire:click="edit({{ $prod->id }})">
                                    Editar
                                </button>
                                <button class="btn btn-sm btn-danger" 
                                        wire:click="delete({{ $prod->id }})"
                                        onclick="return confirm('¿Está seguro de eliminar este producto?')">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No hay productos registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
