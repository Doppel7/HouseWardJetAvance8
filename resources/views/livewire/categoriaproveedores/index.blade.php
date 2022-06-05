@extends('dash.index')
<body>			
    @livewireScripts
<script type="text/javascript">
	window.livewire.on('closeModal', () => {
		$('#createDataModal').modal('hide');
	});
</script>
<script type="text/javascript">
	window.livewire.on('closeModal', () => {
		$('#updateModal').modal('hide');
	});
</script>
</body>
@section('content')
<br>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @livewire('categoriaproveedores')
        </div>     
    </div>   
</div>
@endsection