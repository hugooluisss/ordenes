<?php
global $objModulo;
switch($objModulo->getId()){
	case 'listadoEstados':
		$db = TBase::conectaDB();
		
		$rs = $db->Execute("select * from estado order by idEstado");
		$datos = array();
		while(!$rs->EOF){
			$rs->fields['json'] = json_encode($rs->fields);
			
			array_push($datos, $rs->fields);
			$rs->moveNext();
		}
		
		$smarty->assign("lista", $datos);
	break;
	case 'cestados':
		switch($objModulo->getAction()){
			case 'add':
				$obj = new TEstado();
				$obj->setId($_POST['id']);
				$obj->setNombre($_POST['nombre']);
				$obj->setColor($_POST['color']);
				$obj->setOrden($_POST['orden']);
				
				echo json_encode(array("band" => $obj->guardar()));
			break;
			case 'del':
				$obj = new TEstado($_POST['id']);
				echo json_encode(array("band" => $obj->eliminar()));
			break;
		}
	break;
};
?>