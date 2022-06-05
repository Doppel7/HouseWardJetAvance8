@extends('dash.index')
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
                                Usuarios</h4>
					        </div>
                            <div wire:poll.60s>
                                <code><h5>{{ now()->format('H:i:s') }} </h5></code>
						    </div>
						    @if (session()->has('message'))
						    <div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} 
                            </div>
						    @endif
                        </div>
                    </div>
                        <form action="{{route('users.update', $user->id)}}" method="post" class="form-horizontal">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                            <p class="card-category">Editar Datos</p>
                            <div class="row">
                                <div class="col-12 grid-margin">
                                    <div class="card">
                                        <div class="row">
                                        
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label for="tipodoc_id"></label>
                                            <select wire:model="rol_id"   name="rol_id" value="{{$user->rol_id}}" id="rol_id" class="form-control">
                                            <option value="">>-- Escoja el rol * --<</option>
                                            @foreach($roles as $role)

                                            <option @if ($role->id==$user->rol_id)
                                                selected="true"
                                            @endif value="{{$role['id']}}">{{$role['nombre']}}</option>
                                            @endforeach
                                    </select>
                                            </div>
                                        </div> 
                                        <div class="col-md-3">
                                        </div>  
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label for="tipodoc_id"></label>
                                            <select wire:model="tipodoc_id" name="tipodoc_id"  id="tipodoc_id" class="form-control">
                                            <option  value="{{$user->tipodoc_id}}">>-- Escoja el tipo de documento * --<</option>
                                            @foreach($tipodocumentos as $tipodocumento)
                                            <option @if ($tipodocumento->id==$user->tipodoc_id)
                                                selected="true"
                                            @endif value="{{$tipodocumento['id']}}">{{$tipodocumento['nombre']}}</option>
                                            @endforeach
                                            </select>
                                            </div>
                                        </div>

                                            <div class="col-md-3">
                                            </div>
                                            <div class="col-md-3">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="documento"></label>
                                                    <input type="text" class="form-control @error('documento') is-invalid @enderror" name="documento" placeholder="Documento *" value="{{old('documento', $user->documento)}}" autofocus>
                                                    @error('documento') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                            </div>
                                            <div class="col-md-3">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name"></label>
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nombre *"value="{{$user->name}}" autofocus>
                                                    @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                            </div>
                                            <div class="col-md-3">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="celular"></label>
                                                    <input type="text" class="form-control @error('celular') is-invalid @enderror" name="celular" placeholder="Celular *" value="{{$user->celular}}" autofocus>
                                                    @error('celular') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                            </div>
                                            <div class="col-md-3">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fechadenacimiento">Fecha de nacimiento *</label>
                                                    <input type="date" class="form-control @error('fechadenacimiento') is-invalid @enderror" name="fechadenacimiento" value="{{$user->fechadenacimiento}}" autofocus max="<?=date('Y-m-d');?>">
                                                    @error('fechadenacimiento') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                            </div>
                                            <div class="col-md-3">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email"></label>
                                                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email *" value="{{$user->email}}" autofocus>
                                                    @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                                </div>  
                                            </div>  
                                            <div class="col-md-3">
                                            </div>
                                            <div class="col-md-3">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="password"></label>
                                                    <input type="password" class="form-control " name="password" placeholder="Ingrese la contraseña en caso de modificarla" autofocus>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                            </div>
                                            <div class="col-md-3">
                                            </div>
                                            <div class="col-md-6">
                                            <label for="estado"></label>
                                            <select   name="estado" value="{{$user->estado}}" id="estado" class="form-control">
                                            @if ($user->estado==0)
                                                <option value="0">Inactivo</option>
                                                <option value="1">Activo</option>
                                                @else
                                                <option value="1">Activo</option>
                                                <option value="0">Inactivo</option>
                                            @endif

                                            
                                            
                                            </select>
                                            <br>
                                            </div>                                                                           
                                            <div class="col-md-12">
                                                <div class="text-center">
                                                <a href="{{route('users.index')}}" class="btn btn-secondary close-btn">Cancelar</a>
                                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                                </div>
                                                <br> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
@stop