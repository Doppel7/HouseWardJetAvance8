@section('title', __('Categoriainsumos'))
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
							Categoría de Insumos</h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }} </h5></code>
						</div>
						
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar Categoría">
						</div>
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#createDataModal">
						<i class="fa fa-plus"></i>  Agregar Categoría
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.categoriainsumos.create')
						@include('livewire.categoriainsumos.update')
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
							@foreach($categoriainsumos as $row)
							<tr>
								<td>{{$loop->iteration}}</td>
								<td>{{ $row->nombre }}</td>
								<td>
									@if($row->estado==1)
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
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a>							 
									<a class="dropdown-item" onclick="confirm('Confirm Delete Categoriainsumo id {{$row->id}}? \nDeleted Categoriainsumos cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Eliminar </a>   
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $categoriainsumos->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
