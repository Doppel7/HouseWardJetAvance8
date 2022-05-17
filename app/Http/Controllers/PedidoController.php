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
        $input = $request->all();
        /* $xdconsulta= DB::select("SELECT * from ficha_detalles where ficha_id = 1");
        return response()->json($xdconsulta);
        $je=$xdconsulta[0]->insumo_id; */
        /* $otraconsulta= DB::select("SELECT id, ficha_id from productos where id = $pedidodetalle->producto_id");
        $consulta= DB::delete("DELETE from compra_detalles where insumo_id= $array[$i] and compra_id = $id");
        $insumo_upd = DB::update("UPDATE insumos SET cantidad = cantidad + $key->cantidad WHERE  id = ? ", [$key->insumo_id]); */
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

        return redirect()->route('pedidos.index')->with('success', 'Pedido creada correctamente');

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