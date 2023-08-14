<?php
	class ToldosModel extends Mysql
	{
		public $intidtoldo;
		public $strNombre;
		public $strCodigo;
		public $strFecham;
		public $strFechai;
		public $strFechaf;
		public $intStatus;
		
		public function __construct()
		{
			parent::__construct();
		}	
        public function selectToldos()
		{
			
			$sql="SELECT *FROM toldo WHERE status !=0";
			$request=$this->select_all($sql);
			return $request;
		}
		public function selectRegistro(int $idtoldo)
		{
			//BUSCAR Toldo
			$this->intidtoldo = $idtoldo;
			$sql = "SELECT * FROM registro WHERE id_reg = $this->intidtoldo";
			$request = $this->select($sql);
			return $request;
		}
		public function insertToldo(string $nombre,string $fecham,string $fechai,string $fechaf,int $status)
		{
			
			$this->strNombre = $nombre;
			$this->strCodigo = 'TD'.$this->strNombre;
			$this->strFecham = $fecham;
			$this->strFechai = $fechai;
			$this->strFechaf = $fechaf;
			$this->intStatus = $status;
			$return = 0;
			$sql = "SELECT * FROM toldo WHERE  nombre_toldo= '{$this->strNombre}' AND fecha_montaje='{$this->strFecham}' AND status = 1 ";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$query_insert  = "INSERT INTO toldo (nombre_toldo,cod_toldo,fecha_montaje, fecha_inicio, fecha_final, status) VALUES(?,?, ?, ?, ?, ?)";
	        	$arrData = array($this->strNombre,$this->strCodigo, $this->strFecham, $this->strFechai, $this->strFechaf, $this->intStatus);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
				
				
			}else{
				$return ='exist';
			}
			return $return;

		}
				
      }
    ?>