<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Editar Proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
				<form>
                <div class="form-group">
                <label for="tipodoc_id"></label>
                <select wire:model="tipodoc_id"   name="tipodoc_id" id="tipodoc_id" class="form-control @error('tipodoc_id') is-invalid @enderror">
                    <option value="">>-- Escoja el tipo de documento --<</option>
                    @foreach($tipodocumentos as $tipodocumento)
                    <option value="{{$tipodocumento['id']}}">{{$tipodocumento['nombre']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="documento"></label>
                <input wire:model="documento" type="text" class="form-control @error('documento') is-invalid @enderror" id="documento" placeholder="Documento">@error('documento') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="nombre"></label>
                <input wire:model="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" placeholder="Nombre">@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="email"></label>
                <input wire:model="email" type="text" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email">@error('email') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="direccion"></label>
                <input wire:model="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" id="direccion" placeholder="Dirección">@error('direccion') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="celular"></label>
                <input wire:model="celular" type="text" class="form-control @error('celular') is-invalid @enderror" id="celular" placeholder="Celular">@error('celular') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="categoria_id"></label>
                <select wire:model="categoria_id"   name="categoria_id" id="categoria_id" class="form-control @error('categoria_id') is-invalid @enderror">
                    <option value="">>-- Escoja la categoría --<</option>
                    @foreach($categoriaproveedores as $row)
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
