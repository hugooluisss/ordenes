<?php
/**
* TUsuario
* Usuarios del sistema
* @package aplicacion
* @autor Hugo Santiago hugooluisss@gmail.com
**/

class TUsuario{
	private $idUsuario;
	private $idTipo;
	private $nombre;
	private $clave;
	private $pass;
	private $email;
	private $puesto;
	private $area;
	private $codigo;
	public $areas;
	public $sucursales;
	
	/**
	* Constructor de la clase
	*
	* @autor Hugo
	* @access public
	* @param int $id identificador del objeto
	*/
	public function TUsuario($id = ''){
		$this->areas = array();
		$this->sucursales = array();
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
		$rs = $db->Execute("select * from usuario where idUsuario = ".$id);
		
		foreach($rs->fields as $field => $val){
			switch($field){
				default:
					$this->$field = $val;
			}
		}
		
		$this->getAreas();
		$this->getSucursales();
		
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
		return $this->idUsuario;
	}
	
	/**
	* Establece el valor de tipo de usuario
	*
	* @autor Hugo
	* @access public
	* @param string $val Valor a asignar por default es 2 que hace referencia a doctor
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setTipo($val = 2){
		$this->idTipo = $val;
		return true;
	}
	
	/**
	* Retorna las el identificador del tipo de usuario
	*
	* @autor Hugo
	* @access public
	* @return string Texto
	*/
	
	public function getIdTipo(){
		return $this->idTipo;
	}
	
	/**
	* Retorna el tipo
	*
	* @autor Hugo
	* @access public
	* @return string Texto
	*/
	
	public function getTipo(){
		if ($this->getIdTipo() == '') return false;
		
		$db = TBase::conectaDB();
		$rs = $db->Execute("select nombre from tipoUsuario where idTipoUsuario = ".$this->getIdTipo());
		return $rs->fields['nombre'];
	}
	
	/**
	* Establece el nombre
	*
	* @autor Hugo
	* @access public
	* @param string $val Valor a asignar
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setNombre($val = ''){
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
	* Retorna el nombre completo iniciando por nombre
	*
	* @autor Hugo
	* @access public
	* @return string Texto
	*/
	
	public function getNombreCompleto(){
		return $this->getNombre();
	}
	
	/**
	* Establece la clave
	*
	* @autor Hugo
	* @access public
	* @param string $val Valor a asignar
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setClave($val = ''){
		$this->clave = $val;
		return true;
	}
	
	/**
	* Retorna los apellidos
	*
	* @autor Hugo
	* @access public
	* @return string Texto
	*/
	
	public function getClave(){
		return $this->clave;
	}
	
	/**
	* Establece el email
	*
	* @autor Hugo
	* @access public
	* @param string $val Valor a asignar
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setEmail($val = ''){
		$this->email = $val;
		return true;
	}
	
	/**
	* Retorna el email
	*
	* @autor Hugo
	* @access public
	* @return string Texto
	*/
	
	public function getEmail(){
		return $this->email;
	}
	
	/**
	* Establece el valor del password
	*
	* @autor Hugo
	* @access public
	* @param string $val Valor a asignar
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setPass($val = ''){
		$this->pass = $val;
		return true;
	}
	
	/**
	* Retorna el password
	*
	* @autor Hugo
	* @access public
	* @return string Texto
	*/
	
	public function getPass(){
		return $this->pass;
	}
	
	/**
	* Establece el puesto
	*
	* @autor Hugo
	* @access public
	* @param string $val Valor a asignar
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setPuesto($val = ''){
		$this->puesto = $val;
		return true;
	}
	
	/**
	* Retorna el puesto
	*
	* @autor Hugo
	* @access public
	* @return string Texto
	*/
	
	public function getPuesto(){
		return $this->puesto;
	}
	
	/**
	* Establece el código
	*
	* @autor Hugo
	* @access public
	* @param string $val Valor a asignar
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setCodigo($val = ''){
		$this->codigo = $val;
		return true;
	}
	
	/**
	* Retorna el código
	*
	* @autor Hugo
	* @access public
	* @return string Texto
	*/
	
	public function getCodigo(){
		return $this->codigo;
	}
	
	/**
	* Guarda los datos en la base de datos, si no existe un identificador entonces crea el objeto
	*
	* @autor Hugo
	* @access public
	* @return boolean True si se realizó sin problemas
	*/
	
