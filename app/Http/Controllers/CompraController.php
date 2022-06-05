<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompraCreateRequest;
use App\Models\Compra;
use App\Models\Compra_detalle;
use App\Models\Proveedore;
use App\Models\Insumo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use function GuzzleHttp\json_encode;

class CompraController extends Controller
{
    //
    public function index()
    {
        $compras = Compra::paginate(5);
        $proveedores = Proveedore::all();
        $insumos = Insumo::all();
        return view('compras.index', compact('compras','proveedores','insumos'));
    }
    
    public function pdf(Request $request, $id){
        $compras= DB::select('SELECT factura, fecha, total, p.nombre from compras as c JOIN proveedores as p where c.id=? and p.id= c.proveedor_id', [$id]);
        $insumos = [];
        $a = Compra::find($id);
        if($a != null){
            $insumos = Insumo::select("insumos.*", "compra_detalles.cantidad as cantidad_c","compra_detalles.precio as precio_c")
            ->join("compra_detalles", "insumos.id", "=", "compra_detalles.insumo_id")
            ->where("compra_detalles.compra_id", $id)
            ->get();
        }
        $pdf = PDF::loadView('compras.pdf',['compras'=>$compras, 'insumos'=>$insumos]);
        return $pdf->download('___compras.pdf');
    }

    public function create()
    {
        $compra = new Compra;
        $compras = Compra::all();
        $proveedores = Proveedore::all();
        $insumos = Insumo::all();
        return view('compras.create', compact('compras','proveedores','insumos'));

    }

    public function store(Request $request)
    {
        $rules = [
            'proveedor_id' => 'required',
            'factura' => 'required|min:3|unique:compras,factura',
            'fecha' => 'required',
            'total' => 'required',
        ];
        $messages = [
            'proveedor_id.required' => 'El campo Proveedor no puede estar vacío.',
            'factura.required' => 'El campo Factura no puede estar vacío.',
            'factura.min' => 'El campo Factura debe llevar al menos 3 carácteres.',
            'factura.unique' => 'La Factura ya existe.',
            'fecha.required' => 'El campo Fecha de compra no puede estar vacío.',
            'total.required' => 'Se deben agregar insumos para la compra.',
        ];
        $this->validate($request, $rules, $messages);
        
        $input = $request->all();
        $compra = Compra::create([
            "factura"=>$input["factura"],
            "fecha"=>$input["fecha"],
            "proveedor_id"=>$input["proveedor_id"],
            "total"=>$this->calcular_precio($input["insumo_id"], $input["precios"], $input["cantidades"]),

        ]);

        foreach($input["insumo_id"] as $key => $value){
            Compra_detalle::create([
                "compra_id"=> $compra->id,
                "insumo_id"=>$value,
                "cantidad"=>  $input["cantidades"][$key],
                "precio"=>  $input["precios"][$key],
            ]);
            $insumo = Insumo::find($value);
            $insumo->update(["cantidad"=>$insumo->cantidad + $input["cantidades"][$key]]);
        }

        session()->flash('message', 'Compra registrada correctamente.');
        return redirect()->route('compras.index')->with('success', 'Compra creada correctamente');



}
    public function calcular_precio($insumos,$cantidades,$precios){
        $precio = 0;
        foreach($insumos as $key =>$value ){
            $precio += ($precios[$key] * $cantidades[$key]);
        }
        return $precio;
    }

    public function show(Request $request, $id){
        $a = Compra::findOrFail($id);
        $insumos = [];
        if($id != null){
            $insumos = Insumo::select("insumos.*", "compra_detalles.cantidad as cantidad_c","compra_detalles.precio as precio_c")
            ->join("compra_detalles", "insumos.id", "=", "compra_detalles.insumo_id")
            ->where("compra_detalles.compra_id", $id)
            ->get();
        }

        return view('compras.show', compact('insumos'));
    }

    
    public function edit(Request $request, $id)
    {
        $compras = Compra::find($id);
        $proveedores = Proveedore::all();
        $insumos = Insumo::all();
        $a = Compra::findOrFail($id);
        $insumosa = [];
        
        if($id != null){
            $insumosa = Insumo::select("insumos.*", "compra_detalles.cantidad as cantidad_c","compra_detalles.precio as precio_c")
            ->join("compra_detalles", "insumos.id", "=", "compra_detalles.insumo_id")
            ->where("compra_detalles.compra_id", $id)
            ->get();
        }
        return view('compras.edit', compact('compras','proveedores','insumosa', 'insumos'));
        
        
    }
    
