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
	public $area;
	public $estado;
	private $codigo;
	private $cliente;
	private $vendedor;
	private $importe;
	private $elaboracion;
	private $registro;
	
	/**
	* Constructor de la clase
	*
	* @autor Hugo
	* @access public
	* @param int $id identificador del objeto
	*/
	public function TOrden($id = ''){
		$this->sucursal = new TSucursal;
		$this->area = new TArea;
		$this->estado = new TEstado(1); #Registrada
				
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
		
		$db = TBase::conectaDB();
		$rs = $db->Execute("select * from orden where idArea = ".$id);
		
		foreach($rs->fields as $field => $val){
			switch($field){
				case 'idSucursal': $this->sucursal = new TSucursal($val); break;
				case 'idArea': $this->area = new TArea($val); break;
				case 'idEstado': $this->estado = new TEstado($val); break;
				default: $this->$field = $val;
			}
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
		return $this->nombre;
	}
	
	/**
	* Establece la clave del vendedor
	*
	* @autor Hugo
	* @access public
	* @param string $val Clave
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setVendedor($val = ""){
		$this->vendedor = $val;
		return true;
	}
	
	/**
	* Retorna la clave del vendedor
	*
	* @autor Hugo
	* @access public
	* @return string Texto
	*/
	
	public function getVendedor(){
		return $this->vendedor;
	}
	
	/**
	* Establece el importe
	*
	* @autor Hugo
	* @access public
	* @param float $val importe
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setImporte($val = 0){
		$this->importe = $val;
		return true;
	}
	
	/**
	* Retorna el importe
	*
	* @autor Hugo
	* @access public
	* @return float Importe
	*/
	
	public function getImporte(){
		return $this->importe;
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
		if ($this->area->getId() == '') return false;
		if ($this->estado->getId() == '') return false;
		
		$db = TBase::conectaDB();
		
		if ($this->getId() == ''){
			$rs = $db->Execute("INSERT INTO orden(idSucursal, idArea, idEstado, codigo) VALUES(".$this->sucursal->getId().", ".$this->area->getId().", ".$this->estado->getId().", ".$this->getCodigo().");");
			if (!$rs) return false;
				
			$this->idOrden = $db->Insert_ID();
		}		
		
		if ($this->getId() == '')
			return false;
			
		$rs = $db->Execute("UPDATE orden
			SET
				idEstado = ".$this->estado->getId().",
				cliente = '".$this->getCliente()."',
				vendedor = '".$this->getVendedor()."',
				importe = ".$this->getImporte().",
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