
@extends('admin')

@section('content')
    <p>Esta es la informacion local sobre las ofertas</p>
    @if(auth()->user()->is_admin == 1)
        <a href="tablaOfertas/create" id="bt_nuevo" class="btn btn-primary">INGRESAR</a>
    @endif
    <table id="tablaOfertas" class="table table-striped" style="width:100%">
        <thead class="thead-dark">
            <tr>
                <th scope="id">ID</th>
                <th scope="image">IMAGEN</th>
                <th scope="producto">PRODUCTO</th>
                <th scope="descuento">DESCUENTO</th>
                <th scope="fecha_inicio">DESDE</th>
                <th scope="fecha_fin">HASTA</th>
                @if(auth()->user()->is_admin == 1)
                <th>ACCION</th>
                @endif
            </tr>
        </thead>
        <TBody>
            @foreach ($ofertas as $oferta)
                <tr>
                    <td>{{ $oferta -> id }}</td>
                    <td><img class="rounded" src="{{$oferta->producto->nombre_producto}}.jpg" width="150"></td> 
                    <td>{{ $oferta -> producto -> nombre_producto}}</td>
                    <td>{{ $oferta -> descuento}}</td>
                    <td>{{ $oferta -> fecha_inicio}}</td>
                    <td>{{ $oferta -> fecha_fin}}</td>
                    @if(auth()->user()->is_admin == 1)
                    <td>                    
                        <div>
                            <a href="{{url('tablaOfertas/edit/'.$oferta->id)}}" 
                                                        class='btn btn-outline-primary btnEditar'>Editar</a>
                            <div>
                                <form method="POST" action="tablaOfertas/destroy/{{$oferta->id}}" >
                                    @csrf
                                    <input type="submit" onclick="return confirm('Estas seguro de eliminar la oferta?')"
                                                        class='btn btn-outline-danger btnBorrar' value="Borrar"></input>
                                </form>
                            </div>  
                        </div>
                    </td>
                    @endif
                </tr>
            @endforeach
        </TBody>
    </table>
@stop

@section('tabla')
    <script>
        $(document).ready(function() {
            $('#tablaOfertas').DataTable()});
    </script>
@endsection