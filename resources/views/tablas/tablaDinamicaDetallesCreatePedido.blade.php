
<table id="tablaDinamicaDetalles" class="table table-striped" style="width:100%">
        <thead class="thead-dark">
            <tr>
                <th scope="producto">PRODUCTO</th>
                <th scope="precio">PRECIO</th>
                <th scope="cantidad">CANTIDAD</th>
                <th scope="total">TOTAL</th>
                <th scope="accion">ACCION</th>
            </tr>
        </thead>
        <TBody>
            @if($detalles != null)
            @foreach ($detalles as $detalle)
                <tr>
                    <td>{{ $detalle -> producto ->nombre_producto}}</td>
                    <td>{{ $detalle -> producto ->precio}}</td>
                    <td>{{ $detalle -> cantidad}}</td>
                    <td>{{ ($detalle -> producto ->precio) * ($detalle -> cantidad)}}</td>
                    <td>
                    <div>
                        <form method="POST" action="/tablaPedidos/destroyDetalleCreateSession/{{$detalle->producto->nombre_producto}}" >
                            @csrf
                            <input type="submit" onclick="return confirm('Estas seguro de eliminar el detalle del producto{{$detalle->producto->nombre_producto}}?')"
                                                class='btn btn-outline-danger btnBorrar' value="Borrar"></input>
                        </form>
                    </div> 
                        
                    </td>
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
