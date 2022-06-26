<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;

class HomeController extends Controller
{
    public function index()
    {
        $year= date("Y"); 
        $consultas= DB::select("SELECT i.nombre as nom, i.cantidad, u.nombre as n from insumos as i join unidades as u where i.unidad_id=u.id and Year(i.created_at)=$year order by cantidad DESC LIMIT 5");
        $data= [];
        foreach($consultas as $consulta){
            $data['label'][] =$consulta->nom. " (" . $consulta->n .")";
            $data['data'][] =$consulta->cantidad;
        }
        $data['data']=json_encode($data);
        return view('home.index', $data);
    }

    /* public function charts(){
        $year= date("Y"); 
        $consultas= DB::select("SELECT nombre, cantidad from insumos where Year(created_at)=$year ");
        $data= [];
        foreach($consultas as $consulta){
            $data['label'][] =$consulta->nombre;
            $data['data'][] =$consulta->cantidad;
        }
        $data['data']= json_encode($data);
        return view('home.charts', $data);
    } */
}
