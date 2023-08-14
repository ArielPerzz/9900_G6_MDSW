<?php 

	class Registros extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
			}
			getPermisos(3);
		}

		public function Registros()
		{
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Registros";
			$data['page_title'] = "Registros <small>Sistema Gestion Pro-Loop</small>";
			$data['page_name'] = "registros";
			$data['page_functions_js'] = "functions_registros.js";
			$this->views->getView($this,"registros",$data);
		}
        public function getRegistros()
        {
          $arrData= $this->model->selectRegistros(); 
          for($i=0; $i < count($arrData);$i++)
          {
            if($arrData[$i]['status']==1)
            {
                $arrData[$i]['status']='<span class="badge badge-success">Activo</span>';
            }else
            {
                $arrData[$i]['status']='<span class="badge badge-danger">Inactivo</span>';
            }
            
            $arrData[$i]['options']= 
        '<div class="text-center">
            <button class="btn btn-secondary btn-sm btnPermisosRol" onClick="fntPermisos('.$arrData[$i]['id_reg'].')" title="Permisos"><i class="fas fa-key"></i></button>
            <button class="btn btn-primary btn-sm btnEditRegistro" onClick="fntEditRegistro('.$arrData[$i]['id_reg'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>
            <button class="btn btn-danger btn-sm btnDelRol" onClick="fntDelRegistro('.$arrData[$i]['id_reg'].')" title="Eliminar"><i class="far fa-trash-alt"></i></button>
            </div>';
          }         
                  
          echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
          die();
        }
		public function getSelectMeses()
		{
			$htmlOptions = "";
			$arrData = $this->model->selectMeses();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					if($arrData[$i]['id_mes'] != 0 ){
					$htmlOptions .= '<option value="'.$arrData[$i]['id_mes'].'">'.$arrData[$i]['nombre_mes'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();		
		}
		public function getSelectToldos()
		{
			$htmlOptions = "";
			$arrData = $this->model->selectToldos();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					if($arrData[$i]['status'] == 1 ){
					$htmlOptions .= '<option value="'.$arrData[$i]['id_toldo'].'">'.$arrData[$i]['nombre_toldo'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();		
		}




		public function getRegistro($idregistro)
		{
			if($_SESSION['permisosMod']['r']){
				$intIdregistro = intval(strClean($idregistro));
				if($intIdregistro > 0)
				{
					$arrData = $this->model->selectRegistro($intIdregistro);
					if(empty($arrData))
					{
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}
		public function setRegistro()
		{
			if($_POST){			
				if(empty($_POST['listMesid']) || empty($_POST['txtFecha']) || 
				empty($_POST['listToldoid']) || empty($_POST['txtHuevos'])|| 
				empty($_POST['listStatus']))
				{
					$arrResponse= array('status' => false, 'msg' => 'Datos Incorrectos');
				}else
				{
					$intIdregistro = intval($_POST['idRegistro']);
					$strMes =  strClean($_POST['listMesid']);
					$strFecha =  strClean($_POST['txtFecha']);
					$strToldo =  strClean($_POST['listToldoid']);
					$strHuevos = strClean($_POST['txtHuevos']);
					$intStatus = intval($_POST['listStatus']);
					$request_registro = $this->model->insertRegistro($strMes,$strFecha,$strToldo,$strHuevos,$intStatus);
					if($request_registro == 'exist')			        
					{
						$arrResponse= array('status' => false, 'msg' => 'Este registro ya existe en este Mes.');
						
					}else if($request_registro > 0)
					{
						$arrResponse= array('status' => true, 'msg' => 'Datos guardados Correctamente.');
					}else
					{
						$arrResponse= array('status' => false , 'msg' => 'No es posible almacenar los datos.');
					}					
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();


			    
				
		}
        
    }
?>