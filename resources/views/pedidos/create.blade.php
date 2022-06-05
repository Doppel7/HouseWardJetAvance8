@extends('dash.index')
@section('content')
<br>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('pedidos.store')}}" method="post" class="form-horizontal">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
							<h4><i class="fab fa-laravel text-info"></i>
							Pedidos</h4>
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
                                    <label for="empleado_id"></label>
                                    <select class="form-control @error('empleado_id') is-invalid @enderror" name="empleado_id" id="empleado_id">
                                        <option value="">Seleccione el empleado</option>
                                        @foreach ( $empleados as $row )
                                        @if ($row->estado==0)
                                        @continue
                                        @endif
                                        <option value="{{$row->id}}">{{$row->nombre}}</option>
                                        @endforeach
                                    </select>
                                    <!-- @if ($errors->has('empleado_id'))
                                    <span class="error text-danger" for="input-empleado_id">{{ $errors->first('empleado_id') }}</span>
                                    @endif -->
                                </div>
                                <div class="form-group">
                                                <label for="fecha">Fecha del Pedido</label>
                                                <input type="date" class="form-control @error('fecha') is-invalid @enderror" name="fecha" placeholder="Ingrese la fecha" value="{{old('fecha')}}" autofocus max="<?=date('Y-m-d');?>">
                                                @error('fecha') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="form-group">
                                                <label for="total">Total</label>
                                                <input type="number" class="form-control @error('total') is-invalid @enderror" id="total" name="total" readonly>
                                                @error('total') <span class="invalid-feedback">{{ $message }}</span> @enderror</div>
                                                </div>
                                                </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        <div class="card-body">   
                            <div class="col-12 text-center">
                                <a href="{{route('pedidos.create')}}" class="btn btn-primary" data-toggle="modal" data-target="#Form">Agregar Producto</a>
                            </div>
                            <br>
                        <div class="table-responsive">
                            <table  id="Pedidos" table id="pedidos" class="table table-bordered table-sm">
                                <thead class="thead">
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Sub Total</th>
                                    <th>Funciones</th>
                                </tr>
                                </thead>
                                <tbody id="tblProductos">

                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            <a href="{{route('pedidos.index')}}" class="btn btn-secondary close-btn">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

                        <div wire:ignore.self class="modal fade" id="Form" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createDataModalLabel">Agregar Producto</h5>
                                    <button type="button" wire:click.prevent="cancel()" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true close-btn">×</span>
                                    </button>
                                </div>
                            <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="producto"></label>
                                    <select class="form-control " name="producto" id="producto" onchange="colocar_precio()">
                                        <option value="">Seleccione el producto</option>
                                        @foreach ( $productos as $row )
                                        @if ($row->estado==0)
                                        @continue
                                        @endif
                                        <option precio="{{$row->precio}}" value="{{$row->id}}">{{$row->nombre}}</option>
                                        @endforeach
                                    </select>
                                        @if ($errors->has('producto'))
                                        <span class="error text-danger" for="input-producto">{{ $errors->first('producto') }}</span>
                                        @endif
                                </div>
                                <div class="form-group">
                                        <label for="cantidad"></label>
                                        <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Ingrese cantidad del pedido" required>
                                        @if ($errors->has('cantidad'))
                                        <span class="error text-danger" for="input-cantidad">{{ $errors->first('cantidad') }}</span>
                                        @endif
                                </div>
                                <div class="form-group">
                                        <label for="precio" >Precio</label>
                                        <input type="number" class="form-control"  id="precio" name="precio" readonly>
                                        @if ($errors->has('precio'))
                                        <span class="error text-danger" for="input-precio">{{ $errors->first('precio') }}</span>
                                        @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" onclick="agregar_producto()" data-dismiss="modal" class="btn btn-primary close-modal">Agregar Producto</button>
                                </div>
                            </form>
                            </div>
                        </div>
                            

<script>
            
            function colocar_precio(){
                let precio=$("#producto option:selected").attr("precio");
                $("#precio").val(precio);
            }





            function agregar_producto(){
                let producto_id = $("#producto option:selected").val();
                let producto_text = $("#producto option:selected").text();
                let cantidad = $("#cantidad").val();
                let precio = $("#precio").val();

                if(producto_id>0 &&cantidad > 0 && precio > 0){
                    $("#tblProductos").append(`
                        <tr id="tr-${producto_id}">

                            <td>
                                <input type="hidden" name="producto_id[]" value="${producto_id}" />
                                <input type="hidden" name="cantidades[]" value="${cantidad}" />
                                <input type="hidden" name="precios[]" value="${precio}" />
                                ${producto_text}

                            </td>
                            <td>${cantidad}</td>
                            <td>${precio}</td>
                            <td>${parseInt(precio) * parseInt(cantidad)}</td>
                            <td>
                                <button type="button" class="btn btn-danger" onclick="eliminar_producto(${producto_id}, ${parseInt(cantidad) * parseInt(precio)})" >X</button>
                            </td>

                        </tr>
                    `);
                        let total = $("#total").val() || 0;
                        $("#total").val(parseInt(total) + parseInt(cantidad) * parseInt(precio));
                }
                else {
                    alert("Se debe ingresar una cantidad y/o precio valido");
                }
                $("#producto").val('');
                $("#cantidad").val('');
                $("#precio").val('');




            }

            function eliminar_producto(id,subtotal){
                $("#tr-"+id).remove("");
  
                let total = $("#total").val() || 0;
             $("#total").val(parseInt(total) - subtotal);


            }
        </script>
@endsection