    public function update(Request $request, $id)
    {       
        
        $compras=Compra::findOrFail($id);
        $rules = [
            'proveedor_id' => 'required',
            /* 'factura' => 'required|numeric|min:5|unique:compras,factura,'. request()->id, */
            'factura' => 'required',
            'fecha' => 'required',
            'estado' => 'required',
            'total' => 'required',
        ];
        $messages = [
            'proveedor_id.required' => 'El campo Proveedor no puede estar vacío.',
            'factura.required' => 'El campo Factura no puede estar vacío.',
            /* 'factura.unique' => 'La Factura ya existe.', */
            'fecha.required' => 'El campo Fecha de compra no puede estar vacío.',
            'estado.required' => 'El campo Estado no puede estar vacío.',
            'total.required' => 'Se deben agregar insumos para la compra.',
        ];
        $this->validate($request, $rules, $messages);
        $compra_detalle=Compra_detalle::all();
        $insumitos = [];
        $insumitos=$request->insumitos;
        $data=$request->all();
        $est=$compras->estado;     
        if($request->estado==$est)
        {
        }else if ($compras->estado==1) {
            $compra_i = DB::select('SELECT * FROM compra_detalles WHERE compra_id=?', [$compras->id]);
            
            foreach ($compra_i as $key) {
                $insumo_upd = DB::update("UPDATE insumos SET cantidad = cantidad - $key->cantidad WHERE  id = ? ", [$key->insumo_id]);
            }
        }else{
            $compra_i = DB::select('SELECT * FROM compra_detalles WHERE compra_id=?', [$compras->id]);
            
            foreach ($compra_i as $key) {
                $insumo_upd = DB::update("UPDATE insumos SET cantidad = cantidad + $key->cantidad WHERE  id = ? ", [$key->insumo_id]);
            }
        }    
        $array = [];
        $array2 = [];
        $j = 0;
        
        if($insumitos != null){
            DB::beginTransaction();
            for ($i=0; $i < strlen($insumitos); $i++) { 
                if($insumitos[$i] != ","){
                    $array2[$j]=$insumitos[$i];
                    $j++;
                    continue;
                }
            }
            
            for ($i=0; $i < count($array2); $i++) { 
                $array[$i] = intval($array2[$i]);
            }
            
            $compra_i = DB::select('SELECT * FROM compra_detalles WHERE compra_id=?', [$compras->id]);
            $j=0;
            foreach($compra_i as $key){
                for ($i=0; $i < count($array); $i++) {
                    if($key->insumo_id == $array[$i]){
                        $consulta=DB::select('SELECT cantidad from insumos where id = ?', [$array[$i]]);
                        $je=$consulta[0]->cantidad;
                        if ($je >= $key->cantidad) {
                            $insumito_borrar= DB::delete("DELETE from compra_detalles where insumo_id= $array[$i] and compra_id = $id");
                            $insumo_upd = DB::update("UPDATE insumos SET cantidad = cantidad - $key->cantidad WHERE  id = ? ", [$array[$i]]); 
                        }else{
                            DB::rollback();
                            session()->flash('message', 'No se pudo editar la compra.');
                            return redirect()->route('compras.index');
                        }
                    } 
                }
                DB::commit();
            }
        }
        
        if ($request->insumo_id != null) {
            $insumos=[];
            $insumos2=$request->insumo_id;
            
            $cantidades=[];
            $cantidades2=$request->cantidades;
            
            $precios=[];
            $precios2=$request->precios;
            
            for ($i=0; $i <count($insumos2); $i++) { 
                $insumos[$i]=intval($insumos2[$i]);
                $cantidades[$i]=intval($cantidades2[$i]);
                $precios[$i]=intval($precios2[$i]);
            }
            
            for ($i=0; $i <count($insumos); $i++) { 
                $sql=DB::insert("insert into compra_detalles (insumo_id, compra_id, cantidad, precio, estado) values (?, ?, ?, ?, ?)", [$insumos[$i], $id, $cantidades[$i], $precios[$i], $request->estado]);
                $insumo_upd = DB::update("UPDATE insumos SET cantidad = cantidad + $cantidades[$i] WHERE  id = ? ", [$insumos[$i]]); 
            }
        }
        
        $compras->update($data);  
        session()->flash('message', 'Compra editada correctamente.');
        return redirect()->route('compras.index');
        
    }
    
    public function destroy($id)
    {
        $compras=Compra::findOrFail($id);
        $compras->delete();
        return back()->with('success', 'Compra anulada correctamente');
    }
} 

