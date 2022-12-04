@extends('forms.formularioRaiz')
@section('contenido')
        <form action="{{ url('tablaOfertas/store') }}" id="formOferta" method="post" enctype="multipart/form-data">
            @csrf
            </div>
                    <div class="mb-3">
                        <label for="" class="form-label">PRODUCTO</label>
                        <select id="nombre_producto" name="nombre_producto" class="form-control input-lg dynamic" data-dependent="state" required  oninvalid="this.setCustomValidity('Seleccione el producto para la oferta')" oninput="setCustomValidity('')"> 
                            <option value="">Seleccione un producto</option>
                            @foreach($productos as $producto)
                                <option> {{$producto}} </option>
                            @endforeach                            
                        </select>
                        @error('nombre_producto')
                                <small>*{{$message}}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">FECHA DE INICIO</label>
                        <input id="fecha_inicio" name="fecha_inicio" type="date" class="form-control" tabindex="1" required  oninvalid="this.setCustomValidity('Ingrese la fecha de inicio de la oferta')" oninput="setCustomValidity('')">        
                        @error('fecha_inicio')
                        <small>*{{$message}}</small>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="" class="form-label">FECHA DE FIN</label>
                        <input id="fecha_fin" name="fecha_fin" type="date" class="form-control" tabindex="1"required  oninvalid="this.setCustomValidity('Ingrese la fecha de fin de la oferta')" oninput="setCustomValidity('')">        
                        @error('fecha_fin')
                        <small>*{{$message}}</small>
                        @enderror
                    </div>

                    <label for="" class="form-label">DESCUENTO</label>
                        <input id="descuento" name="descuento" type="text" class="form-control" tabindex="1" required  oninvalid="this.setCustomValidity('Ingrese el descuento de la oferta')" oninput="setCustomValidity('')">        
                        @error('descuento')
                        <small>*{{$message}}</small>
                        @enderror
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" value="Agregar">Agregar</input>
                    </div>
        </form>

@stop

@section('javascript')
    <script src="{{'js/submit_bootstrap.js'}}"></script>
@endsection
