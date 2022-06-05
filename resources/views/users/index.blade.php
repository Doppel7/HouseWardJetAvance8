@extends('dash.index')
<div style = "overflow-y:scroll">
@section('content')
<br>
<div class="container-fluid">
    <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    @if (session()->has('message'))
                        @if ( session('message') == 'Usuario registrado correctamente.')
                        <div wire:poll.4s class="btn btn-sm btn-success time" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} 
                        </div>
                        @elseif( session('message') == 'Usuario editado correctamente.')
                        <div wire:poll.4s class="btn btn-sm btn-success time" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} 
                        </div>
                        @endif
					@endif
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div class="float-left">
							    <h4><i class="fab fa-laravel text-info"></i>
							Usuarios</h4>
					        </div>
                            <div wire:poll.60s>
                                <code><h5>{{ now()->format('H:i:s') }} </h5></code>
						    </div>
                            <div>
                            <input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar Usuario">
						    </div>
                            <div class="row">
                                <div class="col-12 text-right">
                                <a href="{{route('users.create')}}" class="btn btn-sm btn-info"><i class="fa fa-plus"></i>Agregar Usuario</a>
                                </div>
                            </div>
                        </div>
                    </div>
                            
                        <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm">
                                        <thead class="thead">
                                        <tr>
                                            <th>#</th>
                                            <th>Rol</th>
                                            <th>Tipo de documento</th>
                                            <th>Documento</th>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th>Celular</th>
                                            <th>Fecha de nacimiento</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $user)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                @foreach($roles as $role)
								                @if($user->rol_id==$role->id)
								                <td>{{ $role->nombre}}</td>
								                @break;
								                @endif
								                @endforeach
                                                @foreach($tipodocumentos as $tipodocumento)
								                @if($user->tipodoc_id==$tipodocumento->id)
								                <td>{{ $tipodocumento->nombre}}</td>
								                @break;
								                @endif
								                @endforeach
                                                <td>{{$user->documento}}</td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->celular}}</td>
                                                <td>{{$user->fechadenacimiento}}</td>
                                                <td>
										        @if($user->estado==1)
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
                                                    <a href="{{ route('users.edit', $user->id) }}" class="dropdown-item"><i class="fa fa-edit"></i> Editar</a>
                                                    </div>
                                                </div>    
                                                </td>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-12">
                                {{$users->links()}}
                            </div>
                        </div>
                    </div>
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