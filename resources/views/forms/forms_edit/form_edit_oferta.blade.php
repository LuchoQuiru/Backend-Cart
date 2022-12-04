@extends('forms.formularioRaiz')
@section('contenido')
        <form action="{{ url('tablaOfertas/update/'.$id_oferta) }}" id="formOferta" method="post" enctype="multipart/form-data">
            @csrf
            </div>
                    <div class="mb-3">
                        <label for="" class="form-label">PRODUCTO</label>
                        <select id="nombre_producto" name="nombre_producto" class="form-control input-lg dynamic" data-dependent="state">
                            <option value="">Seleccione un producto</option>
                            @foreach($productos as $producto)
                                @if($producto == $producto_de_la_oferta)
                                    <option selected="selected"> {{$producto}} </option>
                                @else
                                    <option> {{$producto}} </option>
                                @endif
                            @endforeach                            
                        </select>
                        @error('nombre_producto')
                                <small>*{{$message}}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">FECHA DE INICIO</label>
                        <input id="fecha_inicio" value="{{$fecha_inicio}}" name="fecha_inicio" type="date" class="form-control" tabindex="1">        
                        @error('fecha_inicio')
                        <small>*{{$message}}</small>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="" class="form-label">FECHA DE FIN</label>
                        <input id="fecha_fin" value="{{$fecha_fin}}" name="fecha_fin" type="date" class="form-control" tabindex="1">        
                        @error('fecha_fin')
                        <small>*{{$message}}</small>
                        @enderror
                    </div>

                    <label for="" class="form-label">DESCUENTO</label>
                        <input id="descuento" value="{{$descuento}}" name="descuento" type="text" class="form-control" tabindex="1">        
                        @error('descuento')
                        <small>*{{$message}}</small>
                        @enderror
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" value="Agregar">Agregar</input>
                    </div>
        </form>

@stop

