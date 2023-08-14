<?php 

	class Toldos extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
			}
			getPermisos(4);
		}

		public function Toldos()
		{
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Toldos";
			$data['page_title'] = "Toldos <small>Sistema Gestion Pro-Loop</small>";
			$data['page_name'] = "toldos";
			$data['page_functions_js'] = "functions_toldos.js";
			$this->views->getView($this,"toldos",$data);
		}
        public function getToldos()
        {
          $arrData= $this->model->selectToldos();
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
            <button class="btn btn-secondary btn-sm btnPermisosRol" onClick="fntPermisos('.$arrData[$i]['id_toldo'].')" title="Permisos"><i class="fas fa-key"></i></button>
            <button class="btn btn-primary btn-sm btnEditToldo" onClick="fntEditRegistro('.$arrData[$i]['id_toldo'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>
            <button class="btn btn-danger btn-sm btnDelRol" onClick="fntDelRegistro('.$arrData[$i]['id_toldo'].')" title="Eliminar"><i class="far fa-trash-alt"></i></button>
            </div>';
		}         
                
          echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
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
        
        public function setToldo()
		{
			if($_POST){			
				if(empty($_POST['txtNombre']) || empty($_POST['txtFecham']) || 
				empty($_POST['txtFechai']) || empty($_POST['txtFechaf'])|| 
				empty($_POST['listStatus']))
				{
					$arrResponse= array('status' => false, 'msg' => 'Datos Incorrectos');
				}else
				{
					$intIdToldo = intval($_POST['idToldo']);
				    $strNombre =  strClean($_POST['txtNombre']);
				    $strFecham =  strClean($_POST['txtFecham']);
				    $strFechai =  strClean($_POST['txtFechai']);
				    $strFechaf =  strClean($_POST['txtFechaf']);
				    $intStatus = intval($_POST['listStatus']);
					$request_toldo = $this->model->insertToldo($strNombre,$strFecham,$strFechai,$strFechaf,$intStatus);
					if($request_toldo == 'exist')			        
					{
						$arrResponse= array('status' => false, 'msg' => 'Este nombre toldo esta activo');
						
					}else if($request_toldo > 0)
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