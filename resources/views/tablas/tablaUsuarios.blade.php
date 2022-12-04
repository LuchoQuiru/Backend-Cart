
@extends('admin')

@section('content')
    <p>Estas es la informacion local sobre los usuarios</p>
    <a href="tablaUsuarios/create" id="bt_nuevo" class="btn btn-primary">INGRESAR</a>
    <table id="tablaUsuarios" class="table table-striped" style="width:100%">
        <thead class="thead-dark">
            <tr>
                <th scope="id">ID</th>
                <th scope="name">NOMBRE</th>
                <th scope="email">MAIL</th>
                @if(auth()->user()->is_admin == 1)
                <th>ACCION</th>
                @endif
            </tr>
        </thead>
        <TBody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario -> id }}</td>
                    <td>{{ $usuario -> name }}</td>
                    <td>{{ $usuario -> email }}</td>
                    @if(auth()->user()->is_admin == 1)
                    <td>
                        <div>
                            <a href="{{ url('/tablaUsuarios/edit/'.$usuario -> id) }}" type="submit"  class="btn btn-outline-primary">Editar</a>    
                            <div>
                                <form method="POST" action="/tablaUsuarios/destroy/{{$usuario->id}}" >
                                    @csrf
                                    <input type="submit" onclick="return confirm('Estas seguro de eliminar el usuario {{$usuario->name}}?')"
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
            $('#tablaUsuarios').DataTable();
    });
</script>

@endsection