	public function guardar(){
		if ($this->getIdTipo() == '') return false;
		
		$db = TBase::conectaDB();
		
		if ($this->getId() == ''){
			$rs = $db->Execute("INSERT INTO usuario(idTipo) VALUES(".$this->getIdTipo().");");
			if (!$rs) return false;
				
			$this->idUsuario = $db->Insert_ID();
		}		
		
		if ($this->getId() == '')
			return false;
			
		$rs = $db->Execute("UPDATE usuario
			SET
				idTipo = ".$this->getIdTipo().",
				nombre = '".$this->getNombre()."',
				clave = '".$this->getClave()."',
				email = '".$this->getEmail()."',
				pass = '".$this->getPass()."',
				puesto = '".$this->getPuesto()."',
				codigo = '".$this->getCodigo()."'
			WHERE idUsuario = ".$this->getId());
		
		$this->getAreas();
		$this->getSucursales();
		
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
		$rs = $db->Execute("delete from usuario where idUsuario = ".$this->getId());
		
		return $rs?true:false;
	}
	
	/**
	* Agrega una área a la cual tiene acceso el usuario
	*
	* @autor Hugo
	* @access public
	* @return boolean True si se realizó sin problemas
	*/
	
	public function addArea($area = ''){
		if ($this->getId() == '') return false;
		if ($area == '') return false;
		
		$db = TBase::conectaDB();
		$rs = $db->Execute("insert into usuarioarea(idUsuario, idArea) values (".$this->getId().", ".$area.")");
		
		$this->getAreas();
		$this->getSucursales();
		
		return $rs?true:false;
	}
	
	/**
	* Quita una área de la lista a la cual puede tener acceso
	*
	* @autor Hugo
	* @access public
	* @return boolean True si se realizó sin problemas
	*/
	
	public function delArea($area = ''){
		if ($this->getId() == '') return false;
		if ($area == '') return false;
		
		$db = TBase::conectaDB();
		$rs = $db->Execute("delete from usuarioarea where idUsuario = ".$this->getId()." and idArea =  ".$area."");
		
		$this->getAreas();
		$this->getSucursales();
		
		return $rs?true:false;
	}
	
	/**
	* genera la lista de áreas del usuario
	*
	* @autor Hugo
	* @access public
	* @return boolean True si se realizó sin problemas
	*/
	
	public function getAreas(){
		if ($this->getId() == '') return false;
		
		$db = TBase::conectaDB();
		$rs = $db->Execute("select * from usuarioarea where idUsuario = ".$this->getId()."");
		$this->areas = array();
		while(!$rs->EOF){
			$this->areas[$rs->fields['idArea']] = $rs->fields;
			$rs->moveNext();
		}
		
		return true;
	}
	
	/**
	* Agrega una sucursal al usuario
	*
	* @autor Hugo
	* @access public
	* @return boolean True si se realizó sin problemas
	*/
	
	public function addSucursal($sucursal = ''){
		if ($this->getId() == '') return false;
		if ($sucursal == '') return false;
		
		$db = TBase::conectaDB();
		$rs = $db->Execute("insert into usuariosucursal(idUsuario, idSucursal) values (".$this->getId().", ".$sucursal.")");
		
		$this->getSucursales();
		
		return $rs?true:false;
	}
	
	/**
	* Quita una sucursal de la lista a la cual puede tener acceso
	*
	* @autor Hugo
	* @access public
	* @return boolean True si se realizó sin problemas
	*/
	
	public function delSucursal($sucursal = ''){
		if ($this->getId() == '') return false;
		if ($area == '') return false;
		
		$db = TBase::conectaDB();
		$rs = $db->Execute("delete from usuarioarea where idUsuario = ".$this->getId()." and idSucursal =  ".$idSucursal."");
		
		$this->getSucursales();
		
		return $rs?true:false;
	}
	
	/**
	* Genera la lista de sucursales del usuario
	*
	* @autor Hugo
	* @access public
	* @return boolean True si se realizó sin problemas
	*/
	
	public function getSucursales(){
		if ($this->getId() == '') return false;
		
		$db = TBase::conectaDB();
		$rs = $db->Execute("select * from usuariosucursal where idUsuario = ".$this->getId()."");
		$this->sucursales = array();
		while(!$rs->EOF){
			$this->sucursales[$rs->fields['idSucursal']] = $rs->fields;
			$rs->moveNext();
		}
		
		return true;
	}
	
	/**
	* Borrar todas las sucursales
	*
	* @autor Hugo
	* @access public
	* @return boolean True si se realizó sin problemas
	*/
	
	public function delAllSucursales(){
		if ($this->getId() == '') return false;
		
		$db = TBase::conectaDB();
		$rs = $db->Execute("delete from usuariosucursal where idUsuario = ".$this->getId()."");
		$this->sucursales = array();
		
		return true;
	}
}
?>