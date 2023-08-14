var tableToldos;
document.addEventListener('DOMContentLoaded',function()
{
    
	tableToldos = $('#tableToldos').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Toldos/getToldos",
            "dataSrc":"",
            "dataSrc":""
        },
        "columns":[
            {"data":"cod_toldo"},
            {"data":"nombre_toldo"},
            {"data":"fecha_montaje"},
            {"data":"fecha_inicio"},
            {"data":"fecha_final"},
            {"data":"status"},
            {"data":"options"}
        
           
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"asc"]]  
    });
    //NUEVO REGISTRO
   var formToldo=document.querySelector("#formToldo");
   formToldo.onsubmit = function(e)
   {
    e.preventDefault();
    var intIdToldo = document.querySelector('#idToldo').value;
    var strNombre = document.querySelector('#txtNombre').value;
    var strFecham = document.querySelector('#txtFecham').value;
    var strFechai = document.querySelector('#txtFechai').value;
    var strFechaf = document.querySelector('#txtFechaf').value;
    var intStatus = document.querySelector('#listStatus').value;
    if(strNombre == '' || strFecham == ''|| intStatus == '')
    {
        swal("Atención", "Nombre y Fecha de montaje obligatorios" , "error");
        return false;
    } 
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Toldos/setToldo'; 
    var formData = new FormData(formToldo);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
       {
        var objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                $('#modalFormToldo').modal("hide");
                formToldo.reset();
                swal("Toldos", objData.msg ,"success");
                tableToldos.api().ajax.reload();
            }else{
                swal("Error", objData.msg , "error");
            }  
       }
       
    }
}

});
function openModal()
{
    document.querySelector('#idToldo').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Toldo";
    document.querySelector("#formToldo").reset();
    $('#modalFormToldo').modal('show');
}
$('#tableToldos').DataTable();


