@extends('forms.formularioRaiz')

@section('contenido')
<form action="{{ url('tablaUsuarios/update/'.$id_usuario) }}" id="formUsuarios" method="post" enctype="multipart/form-data">
    @csrf
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <div class="mb-3">
        <label for="" class="form-label">NOMBRE USUARIO</label>
        <input id="nombre" value="{{$nombre_usuario}}" name="nombre" type="text" class="form-control" tabindex="1" required  oninvalid="this.setCustomValidity('Ingrese el nombre del usuario')" oninput="setCustomValidity('')">        
    </div>
    @error('nombre')
        <small>*{{$message}}</small>
        <br><br>
    @enderror

    <div class="mb-3">
        <label for="" class="form-label">EMAIL</label>
        <input id="email" value="{{$email}}" name="email" type="text" class="form-control" tabindex="1" required  oninvalid="this.setCustomValidity('Ingrese el email del usuario')" oninput="setCustomValidity('')">        
    </div>
    @error('stock')
        <small>*{{$message}}</small>
        <br><br>
    @enderror

    <div class="mb-3">
        <input type="submit" class="btn btn-primary" value="Agregar"> </input>
    </div>
</form>
@endsection