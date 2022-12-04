
@extends('admin')

@section('content')
@include('/tablas/tablaDetalles')
    <p>Esta es la informacion local sobre los pedidos</p>
    @if(auth()->user()->is_admin == 1)
        <a href="tablaPedidos/create"id="bt_nuevo" class="btn btn-primary">INGRESAR</a>
    @endif
    <table id='tablaPedidos' class="table table-striped" style="width:100%">
        <thead class="thead-dark">
            <tr>
                <th scope="id">ID</th>
                <th scope="id_usuario">USUARIO</th>
                <th scope="total">TOTAL</th>
                <th>ACCION</th>
                    
            </tr>
        </thead>
        <TBody>
            @foreach ($pedidos as $pedido)
                <tr>
                <td>{{ $pedido -> id}}</td>
                <td>{{ $pedido -> usuario -> name }}</td>
                <td>{{ $pedido -> total}}</td>
                <td>
                    <div>
                        <a href="{{ url('/tablaPedidos/edit/'.$pedido -> id) }}" type="submit" class="btn btn-outline-primary">Detalles</a>    
                        @if(auth()->user()->is_admin == 1)
                        <div>
                            <form method="POST" action="/tablaPedidos/destroy/{{$pedido->id}}" >
                                @csrf
                                <input type="submit" onclick="return confirm('Are you sure?')"
                                                    class='btn btn-outline-danger btnBorrar' value="Borrar"></input>
                            </form>
                        </div>  
                        @endif
                    </div>
                </td>
                </tr>
            @endforeach
        </TBody>
    </table>
    
@stop

@section('tabla')   
<script>
    $(document).ready(function() {
            $('#tablaPedidos').DataTable();
    });

    
</script>
@endsection
