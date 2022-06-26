@extends('dash.index')
@section('content')
<br>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('compras.update', $compras->id)}}" method="post" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <div class="float-left">
                                    <h4><i class="fab fa-laravel text-info"></i>
                                        Compras</h4>
                                </div>
                                <div wire:poll.60s>
                                    <code><h5>{{ now()->format('H:i:s') }} </h5></code>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 grid-margin">
                                    <div class="card">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="proveedor_id"></label>
                                                        <select class="form-control @error('proveedor_id') is-invalid @enderror" name="proveedor_id"
                                                            id="proveedor_id" value="{{$compras->proveedor_id}}">
                                                            @error('proveedor_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                                            <option value="">--> Seleccione el proveedor * <--</option>
                                                            @foreach ( $proveedores as $proveedore )
                                                            <option @if ($proveedore->id==$compras->proveedor_id)
                                                                selected="true"
                                                                @endif
                                                                value="{{$proveedore['id']}}">{{$proveedore['nombre']}}
                                                            </option>
                                                            @if ($proveedore->estado==0)
                                                            @continue
                                                            @endif

                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fecha">Fecha de compra *</label>
                                                        <input type="date" class="form-control @error('fecha') is-invalid @enderror" name="fecha"
                                                            placeholder="Ingrese la fecha" value="{{$compras->fecha}}"
                                                            max="<?=date('Y-m-d');?>">
                                                            @error('fecha') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="estado"></label>
                                                        <select name="estado" value="{{$compras->estado}}" id="estado"
                                                            class="form-control @error('estado') is-invalid @enderror">
                                                            @error('estado') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                                            @if ($compras->estado==0)
                                                            <option value="0">Inactivo</option>
                                                            <option value="1">Activo</option>
                                                            @else
                                                            <option value="1">Activo</option>
                                                            <option value="0">Inactivo</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="factura"></label>
                                                        <input type="text" class="form-control @error('factura') is-invalid @enderror" name="factura"
                                                            placeholder="Ingrese numero de factura *"
                                                            value="{{old('factura', $compras->factura)}}" autofocus>
                                                            @error('factura') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="total">Total *</label>
                                                        <input type="number" class="form-control @error('total') is-invalid @enderror" id="total"
                                                            name="total" value="{{$compras->total}}" readonly>
                                                            @error('total') <span class="invalid-feedback">{{ $message }}</span> @enderror</div>
                                                    <input type="hidden" class="form-control" id="insumitos"
                                                        name="insumitos">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="col-12 text-center">
                                <a href="{{route('compras.create')}}" class="btn btn-primary" data-toggle="modal"
                                    data-target="#Form">Agregar Insumo</a>
                            </div>
                            <br>
                            <div class="table-responsive">
                                <table id="Compras" table id="compras" class="table table-bordered table-sm">
                                    <thead class="thead">
                                        <tr>
                                            <th>Insumo</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Sub Total</th>
                                            <th>Funciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tblInsumos">

                                        @foreach ($insumosa as $row)
                                        <tr id="tr-{{$row->id}}">
                                            <td>{{ $row->nombre}}</td>
                                            <td>{{ $row->cantidad_c}} {{ $row->nombre_u}}</td>
                                            <td>{{ $row->precio_c}}</td>
                                            <td>{{ $row->precio_c * $row->cantidad_c}}</td>
                                            <td><button type="button" class="btn btn-danger"
                                                    onclick="eliminar_insumo({{$row->id}}, {{$row->cantidad_c * $row->precio_c}} )">X</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>                           
                            <div class="text-center">
                                <a href="{{route('compras.index')}}" class="btn btn-secondary close-btn">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Guardar</button>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div wire:ignore.self class="modal fade" id="Form" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Agregar Insumo</h5>
                <button type="button" wire:click.prevent="cancel()" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="insumo"></label>
                        <select class="form-control " name="insumo" id="insumo" onchange="colocar_unidad()" required>
                                        <option value="">Seleccione el insumo</option>
                                        @foreach ( $insumos as $row )
                                        @if($row->estado==0)
                                        @continue
                                        @endif
                                        @foreach($unidades as $unidade)
                                        @if ($row->unidad_id==$unidade->id)
                                        <option unidad_id="{{$unidade->nombre}}" value="{{$row->id}}">{{$row->nombre}}</option>
                                        @endif
                                        @endforeach
                                        @endforeach
                                    </select>
                        @if ($errors->has('insumo'))
                        <span class="error text-danger" for="input-insumo">{{ $errors->first('insumo') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="cantidad"></label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad"
                            placeholder="Ingrese cantidad comprada" required>
                        @if ($errors->has('cantidad'))
                        <span class="error text-danger" for="input-cantidad">{{ $errors->first('cantidad') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="unidad_id"></label>
                        <input type="text" class="form-control" id="unidad_id" name="unidad_id" placeholder="Unidad" readonly required>
                    </div>
                    <div class="form-group">
                        <label for="precio"></label>
                        <input type="number" class="form-control" id="precio" name="precio" placeholder="Ingrese precio"
                            required>
                        @if ($errors->has('precio'))
                        <span class="error text-danger" for="input-precio">{{ $errors->first('precio') }}</span>
                        @endif
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Cerrar</button>
                <button type="submit" onclick="agregar_insumo()" data-dismiss="modal"
                    class="btn btn-primary close-modal">Agregar Insumo</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    let array=[];
    function colocar_unidad(){
            let unidad_id= $("#insumo option:selected").attr("unidad_id");
            $("#unidad_id").val(unidad_id);
            }
            
    function agregar_insumo() {
    let insumo_id = $("#insumo option:selected").val();
    let insumo_text = $("#insumo option:selected").text();
    let unidad_id = $("#unidad_id").val();
    let cantidad = $("#cantidad").val();
    let precio = $("#precio").val();

    if (insumo_id > 0 && cantidad > 0 && precio > 0) {
        array.push(insumo_id);
                for(var j = 0; j < array.length; j++){
                for(var i = j+1; i < array.length; i++){
                    if(array[j] == array[i] && insumo_id == array[i]){
                        alert("El insumo "+insumo_text+" ya esta registrado en la compra");
                        array.pop();
                        die();
                    }
                }
                }
        $("#tblInsumos").append(`
                        <tr id="tr-${insumo_id}">

                            <td>
                                <input type="hidden" name="insumo_id[]" value="${insumo_id}" />
                                <input type="hidden" name="cantidades[]" value="${cantidad}" />
                                <input type="hidden" name="precios[]" value="${precio}" />
                                ${insumo_text}

                            </td>
                            <td>${cantidad} ${unidad_id}</td>
                            <td>${precio}</td>
                            <td>${parseInt(precio) * parseInt(cantidad)}</td>
                            <td>
                                <button type="button" class="btn btn-danger" onclick="eliminar_insumo(${insumo_id}, ${parseInt(cantidad) * parseInt(precio)})" >X</button>
                            </td>

                        </tr>
                    `);
        let total = $("#total").val() || 0;
        $("#total").val(parseInt(total) + parseInt(cantidad) * parseInt(precio));
    } else {
        alert("Se debe ingresar una cantidad y/o precio valido");
    }
    $("#insumo").val('');
    $("#unidad_id").val('');
    $("#cantidad").val('');
    $("#precio").val('');
}

let insumitos = [];

function eliminar_insumo(id, subtotal) {
     id = id.toString();
                var index = array.indexOf(id);
                if (index !== -1){
                    array.splice(index, 1);
                }
    
        if(insumitos.includes(id, 0)){

        }else{
            let nuevoInsumitos = insumitos.push(id);
        }
    /* insumitos.forEach(function(elemento, indice, array) {
    }) */
    $("#tr-" + id).remove("");

    let total = $("#total").val() || 0;
    $("#total").val(parseInt(total) - subtotal);
    $("#insumitos").val(insumitos);
    /* <input type="hidden" name="insumitos[]" value="${insumitos}" />  */
}
</script>
@endsection