@extends('dash.index')
@section('content')
<br>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('fichatecnicas.store')}}" method="post" class="form-horizontal">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
							<h4><i class="fab fa-laravel text-info"></i>
							Fichas Técnicas</h4>
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
                                                        <label for="nombre"></label>
                                                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" placeholder="Ingrese el nombre de la ficha" value="{{old('nombre')}}" autofocus>
                                                        @error('nombre') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">   
                            <div class="col-12 text-center">
                                <a href="{{route('fichatecnicas.create')}}" class="btn btn-primary" data-toggle="modal" data-target="#Form">Agregar Insumo</a>
                            </div>
                            <br>
                        <div class="table-responsive">
                            <table  id="Fichatecnicas" table id="fichatecnicas" class="table table-bordered table-sm">
                                <thead class="thead">
                                <tr>
                                    <th>Insumo</th>
                                    <th>Cantidad</th>
                                    <th>Funciones</th>
                                </tr>
                                </thead>
                                <tbody id="tblInsumos">
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            <a href="{{route('fichatecnicas.index')}}" class="btn btn-secondary close-btn">Cancelar</a>
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
                                    <h5 class="modal-title" id="createDataModalLabel">Agregar Insumo</h5>
                                    <button type="button" wire:click.prevent="cancel()" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true close-btn">×</span>
                                    </button>
                                </div>
                            <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="insumo"></label>
                                    <select class="form-control " name="insumo" id="insumo" required>
                                        <option value="">Seleccione el insumo</option>
                                        @foreach ( $insumos as $row )
                                        @if ($row->estado==0)
                                        @continue
                                        @endif
                                        <option value="{{$row->id}}">{{$row->nombre}}</option>
                                        @endforeach
                                    </select>
                                        @if ($errors->has('insumo'))
                                        <span class="error text-danger" for="input-insumo">{{ $errors->first('insumo') }}</span>
                                        @endif
                                </div>
                                <div class="form-group">
                                        <label for="cantidad"></label>
                                        <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Ingrese la cantidad necesaria" required>
                                        @if ($errors->has('cantidad'))
                                        <span class="error text-danger" for="input-cantidad">{{ $errors->first('cantidad') }}</span>
                                        @endif
                                </div>                                
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" onclick="agregar_insumo()" data-dismiss="modal" class="btn btn-primary close-modal">Agregar Insumo</button>
                                </div>
                            </form>
                            </div>
                            </div>
                        </div>
<script>
            
            


            function agregar_insumo(){
                let insumo_id = $("#insumo option:selected").val();
                let insumo_text = $("#insumo option:selected").text();
                let cantidad = $("#cantidad").val();

                if(insumo_id>0 &&cantidad > 0 ){
                    $("#tblInsumos").append(`
                        <tr id="tr-${insumo_id}">

                            <td>
                                <input type="hidden" name="insumo_id[]" value="${insumo_id}" />
                                <input type="hidden" name="cantidades[]" value="${cantidad}" />                               
                                ${insumo_text}

                            </td>
                            <td>${cantidad}</td>
                            <td>
                                <button type="button" class="btn btn-danger" onclick="eliminar_insumo(${insumo_id})" >X</button>
                            </td>

                        </tr>
                    `);
                }
                else {
                    alert("Se debe ingresar una cantidad valida");
                }
                $("#insumo").val('');
                $("#cantidad").val('');
            }

            function eliminar_insumo(id,subtotal){
                $("#tr-"+id).remove("");
            }
        </script>
@endsection


        


