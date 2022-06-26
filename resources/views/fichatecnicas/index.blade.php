@extends('dash.index')
<div style = "overflow-y:scroll">
@section('content')
<br>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                 @if (session()->has('message'))
                    @if ( session('message') == 'Ficha técnica registrada correctamente.')
                    <div wire:poll.4s class="btn btn-sm btn-success time" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} 
                    </div>
                    @elseif( session('message') == 'Ficha técnica editada correctamente.')
                    <div wire:poll.4s class="btn btn-sm btn-success time" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} 
                    </div>
                    @endif
				@endif
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
							<h4><i class="fab fa-laravel text-info"></i>
                            Fichas técnicas</h4>
					    </div>
                        <div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }} </h5></code>
						</div>
                        <div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar Ficha Técnica">
						</div>
                        <div class="row">
                                <div class="col-12 text-right">
                                <a href="{{route('fichatecnicas.create')}}" class="btn btn-sm btn-info" ><i class="fa fa-plus"></i> Agregar Ficha</a>
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
                                <th>Nombre</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($fichatecnicas as $ficha)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $ficha->nombre}}</td>
                                <td>
                                    @if ($ficha->estado==1)
                                        <p style="color:green"><strong>Activo</strong></p>
									@else
                                        <p style="color:red"><strong>Inactivo</strong></p>
                                    @endif
                                </td>
                                <td width="90">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup=" " aria-expanded="false">
									                Acciones
									    </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{route('fichatecnicas.pdf', $ficha->id)}}"
                                                class="dropdown-item"><i class="fa fa-edit"></i> PDF </a>
                                        <a href="{{route('fichatecnicas.show', $ficha->id)}}"
                                        class="dropdown-item"><i class="fa fa-edit"></i> Ver </a>
                                        <a href="{{route('fichatecnicas.edit', $ficha->id)}}"
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
                    {{$fichatecnicas->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@stop
</div>
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function() {
        $(".time").fadeOut(1500);
    },3000);
});
</script>