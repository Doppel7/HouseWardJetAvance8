@section('title', __('Proveedores'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
			@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fab fa-laravel text-info"></i>
							Proveedores </h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }}</h5></code>
						</div>
						
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar Proveedor">
						</div>
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#createDataModal">
						<i class="fa fa-plus"></i>  Agregar Proveedor
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.proveedores.create')
						@include('livewire.proveedores.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Tipo de Documento</th>
								<th>Documento</th>
								<th>Nombre</th>
								<th>Email</th>
								<th>Direccion</th>
								<th>Celular</th>
								<th>Categoría</th>
								<th>Estado</th>
								<td>Acciones</td>
							</tr>
						</thead>
						<tbody>
							@foreach($proveedores as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								@foreach($tipodocumentos as $tipodocumento)
								@if($row->tipodoc_id==$tipodocumento->id)
								<td>{{ $tipodocumento->nombre}}</td>
								@break;
								@endif
								@endforeach
								<td>{{ $row->documento }}</td>
								<td>{{ $row->nombre }}</td>
								<td>{{ $row->email }}</td>
								<td>{{ $row->direccion }}</td>
								<td>{{ $row->celular }}</td>
								@foreach($categoriaproveedores as $categoriaproveedore)
								@if($row->categoria_id==$categoriaproveedore->id)
								<td>{{ $categoriaproveedore->nombre}}</td>
								@break;
								@endif
								@endforeach
								<td>
										@if($row->estado==1)
										<button type="button" class="btn btn-sm btn-success">Activo</button>
										@else
										<button type="button" class="btn btn-sm btn-danger">Inactivo</button>
										@endif
								</td>
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Acciones
									</button>
									<div class="dropdown-menu dropdown-menu-right">
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a>							 
									<a class="dropdown-item" onclick="confirm('Confirm Delete Proveedore id {{$row->id}}? \nDeleted Proveedores cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Eliminar </a>   
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $proveedores->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
