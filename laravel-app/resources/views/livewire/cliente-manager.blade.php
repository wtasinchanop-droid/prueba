<div class="card">
    <div class="card-header">
        <h3 class="card-title">Gestión de Clientes</h3>
    </div>
    <div class="card-body">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <!-- Formulario -->
        <form wire:submit.prevent="save">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="codigo">Código</label>
                        <input type="text" class="form-control @error('codigo') is-invalid @enderror" 
                               wire:model="codigo" placeholder="Código del cliente">
                        @error('codigo') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                               wire:model="nombre" placeholder="Nombre del cliente">
                        @error('nombre') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="numeroTelefono">Teléfono</label>
                        <input type="text" class="form-control @error('numeroTelefono') is-invalid @enderror" 
                               wire:model="numeroTelefono" placeholder="Número de teléfono">
                        @error('numeroTelefono') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <div>
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
            </div>
        </form>

        <!-- Tabla de clientes -->
        <div class="table-responsive mt-4">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->id }}</td>
                            <td>{{ $cliente->codigo }}</td>
                            <td>{{ $cliente->nombre }}</td>
                            <td>{{ $cliente->numeroTelefono }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" wire:click="edit({{ $cliente->id }})">
                                    Editar
                                </button>
                                <button class="btn btn-sm btn-danger" 
                                        wire:click="delete({{ $cliente->id }})"
                                        onclick="return confirm('¿Está seguro de eliminar este cliente?')">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No hay clientes registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
