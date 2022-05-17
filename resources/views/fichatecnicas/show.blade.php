@extends('dash.index')

@section('content')
<br>
@if (count($insumos) > 0)
<div class="content">
    <div class="container-fluid">
        <div class="row">
                <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div class="float-left">
                                <h4><i class="fab fa-laravel text-info"></i>
                                Detalle Ficha Técnica</h4>
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
                                    <table id="fichatecnicas" class="table table-bordered table-sm">
                                        <thead class="thead">
                                        <tr>
                                        <th>#</th>
                                        <th>Insumo</th>
                                        <th>Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        @foreach ($insumos as $row)
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ $row->nombre}}</td>
                                            <td>{{ $row->cantidad_c}}</td>                             
                                        </tr>
                                     @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center">
                                    <a href="{{route('fichatecnicas.index')}}" class="btn btn-secondary close-btn">Cancelar</a>
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
