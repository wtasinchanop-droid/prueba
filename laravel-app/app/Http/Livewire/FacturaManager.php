<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Factura;
use App\Models\Producto;
use App\Models\Cliente;

class FacturaManager extends Component
{
    public $facturas;
    public $productos;
    public $clientes;
    public $id_producto = '';
    public $codigo_cliente = '';
    public $editingId = null;

    protected $rules = [
        'id_producto' => 'required|exists:productos,id',
        'codigo_cliente' => 'required|exists:clientes,codigo',
    ];

    protected $messages = [
        'id_producto.required' => 'Debe seleccionar un producto.',
        'id_producto.exists' => 'El producto seleccionado no existe.',
        'codigo_cliente.required' => 'Debe seleccionar un cliente.',
        'codigo_cliente.exists' => 'El cliente seleccionado no existe.',
    ];

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->facturas = Factura::with(['producto', 'cliente'])->get();
        $this->productos = Producto::all();
        $this->clientes = Cliente::all();
    }

    public function save()
    {
        $this->validate();

        if ($this->editingId) {
            $factura = Factura::find($this->editingId);
            $factura->update([
                'id_producto' => $this->id_producto,
                'codigo_cliente' => $this->codigo_cliente,
            ]);
            $this->editingId = null;
        } else {
            Factura::create([
                'id_producto' => $this->id_producto,
                'codigo_cliente' => $this->codigo_cliente,
            ]);
        }

        $this->reset(['id_producto', 'codigo_cliente']);
        $this->loadData();
        session()->flash('message', 'Factura guardada exitosamente.');
    }

    public function edit($id)
    {
        $factura = Factura::find($id);
        $this->editingId = $id;
        $this->id_producto = $factura->id_producto;
        $this->codigo_cliente = $factura->codigo_cliente;
    }

    public function delete($id)
    {
        Factura::find($id)->delete();
        $this->loadData();
        session()->flash('message', 'Factura eliminada exitosamente.');
    }

    public function cancel()
    {
        $this->reset(['id_producto', 'codigo_cliente', 'editingId']);
    }

    public function getFacturaDetails($id)
    {
        return Factura::with(['producto', 'cliente'])->find($id);
    }

    public function render()
    {
        return view('livewire.factura-manager');
    }
}
