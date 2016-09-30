<?php
global $objModulo;
switch($objModulo->getId()){
	case 'cmovimientos':
		switch($objModulo->getAction()){
			case 'guardar':
				$obj = new TMovimiento($_POST['orden'], $_POST['clave']);
								
				$obj->setNotas($_POST['notas']);
				$obj->setFechaImpresion($_POST['fechaImpresion']);
				$obj->setEnvio($_POST['envio']);
				$obj->setFecha($_POST['fechaHora']);
				$obj->setNotasSucursales($_POST['notasSucursales']);
				
				echo json_encode(array("band" => $obj->guardar()));
			break;
			case 'del':
				$obj = new TArea($_POST['id']);
				echo json_encode(array("band" => $obj->eliminar()));
			break;
			case 'validaClave':
				$db = TBase::conectaDB();
				$rs = $db->Execute("select idArea from area where clave = '".$_POST['txtClave']."' and not idArea = '".$_POST['id']."'");
				
				echo $rs->EOF?"true":"false";
			break;
		}
	break;
}
?>