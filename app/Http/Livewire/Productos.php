<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Fichatecnica;
use App\Models\Categoriaproducto;
use App\Models\Producto;

class Productos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $precio, $cantidad, $categoria_id, $ficha_id, $estado;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.productos.view', [
            'fichatecnicas'=>Fichatecnica::all(),
            'categoriaproductos'=>Categoriaproducto::all(),
            'productos' => Producto::latest()
						->orWhere('nombre', 'LIKE', $keyWord)
						->orWhere('precio', 'LIKE', $keyWord)
						->orWhere('categoria_id', 'LIKE', $keyWord)
						->orWhere('ficha_id', 'LIKE', $keyWord)
						->orWhere('estado', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->nombre = null;
		$this->precio = null;
		$this->categoria_id = null;
		$this->ficha_id = null;
		$this->estado = null;
    }

    protected $messages = [
		'nombre.required' => 'El campo Nombre no puede estar vacío.',
		'nombre.min' => 'El campo Nombre debe llevar al menos 4 carácteres.',
        'nombre.unique' => 'El producto ya existe.',
        'nombre.regex' => 'El campo Nombre debe contener solo letras.',
        'precio.required' => 'El campo Precio no puede estar vacío.',
        'precio.numeric' => 'El campo Precio debe llevar solo carácteres numéricos.',
	];

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function store()
    {
        $this->validate([
		'nombre' => 'required|min:4|regex:/^[\pL\s\-]+$/u|unique:productos,nombre',
		'precio' => 'required|numeric',
		'categoria_id' => 'required',
		'ficha_id' => 'required',
        ]);

        Producto::create([ 
			'nombre' => $this-> nombre,
			'precio' => $this-> precio,
			'categoria_id' => $this-> categoria_id,
			'ficha_id' => $this-> ficha_id,

        ]);
        $this->resetValidation();
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Producto registrado correctamente.');
    }

    public function edit($id)
    {
        $record = Producto::findOrFail($id);

        $this->selected_id = $id; 
		$this->nombre = $record-> nombre;
		$this->precio = $record-> precio;
		$this->categoria_id = $record-> categoria_id;
		$this->ficha_id = $record-> ficha_id;
		$this->estado = $record-> estado;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'nombre' => 'required|min:4|alpha|unique:productos,nombre,'.$this->selected_id,
		'precio' => 'required|numeric',
		'categoria_id' => 'required',
		'ficha_id' => 'required',
        'estado' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Producto::find($this->selected_id);
            $record->update([ 
			'nombre' => $this-> nombre,
			'precio' => $this-> precio,
			'categoria_id' => $this-> categoria_id,
			'ficha_id' => $this-> ficha_id,
			'estado' => $this-> estado
            ]);

            $this->resetInput();
            $this->updateMode = false;
            $this->emit('closeModal');
			session()->flash('message', 'Producto editado correctamente.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Producto::where('id', $id);
            $record->delete();
        }
    }
}
