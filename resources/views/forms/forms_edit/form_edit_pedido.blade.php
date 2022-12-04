@extends('forms.formularioRaiz')

@section('contenido')
@include('forms.forms_edit.form_edit_detalle')

<form action="{{ url('tablaPedidos/update/'.$id_pedido) }}" id="formPedidos" method="post" enctype="multipart/form-data">
@csrf
    <div class="mb-3">
        <label for="" class="form-label">USUARIO ASOCIADO</label>
        <select id="usuario" name="usuario" class="form-control input-lg dynamic" data-dependent="state">
                @foreach($usuarios as $usuario) 
                    @if($usuario == $usuario_seleccionado)
                        <option selected='selected'> {{ $usuario }} </option>
                    @else
                        <option> {{ $usuario }} </option>
                    @endif
                @endforeach
        </select>
            @error('usuario')
                <small>*{{$message}}</small>
                <br><br>
            @enderror
    </div>

    @if(auth()->user()->is_admin == 1)
    <div>
    <button type="button" class="btn btn-primary" data-toggle="modal" onclick="agregarUsuarioALaSesion()"
                data-id="productos, id_pedido" data-target="#modal_detalle_pedido_edit">Agregar productos</button>
    <input type="submit" class="btn btn-success" value='Actualizar pedido'></input>
    </div>
    @endif
    

    <!-- Boton de agregar un nuevo pedido o editar un pedido existente -->
    <div class="mb-3">
        
    </div>
</form>

<div id="divTablaDinamicaDetalles"></div>

@endsection

<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function(){ 
        verTabla();
    });

    function verTabla(){
        $.ajax({
            type: "GET",
            url: "{{ url('/tablaPedidos/tabla_detalles_edit_pedido/'.$id_pedido) }} ",
            headers: {'X-CSRF-Token': '{{ csrf_token() }}'},
            success: function(response) {
                $('#divTablaDinamicaDetalles').empty().html(response); 
            }
        });
        
    }

    function agregarUsuarioALaSesion(){
        var usuario_seleccionado = document.getElementById("usuario").value;
        $.ajax({
            type: "POST",
            url: "{{ url('/tablaPedidos/agregarUsuarioALaSesion') }} ",
            headers: {'X-CSRF-Token': '{{ csrf_token() }}'},
            data: { usuario : usuario_seleccionado} 
        });
    }  


</script>

