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
                                            <select wire:model="tipodoc_id" name="tipodoc_id" id="tipodoc_id" class="form-control @error('tipodoc_id') is-invalid @enderror" value="{{old('tipodoc_id')}}">
                                            @error('tipodoc_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                            <option value="">>-- Escoja el tipo de documento * --<</option>
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
                                            <select name="rol_id" id="rol_id" class="form-control @error('rol_id') is-invalid @enderror" value="{{old('rol_id')}}">
                                            @error('rol_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                            <option value="">>-- Escoja el rol * --<</option>
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
                                                <input wire:model="documento" type="text" class="form-control @error('documento') is-invalid @enderror" name="documento"  value="{{old('documento')}}" placeholder="Ingrese el documento *" autofocus >
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
                                                <input wire:model="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" placeholder="Ingrese el nombre *" autofocus>
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
                                                <input wire:model="celular" type="text" class="form-control @error('celular') is-invalid @enderror" name="celular" value="{{old('celular')}}" placeholder="Ingrese el celular *" autofocus>
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
                                                <input wire:model="fechadenacimiento" type="date" class="form-control @error('fechadenacimiento') is-invalid @enderror" name="fechadenacimiento" value="{{old('fechadenacimiento')}}" placeholder="Ingrese la fecha de nacimiento *" autofocus max="<?=date('Y-m-d');?>">
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
                                                <input wire:model="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" placeholder="Ingrese el email *" autofocus>
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
                                            <input wire:model="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{old('password')}}" placeholder="Contraseña *" autofocus>
                                            @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
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