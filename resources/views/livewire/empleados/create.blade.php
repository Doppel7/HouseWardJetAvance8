<!-- Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear Empleado</h5>
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
                <input wire:model="nombre" type="text" class="form-control" id="nombre" placeholder="Nombre" required>@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="email"></label>
                <input wire:model="email" type="text" class="form-control" id="email" placeholder="Email">@error('email') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="direccion"></label>
                <input wire:model="direccion" type="text" class="form-control" id="direccion" placeholder="Direccion">@error('direccion') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="municipio"></label>
                <select wire:model="municipio"   name="municipio" id="municipio" class="form-control">
                    <option value="">>-- Escoja el municipio --<</option>
                    @foreach($municipios as $municipio)
                    <option value="{{$municipio['id']}}">{{$municipio['nombre']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="fechadenacimiento">Fecha de Nacimiento</label>
                <input wire:model="fechadenacimiento" type="date" class="form-control" id="fechadenacimiento" placeholder="Fechadenacimiento">@error('fechadenacimiento') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="telefono"></label>
                <input wire:model="telefono" type="text" class="form-control" id="telefono" placeholder="Telefono">@error('telefono') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="celular"></label>
                <input wire:model="celular" type="text" class="form-control" id="celular" placeholder="Celular">@error('celular') <span class="error text-danger">{{ $message }}</span> @enderror
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
