<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Editar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
            <div class="form-group">
                <label for="nombre"></label>
                <input wire:model="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" placeholder="Nombre">@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="precio"></label>
                <input wire:model="precio" type="text" class="form-control @error('precio') is-invalid @enderror" id="precio" placeholder="Precio">@error('precio') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="categoria_id"></label>
                <select wire:model="categoria_id"   name="categoria_id" id="categoria_id" class="form-control @error('categoria_id') is-invalid @enderror">
                    <option value="">>-- Escoja la categoría --<</option>
                    @foreach($categoriaproductos as $row)
                    <option value="{{$row['id']}}">{{$row['nombre']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="ficha_id"></label>
                <select wire:model="ficha_id"   name="ficha_id" id="ficha_id" class="form-control @error('ficha_id') is-invalid @enderror">
                    <option value="">>-- Escoja la ficha técnica --<</option>
                    @foreach($fichatecnicas as $row)
                    <option value="{{$row['id']}}">{{$row['nombre']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input form-control" id="estado" wire:model="estado">@error('estado') <span class="error text-danger">{{ $message }}</span> @enderror
                    <label class="custom-control-label" for="estado">Estado</label>
            </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary close-modal" >Guardar</button>
            </div>
       </div>
    </div>
</div>
