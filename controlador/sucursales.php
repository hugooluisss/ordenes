<?php
global $objModulo;
switch($objModulo->getId()){
	case 'sucursales':
		$db = TBase::conectaDB();
		$rs = $db->Execute("select * from razonsocial");
		
		$datos = array();
		while(!$rs->EOF){
			$datos[$rs->fields['idRazon']] = $rs->fields['clave'];
			$rs->moveNext();
		}
		
		$smarty->assign("razonesSociales", $datos);
	break;
	case 'listaSucursales':
		$db = TBase::conectaDB();
		$rs = $db->Execute("select * from sucursal");
		$datos = array();
		while(!$rs->EOF){
			$rs->fields['json'] = json_encode($rs->fields);
			array_push($datos, $rs->fields);
			$rs->moveNext();
		}
		
		$smarty->assign("lista", $datos);
	break;
	case 'csucursales':
		switch($objModulo->getAction()){
			case 'add':
				$obj = new TSucursal();
				
				$obj->setId($_POST['id']);
				$obj->setNombre($_POST['nombre']);
				$obj->setColor($_POST['color']);
				$obj->razonsocial->setId($_POST['razonsocial']);
				echo json_encode(array("band" => $obj->guardar()));
			break;
			case 'del':
				$obj = new TSucursal($_POST['id']);
				echo json_encode(array("band" => $obj->eliminar()));
			break;
		}
	break;
}
?>