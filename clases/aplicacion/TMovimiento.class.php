<?php
/**
* TMovimiento
* Artículos de las ordenes
* @package aplicacion
* @autor Hugo Santiago hugooluisss@gmail.com
**/
class TMovimiento{
	private $idOrden;
	public $area;
	private $cantidad;
	private $clave;
	private $descripcion;
	private $observaciones;
	private $importe;
	private $fecha;
	
	/**
	* Constructor de la clase
	*
	* @autor Hugo
	* @access public
	* @param int $id identificador del objeto
	*/
	public function TMovimiento($id = '', $clave = ''){
		$this->area = new TArea;
		$this->setId($id, $clave);	
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
	
	public function setId($orden = '', $clave = ''){
		if ($orden == '') return false;
		if ($clave == '') return false;
		
		$db = TBase::conectaDB();
		$rs = $db->Execute("select * from movimiento where idOrden = ".$orden." and clave = '".$clave."'");
		
		foreach($rs->fields as $field => $val){
			switch($field){
				case 'idArea': 
					$this->area = new TArea($val);
				break;
				default:
					$this->$field = $val;
			}
		}
		
		return true;
	}
	
	/**
	* Establece la orden
	*
	* @autor Hugo
	* @access public
	* @param string $val Nombre
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setOrden($val = ""){
		$this->idOrden = $val;
		return true;
	}
	
	/**
	* Retorna el identificador de la orden
	*
	* @autor Hugo
	* @access public
	* @return integer Identificador
	*/
	
	public function getOrden(){
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
	
	public function setClave($val = ""){
		$this->clave = $val;
		return true;
	}
	
	/**
	* Retorna la clave
	*
	* @autor Hugo
	* @access public
	* @return string Texto
	*/
	
	public function getClave(){
		return $this->clave;
	}
	
	/**
	* Establece la descripcion
	*
	* @autor Hugo
	* @access public
	* @param string $val Nombre
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setDescripcion($val = ""){
		$this->descripcion = $val;
		return true;
	}
	
	/**
	* Retorna la descripcion
	*
	* @autor Hugo
	* @access public
	* @return string Texto
	*/
	
	public function getDescripcion(){
		return $this->descripcion;
	}
	
	/**
	* Establece las observaciones
	*
	* @autor Hugo
	* @access public
	* @param string $val Nombre
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setObservaciones($val = ""){
		$this->observaciones = $val;
		return true;
	}
	
	/**
	* Retorna las observaciones
	*
	* @autor Hugo
	* @access public
	* @return string Texto
	*/
	
	public function getObservaciones(){
		return $this->observaciones;
	}
	
	/**
	* Establece la cantidad
	*
	* @autor Hugo
	* @access public
	* @param float $val Cantidad
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setCantidad($val = 0){
		$this->cantidad = $val;
		return true;
	}
	
	/**
	* Retorna la cantidad
	*
	* @autor Hugo
	* @access public
	* @return float cantidad
	*/
	
	public function getCantidad(){
		return $this->cantidad == ''?0:$this->cantidad;
	}
	
	/**
	* Establece el importe
	*
	* @autor Hugo
	* @access public
	* @param float $val Importe
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
	* @return float importe
	*/
	
	public function getImporte(){
		return $this->importe == ''?0:$this->importe;
	}
	
	/**
	* Retorna la fecha de inserción en la BD
	*
	* @autor Hugo
	* @access public
	* @return date Fecha
	*/
	
	public function getFecha(){
		return $this->fecha == ''?date("Y-m-d H:i:s"):$this->fecha;
	}
	
	/**
	* Guarda los datos en la base de datos
	*
	* @autor Hugo
	* @access public
	* @return boolean True si se realizó sin problemas
	*/
	
	public function guardar(){
		$db = TBase::conectaDB();
		
		$rs = $db->Execute("INSERT INTO movimiento(idOrden, idArea, clave, descripcion, cantidad, observaciones, importe, fecha) VALUES(".$this->getOrden().", ".$this->area->getId().", '".$this->getClave()."', '".$this->getDescripcion()."', ".$this->getCantidad().", '".$this->getObservaciones()."', ".$this->getImporte().", now());");
		
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
		$rs = $db->Execute("delete from movimiento where idOrden = ".$this->getOrden()." and clave = '".$this->getClave()."'");
		
		return $rs?true:false;
	}
}
?>