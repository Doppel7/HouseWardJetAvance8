<?php

namespace App\Http\Controllers;

use App\Models\Fichatecnica;
use App\Models\Ficha_detalle;
use App\Models\Insumo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class FichatecnicaController extends Controller
{
    //
    public function index()
    {
        $fichatecnicas = Fichatecnica::paginate(5);
        $insumos = Insumo::all();
        return view('fichatecnicas.index', compact('fichatecnicas','insumos'));
    }
    
    public function pdf(Request $request, $id){
        $fichatecnicas = DB::select('SELECT nombre from fichatecnicas  where id=?', [$id]);
        $a = Fichatecnica::findOrFail($id);
        $insumos = [];
        if($a!= null){
            $insumos = Insumo::select("insumos.*", "ficha_detalles.cantidad as cantidad_c")
            ->join("ficha_detalles", "insumos.id", "=", "ficha_detalles.insumo_id")
            ->where("ficha_detalles.ficha_id", $id)
            ->get();
        }
        $pdf = PDF::loadView('fichatecnicas.pdf',['fichatecnicas'=>$fichatecnicas, 'insumos'=>$insumos]);
        return $pdf->download('___fichatecnicas.pdf');
    }

     public function create()
     {
         $fichatecnica = new Fichatecnica;
         $fichatecnicas = Fichatecnica::all();
         $insumos = Insumo::all();
         return view('fichatecnicas.create', compact('fichatecnicas','insumos'));

     }

    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required|min:5|alpha',
        ];
        $messages = [
            'nombre.required' => 'El campo Nombre de la ficha técnica no puede estar vacío.',
            'nombre.min' => 'El campo Nombre de la ficha técnica debe llevar al menos 5 carácteres.',
            'nombre.alpha' => 'El campo Nombre debe contener solo letras.',
        ];
        $this->validate($request, $rules, $messages);
        $input = $request->all();
        $fichatecnica = Fichatecnica::create([
            "nombre"=>$input["nombre"],
        ]);

        foreach($input["insumo_id"] as $key => $value){
            Ficha_detalle::create([
                "ficha_id"=> $fichatecnica->id,
                "insumo_id"=>$value,
                "cantidad"=>  $input["cantidades"][$key],
            ]);
        }
        session()->flash('message', 'Ficha técnica registrada correctamente.');
        return redirect()->route('fichatecnicas.index')->with('success', 'Ficha técnica creada correctamente');
}

    public function show(Request $request, $id){
        $a = Fichatecnica::findOrFail($id);
        $insumos = [];
        if($id != null){
            $insumos = Insumo::select("insumos.*", "ficha_detalles.cantidad as cantidad_c")
            ->join("ficha_detalles", "insumos.id", "=", "ficha_detalles.insumo_id")
            ->where("ficha_detalles.ficha_id", $id)
            ->get();
        }

        return view('fichatecnicas.show', compact('insumos'));
    }

    public function edit(Request $request, $id)
    {
        $fichatecnica = Fichatecnica::find($id);
        $insumos = Insumo::all();
        $insumosa = [];
        
        if($id != null){
            $insumosa = Insumo::select("insumos.*", "ficha_detalles.cantidad as cantidad_c")
            ->join("ficha_detalles", "insumos.id", "=", "ficha_detalles.insumo_id")
            ->where("ficha_detalles.ficha_id", $id)
            ->get();
        }
        return view('fichatecnicas.edit', compact('fichatecnica','insumos','insumosa'));
        
        
    }

    public function update(Request $request, $id)
    {       
        $rules = [
            'nombre' => 'required|min:5',
        ];
        $messages = [
            'nombre.required' => 'El campo Nombre de la ficha técnica no puede estar vacío.',
            'nombre.min' => 'El campo Nombre de la ficha técnica debe llevar al menos 5 carácteres.',
        ];
        $this->validate($request, $rules, $messages);
        $fichatecnica=Fichatecnica::findOrFail($id);
        $insumito = [];
        $insumito=$request->insumito;
        $data=$request->all(); 
        /* return response()->json($request); */
        $fichatecnica->update($data);       
        $array = [];
        $array2 = [];
        $j = 0;
        
        if($insumito != null){
            /* return response()->json($insumito); */
            
            for ($i=0; $i < strlen($insumito); $i++) { 
                if($insumito[$i] != ","){
                    $array2[$j]=$insumito[$i];
                    $j++;
                    continue;
                }
            }
            
            for ($i=0; $i < count($array2); $i++) { 
                $array[$i] = intval($array2[$i]);
            }
            
            $ficha_i = DB::select('SELECT * FROM ficha_detalles WHERE ficha_id=?', [$fichatecnica->id]);
            $j=0;
            foreach($ficha_i as $key){
                for ($i=0; $i < count($array); $i++) {
                    if($key->insumo_id == $array[$i]){
                        /* $consulta=DB::select('SELECT cantidad from insumos where id = ?', [$array[$i]]);
                        $je=$consulta[0]->cantidad; */
                        /* if ($je >= $key->cantidad) { */
                            $insumito_borrar= DB::delete("DELETE from ficha_detalles where insumo_id= $array[$i] and ficha_id = $id");
                        }else{
                        }
                    /* }  */
                }
            }
        }
        
        if ($request->insumo_id != null) {
            $insumos=[];
            $insumos2=$request->insumo_id;

            $cantidades=[];
            $cantidades2=$request->cantidades;


            for ($i=0; $i <count($insumos2); $i++) { 
                $insumos[$i]=intval($insumos2[$i]);
                $cantidades[$i]=intval($cantidades2[$i]);
            }

            for ($i=0; $i <count($insumos); $i++) { 
                $sql=DB::insert("insert into ficha_detalles (insumo_id, ficha_id, cantidad, estado) values (?, ?, ?, ?)", [$insumos[$i], $id, $cantidades[$i], $request->estado]); 
            }
        }
        
        session()->flash('message', 'Ficha técnica editada correctamente.');
        return redirect()->route('fichatecnicas.index');
        
    }


    public function destroy(Fichatecnica $fichatecnica)
    {
        $fichatecnica->delete();
        return back()->with('success', 'Ficha técnica anulada correctamente');
    }
}