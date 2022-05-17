<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Proveedore;
use App\Models\Categoriaproveedore;
use App\Models\Tipodocumento;

class Proveedores extends Component
{
	use WithPagination;
	
	

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $tipodoc_id, $documento, $nombre, $email, $direccion, $celular, $categoria_id, $estado;
	public $updateMode = false;
	

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.proveedores.view', [
			'tipodocumentos'=>Tipodocumento::all(),
			'categoriaproveedores'=>Categoriaproveedore::all(),
            'proveedores' => Proveedore::latest()
						->orWhere('tipodoc_id', 'LIKE', $keyWord)
						->orWhere('documento', 'LIKE', $keyWord)
						->orWhere('nombre', 'LIKE', $keyWord)
						->orWhere('email', 'LIKE', $keyWord)
						->orWhere('direccion', 'LIKE', $keyWord)
						->orWhere('celular', 'LIKE', $keyWord)
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
		$this->tipodoc_id = null;
		$this->documento = null;
		$this->nombre = null;
		$this->email = null;
		$this->direccion = null;
		$this->celular = null;
		$this->categoria_id = null;
		$this->estado = null;
    }

	protected $messages = [
		'documento.required' => 'El campo Documento no puede estar vacío.',
		'documento.min' => 'El campo Documento debe llevar al menos 5 carácteres numéricos.',
		'documento.numeric' => 'El campo Documento debe llevar solo carácteres numéricos.',
		'documento.unique' => 'El Documento ya existe.',
		'nombre.required' => 'El campo Nombre no puede estar vacío.',
		'nombre.min' => 'El campo Nombre debe llevar al menos 4 carácteres.',
        'email.required' => 'El campo Email no puede estar vacío.',
		'email.email' => 'El formato del correo no es válido.',
		'direccion.required' => 'El campo Dirección no puede estar vacío.',
		'celular.required' => 'El campo Celular no puede estar vacío.',
		'celular.numeric' => 'El campo Celular debe llevar solo carácteres numéricos.',
		'celular.unique' => 'El Celular ya existe.',
	];

	public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
	
    public function store()
    {
		
        $this->validate([
		'tipodoc_id' => 'required',
		'documento' => 'required|numeric|unique:proveedores,documento|min:5',
		'nombre' => 'required|min:4',
		'email' => 'required|email',
		'direccion' => 'required',
		'celular' => 'required|numeric|unique:proveedores,celular',
		'categoria_id' => 'required',
        ]);

        Proveedore::create([ 
			'tipodoc_id' => $this-> tipodoc_id,
			'documento' => $this-> documento,
			'nombre' => $this-> nombre,
			'email' => $this-> email,
			'direccion' => $this-> direccion,
			'celular' => $this-> celular,
			'categoria_id' => $this-> categoria_id,
			//'estado' => $this-> estado
        ]);
        $this->resetValidation();
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Proveedor registrado correctamente.');
    }

    public function edit($id)
    {
        $record = Proveedore::findOrFail($id);

        $this->selected_id = $id; 
		$this->tipodoc_id = $record-> tipodoc_id;
		$this->documento = $record-> documento;
		$this->nombre = $record-> nombre;
		$this->email = $record-> email;
		$this->direccion = $record-> direccion;
		$this->celular = $record-> celular;
		$this->categoria_id = $record-> categoria_id;
		$this->estado = $record-> estado;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'tipodoc_id' => 'required',
		'documento' => 'required|numeric|min:5|unique:proveedores,documento,'.$this->selected_id,
		'nombre' => 'required|min:4',
		'email' => 'required|email|unique:proveedores,email,'.$this->selected_id,
		'direccion' => 'required',
		'celular' => 'required|numeric|unique:proveedores,celular,'.$this->selected_id,
		'categoria_id' => 'required',
		'estado' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Proveedore::find($this->selected_id);
            $record->update([ 
			'tipodoc_id' => $this-> tipodoc_id,
			'documento' => $this-> documento,
			'nombre' => $this-> nombre,
			'email' => $this-> email,
			'direccion' => $this-> direccion,
			'celular' => $this-> celular,
			'categoria_id' => $this-> categoria_id,
			'estado' => $this-> estado
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Proveedor editado correctamente.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Proveedore::where('id', $id);
            $record->delete();
        }
    }
}
