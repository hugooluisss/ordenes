<?php
global $objModulo;
switch($objModulo->getId()){
	case 'cmovimientos':
		switch($objModulo->getAction()){
			case 'guardar':
				$obj = new TMovimiento($_POST['orden'], $_POST['clave']);
				
				
				impresionDigital, disenador, fechaImpresion, notasProduccion, claveImpresion, fechaEnvio, horaEnvio, fechaRecepcion, entregaCliente, notas
				if (isset($_POST['impresionDigital']))
					$obj->setImpresionDigital($_POST['impresionDigital']);
					
				if (isset($_POST['disenador']))
					$obj->setDisenador($_POST['disenador']);
				
				if (isset($_POST['fechaImpresion']))
					$obj->setFechaImpresion($_POST['fechaImpresion']);
				
				if (isset($_POST['notfasProduccion']))
					$obj->setImpresionDigital($_POST['notasProduccion']);
					
				if (isset($_POST['claveImpresion']))
					$obj->setImpresionDigital($_POST['claveImpresion']);
					
				if (isset($_POST['fechaEnvio']))
					$obj->setImpresionDigital($_POST['fechaEnvio']);
					
				if (isset($_POST['horaEnvio']))
					$obj->setImpresionDigital($_POST['horaEnvio']);
					
				if (isset($_POST['fechaRecepcion ']))
					$obj->setImpresionDigital($_POST['fechaRecepcion']);
					
				if (isset($_POST['entregaCliente']))
					$obj->setImpresionDigital($_POST['entregaCliente']);
				
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