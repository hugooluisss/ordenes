<?php
/**
* TOrden
* Orden de servicio
* @package aplicacion
* @autor Hugo Santiago hugooluisss@gmail.com
**/
class TOrden{
	private $idOrden;
	public $sucursal;
	public $estado;
	public $vendedor;
	private $codigo;
	private $cliente;
	private $elaboracion;
	private $registro;
	public $movimientos;
	
	/**
	* Constructor de la clase
	*
	* @autor Hugo
	* @access public
	* @param int $id identificador del objeto
	*/
	public function TOrden($id = ''){
		$this->sucursal = new TSucursal;
		$this->estado = new TEstado(1); #Registrada
		$this->vendedor = new TVendedor;
		$this->movimientos = array();
				
		$this->setId($id);	
		return true;
	}
	
	/**
	* Carga los datos del objeto
	*
	* @autor Hugo
	* @access public
	* @param int $id identificador del objeto
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setId($id = ''){
		if ($id == '') return false;
		$this->movimientos = array();
		
		$db = TBase::conectaDB();
		$rs = $db->Execute("select * from orden where idOrden = ".$id);
		
		foreach($rs->fields as $field => $val){
			switch($field){
				case 'idSucursal': $this->sucursal = new TSucursal($val); break;
				case 'idEstado': $this->estado = new TEstado($val); break;
				case 'idVendedor': $this->vendedor = new TVendedor($val); break;
				default: $this->$field = $val;
			}
		}
		
		$this->setMovimientos();
		
		return true;
	}
	
	/**
	* Establece los movimientos en la orden
	*
	* @autor Hugo
	* @access public
	* @return integer identificador
	*/
	
	public function setMovimientos(){
		if ($this->getId() == '') return false;
		
		$this->movimientos = array();
		$db = TBase::conectaDB();
		$rs = $db->Execute("select idOrden, clave from movimiento where idOrden = ".$this->getId());
		
		while(!$rs->EOF){
			array_push($this->movimientos, new TMovimiento($this->getId(), $rs->fields['clave']));
			$rs->moveNext();
		}
		
		return true;
	}
	
	/**
	* Retorna el identificador del objeto
	*
	* @autor Hugo
	* @access public
	* @return integer identificador
	*/
	
	public function getId(){
		return $this->idOrden;
	}
	
	/**
	* Establece la clave
	*
	* @autor Hugo
	* @access public
	* @param string $val Nombre
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setCodigo($val = ""){
		$this->codigo = $val;
		return true;
	}
	
	/**
	* Retorna la clave
	*
	* @autor Hugo
	* @access public
	* @return string Texto
	*/
	
	public function getCodigo(){
		return $this->codigo;
	}
	
	/**
	* Establece el nombre del cliente
	*
	* @autor Hugo
	* @access public
	* @param string $val Nombre
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setCliente($val = ""){
		$this->cliente = $val;
		return true;
	}
	
	/**
	* Retorna el nombre del cliente
	*
	* @autor Hugo
	* @access public
	* @return string Texto
	*/
	
	public function getCliente(){
		return $this->cliente;
	}
	
	/**
	* Establece la fecha de elaboración
	*
	* @autor Hugo
	* @access public
	* @param string $val fecha
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setElaboracion($val = ""){
		$this->elaboracion = $val == ''?date('Y-m-d'):$val;
		return true;
	}
	
	/**
	* Retorna la fecha de elaboracion
	*
	* @autor Hugo
	* @access public
	* @return date fecha de elaboracion
	*/
	
	public function getElaboracion(){
		return $this->elaboracion;
	}
	
	/**
	* Retorna la fecha de registro de la orden en el sistema
	*
	* @autor Hugo
	* @access public
	* @return date fecha de elaboracion
	*/
	
	public function getRegistro(){
		return $this->registro;
	}
	
	/**
	* Guarda los datos en la base de datos
	*
	* @autor Hugo
	* @access public
	* @return boolean True si se realizó sin problemas
	*/
	
	public function guardar(){
		if ($this->sucursal->getId() == '') return false;
		if ($this->estado->getId() == '') return false;
		
		$db = TBase::conectaDB();
		
		if ($this->getId() == ''){
			$rs = $db->Execute("INSERT INTO orden(idSucursal, idEstado, idVendedor, codigo) VALUES(".$this->sucursal->getId().", ".$this->estado->getId().", ".$this->vendedor->getId().",".$this->getCodigo().");");
			if (!$rs) return false;
				
			$this->idOrden = $db->Insert_ID();
		}		
		
		if ($this->getId() == '')
			return false;
			
		$rs = $db->Execute("UPDATE orden
			SET
				idEstado = ".$this->estado->getId().",
				cliente = '".$this->getCliente()."',
				elaboracion = '".$this->getElaboracion()."',
				registro = now()
			WHERE idOrden = ".$this->getId());
			
		return $rs?true:false;
	}
	
	/**
	* Elimina el objeto de la base de datos
	*
	* @autor Hugo
	* @access public
	* @return boolean True si se realizó sin problemas
	*/
	
	public function eliminar(){
		if ($this->getId() == '') return false;
		
		$db = TBase::conectaDB();
		$rs = $db->Execute("delete from orden where idOrden = ".$this->getId());
		
		return $rs?true:false;
	}
}
?>