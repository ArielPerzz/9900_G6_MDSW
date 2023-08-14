<!-- Modal -->
<div class="modal fade" id="modalFormToldo" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Toldo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="formToldo" name="formToldo" class="form-vertical">
              <input type="hidden" id="idToldo" name="idToldo" value="">           
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="txtNombre">Nombre Toldo</label>
                  <input type="text"  class="form-control" id="txtNombre" name="txtNombre" >
                </div>                
              </div>
              <div class="form-row">
              <div class="form-group col-md-3">
                  <label for="txtFecham">Fecha de Montaje</label>
                  <input type="date" class="form-control" id="txtFecham" name="txtFecham" >
                </div> 
                <div class="form-group col-md-3">
                  <label for="txtFechai">Fecha de Inicio</label>
                  <input type="date" class="form-control" id="txtFechai" name="txtFechai" >
                </div>   
                <div class="form-group col-md-3">
                  <label for="txtFechaf">Fecha de Finalización</label>
                  <input type="date" class="form-control" id="txtFechaf" name="txtFechaf" >
                </div> 
                <div class="form-group col-md-3">
                    <label for="listStatus">Status</label>
                    <select class="form-control selectpicker" id="listStatus" name="listStatus" required >
                        <option value="1">Activo</option>
                        <option value="2">Inactivo</option>
                    </select>
                </div>              
              </div>                   
             <div class="form-row">
                      
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


