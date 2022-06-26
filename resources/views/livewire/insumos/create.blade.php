<!-- Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear insumo</h5>
                <button type="button" wire:click.prevent="cancel()" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
				<form>
            <div class="form-group">
                <label for="nombre"></label>
                <input wire:model="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" placeholder="Nombre *">@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="unidad_id"></label>
                <select wire:model="unidad_id"   name="unidad_id" id="unidad_id" class="form-control @error('unidad_id') is-invalid @enderror">
                    <option value="">>-- Escoja la unidad * --<</option>
                    @foreach($unidades as $row)
                    <option value="{{$row['id']}}">{{$row['nombre']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="categoria_id"></label>
                <select wire:model="categoria_id"   name="categoria_id" id="categoria_id" class="form-control @error('categoria_id') is-invalid @enderror">
                    <option value="">>-- Escoja la categoría * --<</option>
                    @foreach($categoriainsumos as $row)
                    @if($row->estado==0)
                    @continue
                    @endif
                    <option value="{{$row['id']}}">{{$row['nombre']}}</option>
                    @endforeach
                </select>
            </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary close-btn" data-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Guardar</button>
            </div>
        </div>
    </div>
</div>
