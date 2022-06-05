<?php

namespace App\Http\Controllers;
use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use App\Models\Tipodocumento;
use Illuminate\Http\Request;

class UserController extends Controller
{
     public function index()
    {
        $users=User::paginate(5);
        $tipodocumentos=Tipodocumento::all();
        $roles=Role::all();
        return view('users.index', compact('users', 'tipodocumentos','roles'));
    }

    public function create()
    {
        $tipodocumentos=Tipodocumento::all();
        $roles=Role::all();
        return view('users.create', compact('tipodocumentos','roles'));
    }

    public function store( Request $request)
    {
        $rules = [
            'tipodoc_id' => 'required',
            'rol_id' => 'required',
            'documento' => 'required|numeric|unique:users,documento|min:10000',
            'name' => 'required|min:4|alpha',
            'email' => 'required|email',
            'password' => 'required|min:4',
            'fechadenacimiento' => 'required',
            'celular' => 'required|numeric|min:1000000000|max:9999999999',
        ];
        $messages = [
            'rol_id.required' => 'El campo Rol no puede estar vacío.',
            'documento.required' => 'El campo Documento no puede estar vacío.',
            'documento.min' => 'El campo Documento debe llevar al menos 5 carácteres numéricos.',
            'documento.numeric' => 'El campo Documento debe llevar solo carácteres numéricos.',
            'documento.unique' => 'El Documento ya existe.',
            'name.required' => 'El campo Nombre no puede estar vacío.',
            'name.min' => 'El campo Nombre debe llevar al menos 4 carácteres.',
            'name.alpha' => 'El campo Nombre debe contener solo letras.',
            'email.required' => 'El campo Email no puede estar vacío.',
            'email.email' => 'El formato del correo no es válido.',
            'password.required' => 'El campo Contraseña no puede estar vacío.',
            'password.min' => 'El campo Contraseña debe llevar al menos 4 carácteres.',
            'fechadenacimiento.required' => 'El campo Fecha de nacimiento no puede estar vacío.',
            'celular.required' => 'El campo Celular no puede estar vacío.',
            'celular.numeric' => 'El campo Celular debe llevar solo carácteres numéricos.',
            'celular.min' => 'El campo Celular debe llevar al menos 10 carácteres numéricos.',
            'celular.max' => 'El campo Celular no debe llevar más de 10 carácteres numéricos.',
        ];
        $this->validate($request, $rules, $messages);
            
        User::create($request->only('tipodoc_id','rol_id','documento','name','celular','fechadenacimiento','email')
    +[
        'password'=>bcrypt($request->input('password'))
    ]);
        session()->flash('message', 'Usuario registrado correctamente.');
        return redirect()->route('users.index');
    }

    public function show($id)
    {
        $user=User::find($id);
        dd($user);
        return view('users.show', compact('user'));
    }


    public function edit($id)
    {
        $user=User::find($id);
        $tipodocumentos=Tipodocumento::all();
        $roles=Role::all();
        return view('users.edit', compact('user','tipodocumentos','roles'));
    }

    public function update(Request $request, $id)
    {
        $user=User::findOrFail($id);
        $rules = [
            'tipodoc_id' => 'required',
            'rol_id' => 'required',
            'documento' => 'required|numeric|min:10000|unique:users,documento,'. request()->id ,
            'name' => 'required|min:4',
            'email' => 'required|email',
            'fechadenacimiento' => 'required',
            'celular' => 'required|numeric|min:1000000000|max:9999999999',
            'estado' => 'required',
        ];
        $messages = [
            'rol_id.required' => 'El campo Rol no puede estar vacío.',
            'documento.required' => 'El campo Documento no puede estar vacío.',
            'documento.min' => 'El campo Documento debe llevar al menos 5 carácteres numéricos.',
            'documento.numeric' => 'El campo Documento debe llevar solo carácteres numéricos.',
            'documento.unique' => 'El Documento ya existe.',
            'name.required' => 'El campo Nombre no puede estar vacío.',
            'name.min' => 'El campo Nombre debe llevar al menos 4 carácteres.',
            'email.required' => 'El campo Email no puede estar vacío.',
            'email.email' => 'El formato del correo no es válido.',
            'fechadenacimiento.required' => 'El campo Fecha de nacimiento no puede estar vacío.',
            'celular.required' => 'El campo Celular no puede estar vacío.',
            'celular.numeric' => 'El campo Celular debe llevar solo carácteres numéricos.',
            'celular.min' => 'El campo Celular debe llevar al menos 10 carácteres numéricos.',
            'celular.max' => 'El campo Celular no debe llevar más de 10 carácteres numéricos.',
            'estado.required' => 'El campo Estado no puede estar vacío.',
        ];
        $this->validate($request, $rules, $messages);
        $data=$request->only('tipodoc_id','rol_id','documento','name','celular','fechadenacimiento','email','estado');
        if(trim($request->password)==''){
            $data=$request->except('password');
        }else{
            $data=$request->all();
            $data['password']=bcrypt($request->password);
        }
        session()->flash('message', 'Usuario editado correctamente.');
        $user->update($data);
        return redirect()->route('users.index')->with('success','Usuario actualizado correctamente.');

    }


    public function destroy($id)
    {
        $user=User::findOrFail($id);
        $user->delete();
        return back()->with('success','Usuario eliminado correctamente.');
    }

    
}
