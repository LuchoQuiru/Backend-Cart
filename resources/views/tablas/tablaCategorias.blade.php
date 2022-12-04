@extends('admin')

@section('content')
    <p>Estas es la informacion local sobre las categorias</p>
    @if(auth()->user()->is_admin == 1)
        <a href=" {{ url('/tablaCategorias/create') }} " id="bt_nuevo" class="btn btn-primary">INGRESAR</a>
    @endif
    <table id="tablaCategorias" class="table table-striped" style="width:100%">
        <thead class="thead-dark">
            <tr>
                <th scope="id">ID</th>
                <th scope="nombre">CATEGORIA</th>
                @if(auth()->user()->is_admin == 1)
                    <th scope="acciones">ACCIONES</th>
                @endif
            </tr>
        </thead>
        <TBody>
            @foreach ($categorias as $categoria)
                <tr>
                    <td>{{ $categoria -> id }}</td>
                    <td>{{ $categoria -> nombre}}</td>
                    @if(auth()->user()->is_admin == 1)
                    <td>
                        <div>
                            <a href="{{url('tablaCategorias/edit/'.$categoria->id)}}" 
                                                        class='btn btn-outline-primary btnEditar'>Editar</a>
                            <form action="{{url('tablaCategorias/destroy/'.$categoria->id)}}" method="POST">
                                @csrf
                                <input type="submit" onclick="return confirm('Are you sure?')" class='btn btn-outline-danger btnBorrar' value="Borrar"></input>
                            </form>
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
            $('#tablaCategorias').DataTable();
        });
    </script>
@endsection

@section('javascript')
    <script src="js/submit_bootstrap.js/"></script>
@endsection