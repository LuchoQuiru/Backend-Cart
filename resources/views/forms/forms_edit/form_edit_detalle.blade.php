<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

            <!-- Modal -->
            
                <div class="modal fade" id="modal_detalle_pedido_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">SELECCION DE PRODUCTO</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    
                        <form onsubmit="return validateForm()" action="{{ url('tablaPedidos/agregarProductoAlPedidoEdit/'.$id_pedido) }}" 
                                            name="formDetalle" id="formDetalle" method="post" enctype="multipart/form-data">    
                        <div class="mb-3">
                                @csrf
                                <label for="" class="form-label">PRODUCTO</label>
                                <select id="nombre_producto" name="nombre_producto" class="form-control input-lg dynamic" data-dependent="state">
                                    <option value="">Seleccione un producto</option>
                                    @foreach($productos as $producto)
                                        <option> {{ $producto }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="" class="form-label">CANTIDAD</label>
                                <input id="cantidad" name="cantidad" type="number" class="form-control" tabindex="1"></input>        
                            </div>

                            <button type="submit" id="bt_form" class="btn btn-primary">Agregar</button>
                        </form>
                    
                            </div>
                            <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        
                    </div>
                    </div>
                </div>
                </div>

               
<script>
    function validateForm() {
    var x = document.forms["formDetalle"]["cantidad"].value;
    var y = document.forms["formDetalle"]["nombre_producto"].value;
    if (x == "" || y=="") {
        alert("Complete todos los campos");
        return false;
    }
    }
</script>
