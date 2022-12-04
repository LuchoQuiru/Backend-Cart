@extends('forms.formularioRaiz')

@section('contenido')
<form action="{{ url('tablaCategorias/update/'.$id_categoria) }}" id="formCategorias" method="post" enctype="multipart/form-data">
    @csrf
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <div class="mb-3">
        <label for="" class="form-label">NOMBRE CATEGORIA</label>
        <input id="nombre" value="{{$nombre_categoria}}" name="nombre" type="text" class="form-control" tabindex="1" required  oninvalid="this.setCustomValidity('Ingrese un nombre para la categoria')" oninput="setCustomValidity('')">        
    </div>
    @error('nombre')
        <small>*{{$message}}</small>
        <br><br>
    @enderror

    <div class="mb-3">
        <input type="submit" class="btn btn-primary" value="Agregar"> </input>
    </div>
</form>
@endsection


@section('javascript')
    <script src=" {{ 'js/submit_bootstrap.js' }} "></script>
@endsection