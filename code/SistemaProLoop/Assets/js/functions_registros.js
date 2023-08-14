var tableRegistros;
document.addEventListener('DOMContentLoaded',function()
{
    
	tableRegistros = $('#tableRegistros').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Registros/getRegistros",
            "dataSrc":""
        },
        "columns":[
            {"data":"nombre_mes"},
            {"data":"fecha_reg"},
            {"data":"cod_toldo"},
            {"data":"cantidad"},
            {"data":"status"},
            {"data":"options"}
        
           
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });
    //NUEVO REGISTRO
   var formRegistro=document.querySelector("#formRegistro");
   formRegistro.onsubmit = function(e)
   {
    e.preventDefault();
    var intIdRegistro = document.querySelector('#idRegistro').value;
    var strMes = document.querySelector('#listMesid').value;
    var strFecha = document.querySelector('#txtFecha').value;
    var strToldo = document.querySelector('#listToldoid').value;
    var strHuevos = document.querySelector('#txtHuevos').value;
    var intStatus = document.querySelector('#listStatus').value;
    if(strMes == '' || strFecha == ''|| strToldo == ''|| strHuevos == '' || intStatus == '')
    {
        swal("Atención", "Todos los campos son obligatorios." , "error");
        return false;
    } 
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Registros/setRegistro'; 
        var formData = new FormData(formRegistro);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function()
        
    {
        if(request.readyState == 4 && request.status == 200)
       {
        var objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                $('#modalFormRegistro').modal("hide");
                formRegistro.reset();
                swal("Registros", objData.msg ,"success");
                tableRegistros.api().ajax.reload();
            }else{
                swal("Error", objData.msg , "error");
            }  
       }
       
    }
   }
});
window.addEventListener('load', function() {
    fntMesRegistro();
}, false);

function fntMesRegistro(){
   
        let ajaxUrl = base_url+'/Registros/getSelectMeses';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                document.querySelector('#listMesid').innerHTML = request.responseText;
                $('#listMesid').selectpicker('render');
            }
        }
    }
        window.addEventListener('load', function() {
            fntToldoRegistro();
        }, false);
        
        function fntToldoRegistro(){
   
            let ajaxUrl = base_url+'/Registros/getSelectToldos';
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            request.open("GET",ajaxUrl,true);
            request.send();
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    document.querySelector('#listToldoid').innerHTML = request.responseText;
                    $('#listToldoid').selectpicker('render');
                }
            }

        }

$('#tableRegistros').DataTable();

function openModal()
{
    document.querySelector('#idRegistro').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Registro";
    document.querySelector("#formRegistro").reset();
    $('#modalFormRegistro').modal('show');
}
window.addEventListener('load', function() {
        fntEditRegistro();
},false);
function fntEditRegistro()
{
    var btnEditRegistro= document.querySelectorAll(".btnEditRegistro");
    btnEditRegistro.forEach(function(btnEditRegistro){
        btnEditRegistro.addEventListener('click',function(){
            document.querySelector('#titleModal').innerHTML ="Actualizar Registro";
            document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
            document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
            document.querySelector('#btnText').innerHTML ="Actualizar";

            var idregistro = this.getAttribute("rl");
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl  = base_url+'/Registros/getRegistro/'+idregistro;
            request.open("GET",ajaxUrl ,true);
            request.send();
            request.onreadystatechange=function()
            {
                if(request.readyState == 4 && request.status == 200)
                {
                    console.log(request.responseText);
                }
            }
                $('#modalFormRegistro').modal('show')
        });

    });
}
