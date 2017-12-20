<?php
global $objModulo;
switch($objModulo->getId()){
	case 'dashboardOrdenes':
		$db = TBase::conectaDB();
		$rs = $db->Execute("select * from razonsocial");
		$datos = array();
		while(!$rs->EOF){
			$rs2 = $db->Execute("select * from automatica where idRazon = ".$rs->fields['idRazon']);
			$rs->fields['importacion'] = array();
			while(!$rs2->EOF){
				array_push($rs->fields['importacion'], $rs2->fields);
				$rs2->moveNext();
			}
			$rs->fields['json'] = json_encode($rs->fields);
			array_push($datos, $rs->fields);
			$rs->moveNext();
		}
		
		$smarty->assign("empresas", $datos);
		$smarty->assign("direccionsae", $ini['sistema']['direccionsae']);
	break;
}
?>