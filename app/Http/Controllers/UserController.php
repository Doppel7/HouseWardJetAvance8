<?php

namespace App\Http\Controllers;
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
        User::create($request->only('tipodoc_id','rol_id','documento','name','celular','fechadenacimiento','email')
    +[
        'password'=>bcrypt($request->input('password'))
    ]);
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
        $data=$request->only('tipodoc_id','rol_id','documento','name','celular','fechadenacimiento','email','estado');
        if(trim($request->password)==''){
            $data=$request->except('password');
        }else{
            $data=$request->all();
            $data['password']=bcrypt($request->password);
        }

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
