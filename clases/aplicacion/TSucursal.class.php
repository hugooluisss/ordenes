<?php
/**
* TSucursal
* Sucursales
* @package aplicacion
* @autor Hugo Santiago hugooluisss@gmail.com
**/
class TSucursal{
	private $idSucursal;
	private $nombre;
	private $color;
	public $razonsocial;
	/**
	* Constructor de la clase
	*
	* @autor Hugo
	* @access public
	* @param int $id identificador del objeto
	*/
	public function TSucursal($id = ''){
		$this->razonsocial = new TRazonSocial;
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
		$rs = $db->Execute("select * from sucursal where idSucursal = ".$id);
		
		foreach($rs->fields as $field => $val){
			switch($field){
				case 'idRazon':
					$this->razonsocial = new TRazonSocial($val);
				break;
				default:
					$this->$field = $val;
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
		return $this->idSucursal;
	}
	
	/**
	* Establece el nombre
	*
	* @autor Hugo
	* @access public
	* @param string $val Nombre
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setNombre($val = ""){
		$this->nombre = $val;
		return true;
	}
	
	/**
	* Retorna el nombre
	*
	* @autor Hugo
	* @access public
	* @return string Texto
	*/
	
	public function getNombre(){
		return $this->nombre;
	}
	
	/**
	* Establece el valor del código hexadecimal
	*
	* @autor Hugo
	* @access public
	* @param string $val Código
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setColor($val = '#000000'){
		$this->color = $val;
		return true;
	}
	
	/**
	* Retorna el código hexadecimal del color
	*
	* @autor Hugo
	* @access public
	* @return string Código
	*/
	
	public function getColor(){
		return $this->color;
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
		
		if ($this->getId() == ''){
			$rs = $db->Execute("INSERT INTO sucursal(idRazon) VALUES(".$this->razonsocial->getId().");");
			if (!$rs) return false;
				
			$this->idSucursal = $db->Insert_ID();
		}		
		
		if ($this->getId() == '')
			return false;
			
		$rs = $db->Execute("UPDATE sucursal
			SET
				nombre = '".$this->getNombre()."',
				color = '".$this->getColor()."',
				idRazon = ".$this->razonsocial->getId()."
			WHERE idSucursal = ".$this->getId());
			
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
		$rs = $db->Execute("delete from sucursal where idSucursal = ".$this->getId());
		
		return $rs?true:false;
	}
}
?>