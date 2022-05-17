<!-- Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear Proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
				<form>
                <div class="form-group">
                <label for="tipodoc_id"></label>
                <select wire:model="tipodoc_id"   name="tipodoc_id" id="tipodoc_id" class="form-control">
                    <option value="">>-- Escoja el tipo de documento --<</option>
                    @foreach($tipodocumentos as $tipodocumento)
                    <option value="{{$tipodocumento['id']}}">{{$tipodocumento['nombre']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="documento"></label>
                <input wire:model="documento" type="text" class="form-control" id="documento" placeholder="Documento">@error('documento') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="nombre"></label>
                <input wire:model="nombre" type="text" class="form-control" id="nombre" placeholder="Nombre">@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="email"></label>
                <input wire:model="email" type="text" class="form-control" id="email" placeholder="Email">@error('email') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="direccion"></label>
                <input wire:model="direccion" type="text" class="form-control" id="direccion" placeholder="Dirección">@error('direccion') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="celular"></label>
                <input wire:model="celular" type="text" class="form-control" id="celular" placeholder="Celular">@error('celular') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="categoria_id"></label>
                <select wire:model="categoria_id"   name="categoria_id" id="categoria_id" class="form-control">
                    <option value="">>-- Escoja la categoría --<</option>
                    @foreach($categoriaproveedores as $row)
                    <option value="{{$row['id']}}">{{$row['nombre']}}</option>
                    @endforeach
                </select>
                {{-- <input wire:model="categoria_id" type="text" class="form-control" id="categoria_id" placeholder="Categoría">@error('categoria_id') <span class="error text-danger">{{ $message }}</span> @enderror --}}
            </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Guardar</button>
            </div>
        </div>
    </div>
</div>
