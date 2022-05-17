@extends('dash.index')
<body>			
    @livewireScripts
<script type="text/javascript">
	window.livewire.on('closeModal', () => {
		$('#createDataModal').modal('hide');
	});
</script>
</body>
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @livewire('productos')
        </div>     
    </div>   
</div>
@endsection