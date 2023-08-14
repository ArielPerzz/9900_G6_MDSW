<!-- Modal -->
<div class="modal fade" id="modalFormRegistro" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" >
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="formRegistro" name="formRegistro" class="form-vertical">
              <input type="hidden" id="idRegistro" name="idRegistro" value="">
              <p class="text-primary">Todos los campos son obligatorios.</p>             
              <div class="form-row">
              <div class="form-group col-md-6">
                    <label for="listMesid">Mes</label>
                    <select class="form-control" data-live-search="true" id="listMesid" name="listMesid" required >
                    </select>
                </div>
                <div class="form-group col-md-5">
                  <label for="txtFecha">Fecha</label>
                  <input type="date" class="form-control" id="txtFecha" name="txtFecha" >
                </div>
                <hr>
              </div>
              <div class="form-row">
                
              <div class="form-group col-md-6">
                    <label for="listToldoid">Toldo</label>
                    <select class="form-control" data-live-search="true" id="listToldoid" name="listToldoid" required >
                    </select>
                </div>
                <div class="form-group col-md-5">
                  <label for="txtHuevos">Cantidad de Huevos (g)</label>
                  <input type="text" class="form-control" id="txtHuevos" name="txtHuevos" step="any" >
                </div>
               
              </div>
              <div class="form-row">
                 <div class="form-group col-md-4">
                    <label for="listStatus">Status</label>
                    <select class="form-control selectpicker" id="listStatus" name="listStatus" required >
                        <option value="1">Activo</option>
                        <option value="2">Inactivo</option>
                    </select>
                </div>
              
               
             </div>
            
              <div class="tile-footer">
                <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
              </div>
            </form>
      </div>
    </div>
  </div>
</div>


