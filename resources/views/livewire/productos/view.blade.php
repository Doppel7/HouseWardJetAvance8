@section('title', __('Productos'))
<div class="container-fluid">
<br>
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
							Productos </h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }} </h5></code>
						</div>
						
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar Producto">
						</div>
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#createDataModal">
						<i class="fa fa-plus"></i>  Agregar Producto
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.productos.create')
						@include('livewire.productos.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Nombre</th>
								<th>Precio</th>
								<th>Categoría</th>
								<th>Ficha técnica</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($productos as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->nombre }}</td>
								<td>{{ $row->precio }}</td>
								@foreach($categoriaproductos as $categoriaproducto)
								@if($row->categoria_id==$categoriaproducto->id)
								<td>{{ $categoriaproducto->nombre}}</td>
								@break;
								@endif
								@endforeach
								@foreach($fichatecnicas as $fichatecnica)
								@if($row->ficha_id==$fichatecnica->id)
								<td>{{ $fichatecnica->nombre}}</td>
								@break;
								@endif
								@endforeach
								<td>
										@if($row->estado==''|| $row->estado==1)
											<p style="color:green"><strong>Activo</strong></p>
										@else
                                        	<p style="color:red"><strong>Inactivo</strong></p>
										@endif	
								</td>
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Acciones
									</button>
									<div class="dropdown-menu dropdown-menu-right">
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a>							 
								
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $productos->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
