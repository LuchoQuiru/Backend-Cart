@extends('admin')

@section('content')
<p>Esta es la informacion local sobre los productos</p>
@if(auth()->user()->is_admin == 1)
    <a href="tablaProductos/create" id="bt_nuevo" class="btn btn-success">INGRESAR</a>
@endif
<!-- <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">NUEVO</button> -->

<table id="tablaProductos" class="table table-striped" style="width:100%">
    <thead class="thead-dark">
        <tr>
            <th scope="id">ID</th>
            <th scope="image">IMAGEN</th>
            <th scope="nombre_producto">NOMBRE</th>
            <th scope="nombre_categoria">CATEGORIA</th>
            <th scope="stock">STOCK</th>
            <th scope="precio">PRECIO</th>
            @if(auth()->user()->is_admin == 1)
                <th scope="accion">ACCION</th>
            @endif
        </tr>
    </thead>
    <TBody>
        @foreach ($productos as $producto)
        <tr>
            <td>{{ $producto -> id }}</td>
            <td><img class="rounded" src="{{$producto->nombre_producto}}.jpg" width="150"></td> 
            <td>{{ $producto -> nombre_producto }}</td>
            <td>{{ $producto -> categoria -> nombre }}</td>
            <td>{{ $producto -> stock }}</td>
            <td>{{ $producto -> precio}}</td>
            <td>
                @if(auth()->user()->is_admin == 1)
                <div>
                    <a href="{{url('tablaProductos/edit/'.$producto->id)}}" class='btn btn-outline-primary btnEditar'>Editar</a>

                    <div>
                        <form method="POST" action="/tablaProductos/destroy/{{$producto->id}}">
                            @csrf
                            <input type="submit" onclick="return confirm('Are you sure?')" class='btn btn-outline-danger btnBorrar' value="Borrar"></input>
                        </form>
                    </div>
                </div>
                @endif
            </td>
        </tr>
        @endforeach
    </TBody>
</table>
@stop

@section('tabla')
<script>
    $(document).ready(function() {
        $('#tablaProductos').DataTable();
    });
</script>

@endsection