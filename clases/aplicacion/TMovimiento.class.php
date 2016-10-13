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
	######
	private $notasucursales;
	private $impresiondigital;
	private $disenador;
	private $fechaimpresion;
	private $notasproduccion;
	private $claveimpresor;
	private $nombreimpresor;
	private $fechaenvio;
	private $horaenvio;
	private $envio;
	private $fecharecepcion;
	private $entregacliente;
	private $notas;
	
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
	* Establece las notas de sucursales
	*
	* @autor Hugo
	* @access public
	* @param string $val Valor
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setNotasSucursales($val = ''){
		$this->notasucursales = $val;
		return true;
	}
	
	/**
	* Retorna lcas notas en sucursales
	*
	* @autor Hugo
	* @access public
	* @return string notas
	*/
	
	public function getNotasSucursales(){
		return $this->notasucursales;
	}
	
	/**
	* Establece la impresión digital
	*
	* @autor Hugo
	* @access public
	* @param string $val Valor
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setImpresionDigital($val = ''){
		$this->impresiondigital = $val;
		return true;
	}
	
	/**
	* Retorna el dato de impresiondigital
	*
	* @autor Hugo
	* @access public
	* @return string Dato
	*/
	
	public function getImpresionDigital(){
		return $this->impresiondigital;
	}
	
	/**
	* Establece el nombre del diseñador
	*
	* @autor Hugo
	* @access public
	* @param string $val Valor
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setDisenador($val = ''){
		$this->disenador = $val;
		return true;
	}
	
	/**
	* Retorna el nombre del diseñador
	*
	* @autor Hugo
	* @access public
	* @return string Dato
	*/
	
	public function getDisenador(){
		return $this->disenador;
	}
	
	/**
	* Establece la fecha de impresión
	*
	* @autor Hugo
	* @access public
	* @param string $val Valor
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setFechaImpresion($val = ''){
		$this->fechaimpresion = $val;
		return true;
	}
	
	/**
	* Retorna la fecha de impresion
	*
	* @autor Hugo
	* @access public
	* @return string Dato
	*/
	
	public function getFechaImpresion(){
		return $this->fechaimpresion;
	}
	
	/**
	* Establece las notas de produccion
	*
	* @autor Hugo
	* @access public
	* @param string $val Valor
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setNotasProduccion($val = ''){
		$this->notasproduccion = $val;
		return true;
	}
	
	/**
	* Retorna las notas de produccion
	*
	* @autor Hugo
	* @access public
	* @return string Dato
	*/
	
	public function getNotasProduccion(){
		return $this->notasproduccion;
	}
	
	/**
	* Establece la clave de impresor
	*
	* @autor Hugo
	* @access public
	* @param string $val Valor
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setClaveImpresor($val = ''){
		$this->claveimpresor = $val;
		return true;
	}
	
	/**
	* Retorna la clave del impresor digital
	*
	* @autor Hugo
	* @access public
	* @return string Dato
	*/
	
	public function getClaveImpresor(){
		return $this->claveimpresor;
	}
	
	/**
	* Establece la impresión digital
	*
	* @autor Hugo
	* @access public
	* @param string $val Valor
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setNombreImpresor($val = ''){
		$this->nombreimpresor = $val;
		return true;
	}
	
	/**
	* Retorna del impresor
	*
	* @autor Hugo
	* @access public
	* @return string Dato
	*/
	
	public function getNombreImpresor(){
		return $this->nombreimpresor;
	}
	
	/**
	* Establece la fecha de envio
	*
	* @autor Hugo
	* @access public
	* @param string $val Valor
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setFechaEnvio($val = ''){
		$this->fechaenvio = $val;
		return true;
	}
	
	/**
	* Retorna la fecha de envio
	*
	* @autor Hugo
	* @access public
	* @return string Dato
	*/
	
	public function getFechaEnvio(){
		return $this->fechaenvio;
	}
	
	/**
	* Establece la hora de envio
	*
	* @autor Hugo
	* @access public
	* @param string $val Valor
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setHoraEnvio($val = ''){
		$this->horaenvio = $val;
		return true;
	}
	
	/**
	* Retorna la hora de envio
	*
	* @autor Hugo
	* @access public
	* @return string Dato
	*/
	
	public function getHoraEnvio(){
		return $this->horaenvio;
	}
	
	/**
	* Establece si se envio o no
	*
	* @autor Hugo
	* @access public
	* @param string $val Valor
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setEnvio($val = ''){
		$this->envio = $val;
		return true;
	}
	
	/**
	* Retorna la hora de envio
	*
	* @autor Hugo
	* @access public
	* @return string Dato
	*/
	
	public function getEnvio(){
		return $this->envio;
	}
	
	/**
	* Establece la fecha de recepcion
	*
	* @autor Hugo
	* @access public
	* @param string $val Valor
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setFechaRecepcion($val = ''){
		$this->fecharecepcion = $val;
		return true;
	}
	
	/**
	* Retorna la fecha de recepcion
	*
	* @autor Hugo
	* @access public
	* @return string Dato
	*/
	
	public function getFechaRecepcion(){
		return $this->fecharecepcion;
	}
	
	/**
	* Establece si se entregó al cliente
	*
	* @autor Hugo
	* @access public
	* @param string $val Valor
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setEntregaCliente($val = ''){
		$this->entregacliente = $val;
		return true;
	}
	
	/**
	* Retorna si se entrego o no al cliente
	*
	* @autor Hugo
	* @access public
	* @return string Dato
	*/
	
	public function getEntregaCliente(){
		return $this->entregacliente;
	}
	
	/**
	* Establece las notas
	*
	* @autor Hugo
	* @access public
	* @param string $val Valor
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setNotas($val = ''){
		$this->notas = $val;
		return true;
	}
	
	/**
	* Retorna las notas
	*
	* @autor Hugo
	* @access public
	* @return string Dato
	*/
	
	public function getNotas(){
		return $this->notas;
	}
	
	/**
	* Retorna la fecha del último archivo subido para este movimiento
	*
	* @autor Hugo
	* @access public
	* @return mixed Date y si no existe retorna ''
	*/
	
	public function getFechaArchivo(){
		$carpeta = "repositorio/ordenes/orden_".$this->getOrden()."/movimiento_".$this->getClave()."/";
		$fecha = '';
		
		foreach(scandir($carpeta) as $file){
			if (!in_array($file, array(".", "..", ".DS_Store"))){
				$hora = filemtime($carpeta.$file);
				
				$fecha = $fecha == ''?$hora:$fecha;
				
				if ($fecha < $hora)
					$fecha = $hora;
			}
		}
		
		return date("Y-m-d H:i:s", $fecha);
	}
	
	/**
	* Retorna la ruta del último archivo subido para este movimiento
	*
	* @autor Hugo
	* @access public
	* @return mixed Date y si no existe retorna ''
	*/
	
	public function getRutaArchivoUltimo($completa = true){
		$carpeta = "repositorio/ordenes/orden_".$this->getOrden()."/movimiento_".$this->getClave()."/";
		$fecha = '';
		$archivo = '';
		
		foreach(scandir($carpeta) as $file){
			if (!in_array($file, array(".", "..", ".DS_Store"))){
				$hora = filemtime($carpeta.$file);
				
				$fecha = $fecha == ''?$hora:$fecha;
				$archivo = $archivo == ''?$file:$archivo;
				if ($fecha < $hora){
					$fecha = $hora;
					$archivo = $file;
				}
			}
		}
		
		return ($completa?$carpeta:"").$archivo;
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
		$rs = $db->Execute("select idOrden from movimiento where idOrden = ".$this->getOrden()." and clave = '".$this->getClave()."'");
		if ($rs->EOF){
			$rs = $db->Execute("INSERT INTO movimiento(idOrden, idArea, clave, descripcion, cantidad, observaciones, importe, fecha) VALUES(".$this->getOrden().", ".$this->area->getId().", '".$this->getClave()."', '".$this->getDescripcion()."', ".$this->getCantidad().", '".$this->getObservaciones()."', ".$this->getImporte().", now());");
		}else
			$rs = $db->Execute("update movimiento set
				notasucursales = '".$this->getNotasSucursales()."',
				impresiondigital = '".$this->getImpresionDigital()."',
				disenador = '".$this->getDisenador()."',
				fechaimpresion = ".($this->getFechaImpresion() == ''?'null':"'".$this->getFechaImpresion()."'").",
				notasproduccion = '".$this->getNotasProduccion()."',
				claveimpresor = '".$this->getClaveImpresor()."',
				fechaenvio = ".($this->getFechaEnvio() == ''?'null':"'".$this->getFechaEnvio()."'").",
				horaEnvio = '".$this->getHoraEnvio()."',
				fecharecepcion = ".($this->getFechaRecepcion() == ''?'null':"'".$this->getFechaRecepcion()."'").",
				entregacliente = ".($this->getEntregaCliente() == ''?'null':"'".$this->getEntregaCliente()."'").",
				notas = '".$this->getNotas()."'
			where idOrden = ".$this->getOrden()." and clave = '".$this->getClave()."'");
		
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