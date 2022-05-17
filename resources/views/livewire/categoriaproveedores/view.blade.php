@section('title', __('Categoriaproveedores'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fab fa-laravel text-info"></i>
							Categoría de Proveedores</h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }}</h5></code>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar Categoría">
						</div>
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#createDataModal">
						<i class="fa fa-plus"></i>  Agregar Categoría
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.categoriaproveedores.create')
						@include('livewire.categoriaproveedores.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Nombre</th>
								<th>Estado</th>
								<td>Acciones</td>
							</tr>
						</thead>
						<tbody>
							@foreach($categoriaproveedores as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->nombre }}</td>
								<td>
									@if($row->estado==''|| $row->estado==1)
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
									<a class="dropdown-item" onclick="confirm('Confirm Delete Categoriaproveedore id {{$row->id}}? \nDeleted Categoriaproveedores cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Eliminar </a>   
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $categoriaproveedores->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
