@extends('dash.index')
<div style = "overflow-y:scroll">
@section('content')
<br>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
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
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} 
                        </div>
						@endif
                        <div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar Categoría">
						</div>
                        <div class="row">
                                <div class="col-12 text-right">
                                <a href="{{route('compras.create')}}" class="btn btn-sm btn-info" ><i class="fa fa-plus"></i> Agregar Compra</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="compras" class="table table-bordered table-sm">
                            <thead class="thead">
                            <tr>
                                <th>#</th>
                                <th>No.</th>
                                <th>Factura</th>
                                <th>Fecha</th>
                                <th>Proveedor</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($compras as $compra)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $compra->id}}</td>
                                <td>{{ $compra->factura}}</td>
                                <td>{{ $compra->fecha}}</td>
                                @foreach ($proveedores as $row)
                                @if ($compra->proveedor_id==$row->id)
                                <td>{{ $row->nombre}}</td>
                                @endif
                                @endforeach
                                <td>{{ $compra->total }}</td>
                                <td class="td-actions text-right">
                                    @if ($compra->estado==1)
                                        <button type="button" class="btn btn-sm btn-success">Activo</button>
                                    @else
                                        <button type="button" class="btn btn-sm btn-danger">Inactivo</button>
                                    @endif
                                </td>
                                <td width="90">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup=" " aria-expanded="false">
									                Acciones
									    </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{route('compras.pdf', $compra->id)}}"
                                                        class="dropdown-item"><i class="fa fa-edit"></i> PDF</a>
                                        <a href="{{route('compras.show', $compra->id)}}"
                                        class="dropdown-item"><i class="fa fa-edit"></i> Ver</a>	
                                        <a href="{{route('compras.edit', $compra->id)}}"
                                                class="dropdown-item"><i class="fa fa-edit"></i> Editar </a>	         
                                        </div>
                                    </div>
                                </td>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12">
                    {{$compras->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@stop
</div>
