<?php
global $objModulo;
switch($objModulo->getId()){
	case 'dashboardOrdenes':
		$db = TBase::conectaDB();
		$rs = $db->Execute("select * from razonsocial");
		$datos = array();
		while(!$rs->EOF){
			$rs->fields['json'] = json_encode($rs->fields);
			array_push($datos, $rs->fields);
			$rs->moveNext();
		}
		
		$smarty->assign("empresas", $datos);
	break;
}
?>