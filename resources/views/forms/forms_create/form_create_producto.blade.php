@extends('forms.formularioRaiz')
@section('contenido')
<form action="{{ url('tablaProductos/store') }}" id="formProductos" method="post" enctype="multipart/form-data">
    @csrf
    </div>
    <div class="mb-3">
        <label for="" class="form-label">NOMBRE PRODUCTO</label>
        <input id="nombre_producto" value="{{ old('nombre_producto') }}" name="nombre_producto" type="text" class="form-control" tabindex="1" required oninvalid="this.setCustomValidity('Ingrese el nombre del producto')" oninput="setCustomValidity('')">

        @error('nombre_producto')
        <small>*{{$message}}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label for="" class="form-label">PRECIO POR UNIDAD</label>
        <input id="precio" value="{{ old('precio') }}" name="precio" type="text" class="form-control" tabindex="1" required oninvalid="this.setCustomValidity('Ingrese el precio del producto')" oninput="setCustomValidity('')">
        @error('precio')
        <small>*{{$message}}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label for="" class="form-label">STOCK</label>
        <input id="stock" value="{{ old('stock') }}" name="stock" type="text" class="form-control" tabindex="1" required oninvalid="this.setCustomValidity('Ingrese el stock del producto')" oninput="setCustomValidity('')">
        @error('stock')
        <small>*{{$message}}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label for="" class="form-label">NOMBRE CATEGORIA</label>
        <select id="categorias" name="nombre_categoria" class="form-control input-lg dynamic" data-dependent="state" required oninvalid="this.setCustomValidity('Seleccione la categoria del producto')" oninput="setCustomValidity('')">
            <option value="">Seleccione una categoria</option>
            @foreach($categorias as $categoria)
            <option> {{ $categoria }} </option>
            @endforeach

        </select>
        @error('nombre_categoria')
        <small>*{{$message}}</small>
        @enderror
    </div>

    <div class="mb-3 mt-4">
        <label class="fs-4 form-label">Imagen</label>
        <input type="file" name="image" class="form-control w-50" id="image" required>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary" value="Agregar">Agregar</input>
    </div>
</form>

@stop

@section('javascript')
<script src="{{'js/submit_bootstrap.js'}}"></script>
@endsection