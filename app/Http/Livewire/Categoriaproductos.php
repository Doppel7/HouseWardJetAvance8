<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Categoriaproducto;

class Categoriaproductos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $estado;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.categoriaproductos.view', [
            'categoriaproductos' => Categoriaproducto::latest()
						->orWhere('nombre', 'LIKE', $keyWord)
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
		$this->estado = null;
    }

    protected $messages = [
		'nombre.required' => 'El campo Nombre no puede estar vacío.',
		'nombre.min' => 'El campo Nombre debe llevar al menos 4 carácteres.',
        'nombre.unique' => 'La categoría ya existe.',
        'nombre.alpha' => 'El campo Nombre debe contener solo letras.',
    ];
    
    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function store()
    {
        $this->validate([
		'nombre' => 'required|min:4|alpha|unique:categoriaproductos,nombre',
        ]);

        Categoriaproducto::create([ 
			'nombre' => $this-> nombre,
			//'estado' => $this-> estado
        ]);
        $this->resetValidation();
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Categoría de Producto registrada correctamente.');
    }

    public function edit($id)
    {
        $record = Categoriaproducto::findOrFail($id);

        $this->selected_id = $id; 
		$this->nombre = $record-> nombre;
		$this->estado = $record-> estado;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'nombre' => 'required|min:4|alpha|unique:categoriaproductos,nombre,'.$this->selected_id,
		'estado' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Categoriaproducto::find($this->selected_id);
            $record->update([ 
			'nombre' => $this-> nombre,
			'estado' => $this-> estado
            ]);

            $this->resetInput();
            $this->updateMode = false;
            $this->emit('closeModal');
			session()->flash('message', 'Categoría de Producto editada correctamente.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Categoriaproducto::where('id', $id);
            $record->delete();
        }
    }
}
