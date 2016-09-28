<?php
global $objModulo;
switch($objModulo->getId()){
	case 'listaVendedores':
		$db = TBase::conectaDB();
		$rs = $db->Execute("select * from vendedor");
		$datos = array();
		while(!$rs->EOF){
			$rs->fields['json'] = json_encode($rs->fields);
			array_push($datos, $rs->fields);
			$rs->moveNext();
		}
		
		$smarty->assign("lista", $datos);
	break;
	case 'cvendedores':
		switch($objModulo->getAction()){
			case 'add':
				$obj = new TArea();
				
				$obj->setId($_POST['id']);
				$obj->setNombre($_POST['nombre']);
				$obj->setClave($_POST['clave']);
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