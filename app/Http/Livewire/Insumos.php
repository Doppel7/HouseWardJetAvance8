<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Categoriainsumo;
use App\Models\Insumo;

class Insumos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $cantidad, $categoria_id, $estado;
    public $updateMode = false;
    public $selectedCategoria=null;

    public function render()
    {



		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.insumos.view', [
            'categoriainsumos'=>Categoriainsumo::all(),
            'insumos' => Insumo::latest()
						->orWhere('nombre', 'LIKE', $keyWord)
						->orWhere('cantidad', 'LIKE', $keyWord)
						->orWhere('categoria_id', 'LIKE', $keyWord)
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
		$this->cantidad = null;
		$this->categoria_id = null;
		$this->estado = null;
    }

    protected $messages = [
		'nombre.required' => 'El campo Nombre no puede estar vacío.',
		'nombre.min' => 'El campo Nombre debe llevar al menos 4 carácteres.',
        'nombre.unique' => 'La insumo ya existe.',
        'cantidad.required' => 'El campo Cantidad no puede estar vacío.',
        'cantidad.numeric' => 'El campo Cantidad debe llevar solo carácteres numéricos.',
	];


    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function store()
    {
        

        $this->validate([
		'nombre' => 'required|min:4|unique:insumos,nombre',
		'cantidad' => 'required|numeric',
		'categoria_id' => 'required',
        ]);

        Insumo::create([ 
			'nombre' => $this-> nombre,
			'cantidad' => $this-> cantidad,
			'categoria_id' => $this-> categoria_id,

            
        ]);

        $this->resetValidation();
        $this->resetInput();
		$this->emit('closeModal');
        session()->flash('message', 'Insumo registrado correctamente.'); 
    }

    public function edit($id)
    {
        $record = Insumo::findOrFail($id);

        $this->selected_id = $id; 
		$this->nombre = $record-> nombre;
		$this->cantidad = $record-> cantidad;
		$this->categoria_id = $record-> categoria_id;
		$this->estado = $record-> estado;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'nombre' => 'required|min:4|unique:insumos,nombre,'.$this->selected_id,
		'cantidad' => 'required|numeric',
		'categoria_id' => 'required',
		'estado' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Insumo::find($this->selected_id);
            $record->update([ 
			'nombre' => $this-> nombre,
			'cantidad' => $this-> cantidad,
			'categoria_id' => $this-> categoria_id,
			'estado' => $this-> estado
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Insumo editado correctamente.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Insumo::where('id', $id);
            $record->delete();
        }
    }
}
