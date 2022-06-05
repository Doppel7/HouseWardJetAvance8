<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompraCreateRequest;
use App\Models\Pedido;
use App\Models\Pedido_detalle;
use App\Models\Empleado;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PedidoController extends Controller
{
    //
    public function index()
    {
        $pedidos = Pedido::paginate(5);
        $empleados = Empleado::all();
        $productos = Producto::all();
        return view('pedidos.index', compact('pedidos','empleados','productos'));
    }

    public function pdf(Request $request, $id){
        $pedidos = DB::select('SELECT fecha, total, e.nombre from pedidos as p JOIN empleados as e where p.id=? and e.id= p.empleado_id', [$id]);
        $productos = [];
        $a = Pedido::findOrFail($id);
        if($a != null){
            $productos = Producto::select("productos.*", "pedido_detalles.cantidad as cantidad_p","pedido_detalles.precio as precio_p")
            ->join("pedido_detalles", "productos.id", "=", "pedido_detalles.producto_id")
            ->where("pedido_detalles.pedido_id", $id)
            ->get();
        }
        $pdf = PDF::loadView('pedidos.pdf',['pedidos'=>$pedidos, 'productos'=>$productos]);
        return $pdf->download('___pedidos.pdf');
    }


    public function create()
    {
        $pedido = new Pedido;
        $pedidos = Pedido::all();
        $empleados = Empleado::all();
        $productos = Producto::all();
        return view('pedidos.create', compact('pedidos','empleados','productos'));

    }

    public function store(Request $request)
    {
        $rules = [
            'empleado_id' => 'required',
            'fecha' => 'required',
            'total' => 'required',
        ];
        $messages = [
            'empleado_id.required' => 'El campo Empleado no puede estar vacío.',
            'fecha.required' => 'El campo Fecha de pedido no puede estar vacío.',
            'total.required' => 'Se deben agregar productos para el pedido.',
        ];
        $this->validate($request, $rules, $messages);
        $input = $request->all();
        $productos=$request->producto_id;
        $productosCantidades=$request->cantidades;
        /* echo "<br>".$input->producto_id; */
        /* return response()->json($request->producto_id); */
        $prod = [];
        $prodc = [];
        $ficha = [];
        DB::beginTransaction();
        if($productos != null){
            $j=0; 
            for ($i=0; $i < count($productos); $i++) {
                    $prod[$j]=intval($productos[$i]);
                    $prodc[$j]=intval($productosCantidades[$i]);
                    $consulta=DB::select("SELECT ficha_id FROM productos WHERE id = $prod[$j]");
                    $ficha[$j] = $consulta[0]->ficha_id;
                    $FD=DB::select("SELECT insumo_id, cantidad FROM ficha_detalles where ficha_id = $ficha[$j]");
                    
                    for ($h=0; $h < count($FD); $h++) { 
                        $consulta2=DB::select('SELECT cantidad from insumos where id = ?', [($FD[$h]->insumo_id)]);
                        $je=$consulta2[0]->cantidad;
                        if(($je-(($FD[$h]->cantidad)* $prodc[$j]))>=0){
                            $base = DB::update("UPDATE insumos SET cantidad = ? WHERE id = ? ", [($je-(($FD[$h]->cantidad)* $prodc[$j])), ($FD[$h]->insumo_id)]);
                        }
                        else{
                            DB::rollback();
                            session()->flash('message', 'Pedido no registrado.');
                            return redirect()->route('pedidos.index');
                        }
                    } 
                    $j++;
            }
            DB::commit();
        }
        $pedido = Pedido::create([
            "empleado_id"=>$input["empleado_id"],
            "fecha"=>$input["fecha"],
            "total"=>$this->calcular_precio($input["producto_id"], $input["precios"], $input["cantidades"]),

        ]);

        foreach($input["producto_id"] as $key => $value){
            $pedidodetalle= Pedido_detalle::create([
                "pedido_id"=> $pedido->id,
                "producto_id"=>$value,
                "cantidad"=>  $input["cantidades"][$key],
                "precio"=>  $input["precios"][$key],
            ]);
            
        }
        session()->flash('message', 'Pedido registrado correctamente.');
        return redirect()->route('pedidos.index');

    }
    public function calcular_precio($productos,$cantidades,$precios){
        $precio = 0;
        foreach($productos as $key =>$value ){
            $precio += ($precios[$key] * $cantidades[$key]);
        }
        return $precio;
    }

    public function show(Request $request, $id){
        $a = Pedido::findOrFail($id);
        $productos = [];
        if($id != null){
            $productos = Producto::select("productos.*", "pedido_detalles.cantidad as cantidad_p","pedido_detalles.precio as precio_p")
            ->join("pedido_detalles", "productos.id", "=", "pedido_detalles.producto_id")
            ->where("pedido_detalles.pedido_id", $id)
            ->get();
        }

        return view('pedidos.show', compact('productos'));
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        return back()->with('success', 'Pedido anulado correctamente');
    }
    }