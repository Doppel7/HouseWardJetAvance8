<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>    
table {     
        font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
        font-size: 12px;    
        margin: 45px;     
        width: 480px; 
        text-align: left;    
        border-collapse: collapse; 
        text-align: center;
        }

th {     
        font-size: 13px;     
        font-weight: normal;     
        padding: 8px;     
        background: #b9c9fe;
        border-top: 4px solid #aabcfe;    
        border-bottom: 1px solid #fff; 
        color: #039; 
    }

td {    
        padding: 8px;     
        background: #e8edff;     
        border-bottom: 1px solid #fff;
        color: #669;    
        border-top: 1px solid transparent; 
    }

tr:hover td { 
    background: #d0dafd; 
    color: #339; 
    }
</style>
<body>
        @if (count($insumos) > 0)
        <div style="text-align:center;">
                <div style="margin: 0 auto;">
                        <img  src="vendor/adminlte/dist/img/logo2.png" alt="">
                    </div>
                    <h2 style="padding-top:5px; margin: 0 auto; display: inline-block">PDF Fichas</h2>
                </div>
                <div class="card-body" >
                    <div class="table-responsive">
                        <table id="compras" class="table table-bordered table-sm" style="margin: auto auto; padding: 20px">
                            <thead class="thead">
                                <tr>
                                    <th>Nombre</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fichatecnicas as $ficha)
                                <tr>
                                    <td>{{ $ficha->nombre}}</td>
                                </td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div style="display: flex; justify-content: space-between; align-items: center;">
                                                <div class="float-left">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="card-body">
                                            @if (session('success'))
                                            <div class="alert alert-success" role="success">
                                                {{ session('success') }}
                                            </div>
                                            @endif
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="fichatecnicas" class="table table-bordered table-sm" style="margin: auto auto;">
                                                        <thead class="thead">
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Insumo</th>
                                                                <th>Cantidad</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            
                                                            @foreach ($insumos as $row)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{ $row->nombre}} </td>
                                                                <td>{{ $row->cantidad_c}} {{ $row->nombre_u}}</td>                             
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </body>
            </html>