<?php
global $objModulo;
switch($objModulo->getId()){
	case 'crazonsocial':
		switch($objModulo->getAction()){
			case 'add':
				$obj = new TRazonSocial();
				
				$obj->setId($_POST['id']);
				$obj->setNombre($_POST['nombre']);
				$obj->setClave($_POST['clave']);
				echo json_encode(array("band" => $obj->guardar()));
			break;
		}
	break;
}
?>