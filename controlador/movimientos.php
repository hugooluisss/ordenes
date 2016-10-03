<?php
global $objModulo;
switch($objModulo->getId()){
	case 'cmovimientos':
		switch($objModulo->getAction()){
			case 'guardar':
				$obj = new TMovimiento($_POST['orden'], $_POST['clave']);
				
				if (isset($_POST['notasSucursales']))
					$obj->setNotasSucursales($_POST['notasSucursales']);
					
				if (isset($_POST['impresionDigital']))
					$obj->setImpresionDigital($_POST['impresionDigital']);
					
				if (isset($_POST['disenador']))
					$obj->setDisenador($_POST['disenador']);
				
				if (isset($_POST['fechaImpresion']))
					$obj->setFechaImpresion($_POST['fechaImpresion']);
				
				if (isset($_POST['notasProduccion']))
					$obj->setNotasProduccion($_POST['notasProduccion']);
					
				if (isset($_POST['claveImpresor']))
					$obj->setClaveImpresor($_POST['claveImpresor']);
					
				if (isset($_POST['nombreImpresor']))
					$obj->setNombreImpresor($_POST['nombreImpresor']);
					
				if (isset($_POST['fechaEnvio']))
					$obj->setFechaEnvio(str_replace("_", "0", $_POST['fechaEnvio']));
					
				if (isset($_POST['horaEnvio']))
					$obj->setHoraEnvio(str_replace("_", "0", $_POST['horaEnvio']));
					
				if (isset($_POST['fechaRecepcion']))
					$obj->setFechaRecepcion($_POST['fechaRecepcion']);
					
				if (isset($_POST['entregaCliente']))
					$obj->setEntregaCliente($_POST['entregaCliente']);
					
				if (isset($_POST['notas']))
					$obj->setNotas($_POST['notas']);
				
				echo json_encode(array("band" => $obj->guardar()));
			break;
			case 'uploadfile':
				if(isset($_FILES['upl']) and $_FILES['upl']['error'] == 0 and $_POST['orden'] <> '' and $_POST['movimiento'] <> ''){
					$carpeta = "repositorio/ordenes/orden_".$_POST['orden']."/movimiento_".$_POST['movimiento']."/";
					mkdir($carpeta, 0777, true);
					chmod($carpeta, 0755);
					if(move_uploaded_file($_FILES['upl']['tmp_name'], $carpeta.$_FILES['upl']['name'])){
						chmod($carpeta.$_FILES['upl']['tmp_name'], 0755);
						echo '{"status":"success"}';
						exit;
					}
				}
				
				echo '{"status":"error"}';
			break;
		}
	break;
}
?>