
<table id="tablaDinamicaDetalles" class="table table-striped" style="width:100%">
        <thead class="thead-dark">
            <tr>
                <th scope="image">IMAGEN</th>
                <th scope="producto">PRODUCTO</th>
                <th scope="precio">PRECIO</th>
                <th scope="cantidad">CANTIDAD</th>
                <th scope="total">TOTAL</th>
                @if(auth()->user()->is_admin == 1)
                    <th scope="accion">ACCION</th>
                @endif
            </tr>
        </thead>
        <TBody>
            @if($detalles != null)
            @foreach ($detalles as $detalle)
                <tr>
                    <td><img class="rounded" src="/{{ $detalle -> producto ->nombre_producto}}.jpg" width="150"></td> 
                    <td>{{ $detalle -> producto ->nombre_producto}}</td>
                    <td>{{ $detalle -> producto ->precio}}</td>
                    <td>{{ $detalle -> cantidad}}</td>
                    <td>{{ ($detalle -> producto ->precio) * ($detalle -> cantidad)}}</td>
                    @if(auth()->user()->is_admin == 1)
                    <td>
                        <div>
                        <form method="POST" action="/tablaPedidos/destroyDetalleEditSession/{{$id_pedido}}/{{$detalle->producto->nombre_producto}}" >
                            @csrf
                            <input type="submit" onclick="return confirm('Estas seguro de eliminar el detalle del producto {{$detalle->producto->nombre_producto}}?')"
                                                class='btn btn-outline-danger btnBorrar' value="Borrar"></input>
                        </form>
                        </div> 
                    </td>
                    @endif
                </tr>
            @endforeach
            @endif
        </TBody>
</table>

<script>
    $(document).ready( function () {
        $('#tablaDinamicaDetalles').DataTable();
    });

</script>
