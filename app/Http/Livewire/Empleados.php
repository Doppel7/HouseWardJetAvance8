<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Empleado;
use App\Models\Tipodocumento;
use App\Models\Municipio;

class Empleados extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $tipodoc_id, $documento, $nombre, $email, $direccion, $municipio, $fechadenacimiento, $telefono, $celular, $estado;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.empleados.view', [
			'tipodocumentos'=>Tipodocumento::all(),
			'municipios'=>Municipio::all(),
            'empleados' => Empleado::latest()
						->orWhere('tipodoc_id', 'LIKE', $keyWord)
						->orWhere('documento', 'LIKE', $keyWord)
						->orWhere('nombre', 'LIKE', $keyWord)
						->orWhere('email', 'LIKE', $keyWord)
						->orWhere('direccion', 'LIKE', $keyWord)
						->orWhere('municipio', 'LIKE', $keyWord)
						->orWhere('fechadenacimiento', 'LIKE', $keyWord)
						->orWhere('telefono', 'LIKE', $keyWord)
						->orWhere('celular', 'LIKE', $keyWord)
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
		$this->municipio = null;
		$this->fechadenacimiento = null;
		$this->telefono = null;
		$this->celular = null;
		$this->estado = null;
	}
	
	protected $messages = [
		'documento.required' => 'El campo Documento no puede estar vacío.',
		'documento.min' => 'El campo Documento debe llevar al menos 5 carácteres numéricos.',
		'documento.numeric' => 'El campo Documento debe llevar solo carácteres numéricos.',
		'documento.unique' => 'El Documento ya existe.',
		'nombre.required' => 'El campo Nombre no puede estar vacío.',
		'nombre.min' => 'El campo Nombre debe llevar al menos 4 carácteres.',
		'nombre.alpha' => 'El campo Nombre debe contener solo letras.',
        'email.required' => 'El campo Email no puede estar vacío.',
		'email.email' => 'El formato del correo no es válido.',
		'direccion.required' => 'El campo Dirección no puede estar vacío.',
		'fechadenacimiento.required' => 'El campo Fecha de nacimiento no puede estar vacío.',
		'telefono.required' => 'El campo Telefono no puede estar vacío.',
		'telefono.numeric' => 'El campo Telefono debe llevar solo carácteres numéricos.',
		'celular.required' => 'El campo Celular no puede estar vacío.',
		'celular.numeric' => 'El campo Celular debe llevar solo carácteres numéricos.',
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
		'documento' => 'required|numeric|unique:empleados,documento|min:5',
		'nombre' => 'required|min:4|alpha',
		'email' => 'required|email',
		'direccion' => 'required',
		'municipio' => 'required',
		'fechadenacimiento' => 'required',
		'telefono' => 'required|numeric',
		'celular' => 'required|numeric',
		/* 'estado' => 'required', */
        ]);

        Empleado::create([ 
			'tipodoc_id' => $this-> tipodoc_id,
			'documento' => $this-> documento,
			'nombre' => $this-> nombre,
			'email' => $this-> email,
			'direccion' => $this-> direccion,
			'municipio' => $this-> municipio,
			'fechadenacimiento' => $this-> fechadenacimiento,
			'telefono' => $this-> telefono,
			'celular' => $this-> celular,
			// 'estado' => $this-> estado
        ]);
        
        $this->resetValidation();
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Empleado registrado correctamente.');
    }

    public function edit($id)
    {
        $record = Empleado::findOrFail($id);

        $this->selected_id = $id; 
		$this->tipodoc_id = $record-> tipodoc_id;
		$this->documento = $record-> documento;
		$this->nombre = $record-> nombre;
		$this->email = $record-> email;
		$this->direccion = $record-> direccion;
		$this->municipio = $record-> municipio;
		$this->fechadenacimiento = $record-> fechadenacimiento;
		$this->telefono = $record-> telefono;
		$this->celular = $record-> celular;
		$this->estado = $record-> estado;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'tipodoc_id' => 'required',
		'documento' => 'required|numeric|min:5|unique:empleados,documento,'.$this->selected_id,
		'nombre' => 'required|min:4|alpha',
		'email' => 'required|email',
		'direccion' => 'required',
		'municipio' => 'required',
		'fechadenacimiento' => 'required',
		'telefono' => 'required|numeric|unique:empleados,telefono,'.$this->selected_id,
		'celular' => 'required|numeric|unique:empleados,celular,'.$this->selected_id,

        ]);

        if ($this->selected_id) {
			$record = Empleado::find($this->selected_id);
            $record->update([ 
			'tipodoc_id' => $this-> tipodoc_id,
			'documento' => $this-> documento,
			'nombre' => $this-> nombre,
			'email' => $this-> email,
			'direccion' => $this-> direccion,
			'municipio' => $this-> municipio,
			'fechadenacimiento' => $this-> fechadenacimiento,
			'telefono' => $this-> telefono,
			'celular' => $this-> celular,
			'estado' => $this-> estado
            ]);

            $this->resetInput();
			$this->updateMode = false;
			$this->emit('closeModal');
			session()->flash('message', 'Empleado editado correctamente.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Empleado::where('id', $id);
            $record->delete();
        }
    }
}
