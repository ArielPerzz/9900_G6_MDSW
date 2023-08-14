<?php

	class RegistrosModel extends Mysql
	{
		public $intidregistro;
		public $strMes;
		public $strFecha;
		public $strToldo;
		public $strHuevos;
		public $intStatus;
		
		public function __construct()
		{
			parent::__construct();
		}	
        public function selectRegistros()
		{
			$sql="SELECT r.id_reg, m.nombre_mes, r.fecha_reg, t.cod_toldo, r.cantidad, r.status FROM registro r 
			INNER JOIN mes m ON r.mesid = m.id_mes 
			INNER JOIN toldo t 
			ON r.toldoid = t.id_toldo 
			WHERE r.status != 0";
			$request=$this->select_all($sql);
			return $request;
		}
		public function selectMeses()
		{
			$sql="SELECT *FROM mes WHERE id_mes !=0";
			$request=$this->select_all($sql);
			return $request;
		}	
		public function selectToldos()
		{
			$sql="SELECT *FROM toldo WHERE id_toldo !=0";
			$request=$this->select_all($sql);
			return $request;
		}	

		public function selectRegistro(int $idregistro)
		{
			//BUSCAR ROLE
			$this->intidregistro = $idregistro;
			$sql = "SELECT * FROM registro WHERE id_reg = $this->intidregistro";
			$request = $this->select($sql);
			return $request;
		}
		public function insertRegistro(string $mes,string $fecha,string $toldo,string $huevos,int $status)
		{
			$resp = "";
			$this->strMes = $mes;
			$this->strFecha = $fecha;
			$this->strToldo = $toldo;
			$this->strHuevos = $huevos;
			$this->intStatus = $status;
			$sql = "SELECT * FROM registro WHERE mesid = '{$this->strMes}' AND toldoid = '{$this->strToldo}' AND fecha_reg = '{$this->strFecha}'  ";
			$resp = $this->select_all($sql);
			if(empty($resp))
			{
				$query_insert  = "INSERT INTO registro(mesid, fecha_reg, toldoid, cantidad, status) VALUES(?, ?, ?, ?, ?)";
	        	$arrData = array($this->strMes, $this->strFecha, $this->strToldo, $this->strHuevos, $this->intStatus);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$resp = $request_insert;
				
				
			}else{
				$resp ='exist';
			}
			return $resp;

		}
				
      }
    ?>