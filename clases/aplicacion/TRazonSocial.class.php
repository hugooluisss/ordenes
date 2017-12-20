<?php
/**
* TRazonSocial
* Razón social
* @package aplicacion
* @autor Hugo Santiago hugooluisss@gmail.com
**/
class TRazonSocial{
	private $idRazon;
	private $clave;
	private $consecutivo;
	private $numero;
	
	/**
	* Constructor de la clase
	*
	* @autor Hugo
	* @access public
	* @param int $id identificador del objeto
	*/
	public function TRazonSocial($id = ''){
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
		$rs = $db->Execute("select * from razonsocial where idRazon = ".$id);
		
		foreach($rs->fields as $field => $val)
			$this->$field = $val;
		
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
		return $this->idRazon;
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
	* Establece el consecutivo
	*
	* @autor Hugo
	* @access public
	* @param int $val valor
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setNombre($val = 0){
		$this->consecutivo = $val;
		return true;
	}
	
	/**
	* Retorna el consecutivo
	*
	* @autor Hugo
	* @access public
	* @return integer Valor
	*/
	
	public function getConsecutivo(){
		return $this->consecutivo == ''?0:$this->consecutivo;
	}
	
	/**
	* Establece el número
	*
	* @autor Hugo
	* @access public
	* @param int $val valor
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setNumero($val = ""){
		$this->numero = $val;
		return true;
	}
	
	/**
	* Retorna el número
	*
	* @autor Hugo
	* @access public
	* @return integer Valor
	*/
	
	public function getNumero(){
		return $this->numero;
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
			$rs = $db->Execute("INSERT INTO razonsocial(clave) VALUES('".$this->getClave()."');");
			if (!$rs) return false;
				
			$this->idRazon = $db->Insert_ID();
		}		
		
		if ($this->getId() == '')
			return false;
			
		$rs = $db->Execute("UPDATE razonsocial
			SET
				clave = '".$this->getClave()."',
				consecutivo = '".$this->getConsecutivo()."',
				numero = '".$this->getNumero()."' ".
				#"automatico = ".($this->isAutomatico() == true?1:0)."
			"WHERE idRazon = ".$this->getId());
			
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
		$rs = $db->Execute("delete from razonsocial where idRazon = ".$this->getId());
		
		return $rs?true:false;
	}
	
	/**
	* Registra una carga
	*
	* @autor Hugo
	* @access public
	* @return boolean True si se realizó sin problemas
	*/
	
	public function addCarga($inicio = 0, $fin = 0){
		if ($this->getId() == '') return false;
		$db = TBase::conectaDB();
		
		$rs = $db->Execute("INSERT INTO carga(idRazon, inicio, fin, momento) VALUES(".$this->getId().", ".$inicio.", ".$fin.", now());");
		if ($this->consecutivo < $fin)
			$this->consecutivo = $fin;
		
		$this->guardar();
		
		return $rs?true:false;
	}
	
	/**
	* Retorna los datos de la ultima carga
	*
	* @autor Hugo
	* @access public
	* @return integer Valor
	*/
	
	public function getUltimaCarga(){
		if ($this->getId() == '') return false;
		$db = TBase::conectaDB();
		
		$rs = $db->Execute("select * from carga where idRazon = ".$this->getId()." order by momento desc");
		
		return $rs->fields;
	}
	
	/**
	* Indica si permite la actualización automática
	*
	* @autor Hugo
	* @access public
	* @return integer Valor
	*/
	
	public function isAutomatico(){
		if ($this->getId() == '') return false;
		return $this->automatico == true;
	}
	
	/**
	* Establece si se actualiza automáticamente
	*
	* @autor Hugo
	* @access public
	* @return integer Valor
	*/
	
	public function setAutomatico($val){
		if ($this->getId() == '') return false;
		$this->automatico = $val;
	}
}
?>