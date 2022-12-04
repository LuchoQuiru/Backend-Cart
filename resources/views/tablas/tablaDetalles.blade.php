<!-- Este es el codigo de vertically centered modal de bootstrap -->

<!-- Modal -->

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<div class="modal fade" id="modal-Detalles" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div>
            <table id="tablaDetalles" class="table table-striped" style="width:10%">
                <thead class="thead-dark">
                    <tr>
                        <th scope="id_pedido">ID PEDIDO</th>
                        <th scope="id_producto">PRODUCTO</th>
                        <th scope="cantidad">CANTIDAD</th>
                        <th scope="total">TOTAL</th>
                        <th scope="accion">ACCION</th>
                    </tr>
                </thead>
          <TBody>

          </TBody>
            </table>      
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready( function () {
        $('#tablaDetalles').DataTable();
    });

</script>

<script>


  $('#modal-Detalles').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('Detalle del pedido ' + id)
  $.ajax({
                type: "POST",
                url: "{{ url('/tablaDetalles') }}",
                headers: {
                      'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: { id_pedido : id },
                success: function(data){
                    $datos = JSON.parse(data);
                    var table = $('#modal-Detalles').find('.table tbody');
                    var htmldinamico = '';
                    for (var i=0 ; i<$datos.length ; i++)
                        htmldinamico += ('<tr><td>' + $datos[i].id_pedido  + 
                          '</td><td>' + $datos[i].id_producto + '</td><td>' + $datos[i].cantidad + 
                            '</td><td>' + $datos[i].total + '</td><td></td></tr>');
                    table.html(htmldinamico);
                },
                error:function(err){}
            });
})
</script>

