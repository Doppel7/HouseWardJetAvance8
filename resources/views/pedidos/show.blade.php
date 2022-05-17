@extends('dash.index')

@section('content')
<br>
@if (count($productos) > 0)
<div class="content">
    <div class="container-fluid">
        <div class="row">
                <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div class="float-left">
                                <h4><i class="fab fa-laravel text-info"></i>
                                Detalle Pedidos</h4>
                            </div>
                                <div wire:poll.60s>
                                <code><h5>{{ now()->format('H:i:s') }} </h5></code>
                                </div>
                            </div>
                        </div>                        
                        <div class="card-body">
                            @if (session('success'))
                           <div class="alert alert-success" role="success">
                                {{ session('success') }}
                            </div>
                            @endif
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="compras" class="table table-bordered table-sm">
                                        <thead class="thead">
                                        <tr>
                                        <th>#</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        @foreach ($productos as $row)
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ $row->nombre}}</td>
                                            <td>{{ $row->cantidad_p}}</td>                             
                                            <td>{{ $row->precio_p}}</td>
                                            <td>{{ $row->precio_p * $row->cantidad_p}}</td>
                                        </tr>
                                     @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center">
                                    <a href="{{route('pedidos.index')}}" class="btn btn-secondary close-btn">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endif
@endsection
