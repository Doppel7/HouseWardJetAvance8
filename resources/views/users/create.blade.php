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
                        <form action="{{route('users.store')}}" method="post" class="form-horizontal">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                <div class="col-12 grid-margin">
                                <div class="card">
                                    <div class="row">
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label for="tipodoc_id"></label>
                                            <select wire:model="tipodoc_id" name="tipodoc_id" id="tipodoc_id" class="form-control">
                                            <option value="">>-- Escoja el tipo de documento --<</option>
                                            @foreach($tipodocumentos as $tipodocumento)
                                            <option value="{{$tipodocumento['id']}}">{{$tipodocumento['nombre']}}</option>
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
                                            <select wire:model="rol_id"   name="rol_id" id="rol_id" class="form-control">
                                            <option value="">>-- Escoja el rol --<</option>
                                            @foreach($roles as $role)
                                            <option value="{{$role['id']}}">{{$role['nombre']}}</option>
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
                                                <input type="text" class="form-control" name="documento" placeholder="Ingrese el documento" autofocus>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name"></label>
                                                <input type="text" class="form-control" name="name" placeholder="Ingrese nombre" autofocus>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label for="celular"></label>
                                                <input type="text" class="form-control" name="celular" placeholder="Ingrese celular" autofocus>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label for="fechadenacimiento">Fecha de nacimiento</label>
                                                <input type="date" class="form-control" name="fechadenacimiento" placeholder="Ingrese la fechade nacimiento" autofocus>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label for="email"></label>
                                                <input type="text" class="form-control" name="email" placeholder="Ingrese email" autofocus>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label for="password"></label>
                                            <input type="password" class="form-control" name="password" placeholder="Contraseña" autofocus>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="text-center">
                                            <a href="{{route('users.index')}}" class="btn btn-secondary close-btn">Cancelar</a>
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                            </div>
                                            <br> 
                                        </div>
                                    </div>
                        </div>
                    </div>
                </form>
            </div>
                </div>
            </div>
        </div>
    </div>
@stop