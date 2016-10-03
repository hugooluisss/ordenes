<?php
global $objModulo;
switch($objModulo->getId()){
	case 'reporte':
		$db = TBase::conectaDB();
		$rs = $db->Execute("select * from sucursal");
		$datos = array();
		while(!$rs->EOF){
			$rs->fields['json'] = json_encode($rs->fields);
			
			array_push($datos, $rs->fields);
			$rs->moveNext();
		}
		
		$smarty->assign("sucursales", $datos);
	break;
	case 'creportes':
		switch($objModulo->getAction()){
			case 'getResumen':
				$db = TBase::conectaDB();
				
				$rsEstado = $db->Execute("select * from estado");
				$datos = array();
				while(!$rsEstado->EOF){
					$rs = $db->Execute("select count(*) as total from orden where idEstado = ".$rsEstado->fields['idEstado']." and idSucursal = ".($_POST['sucursal'] == ''?$pageSesion->sucursal->getId():$_POST['sucursal']));
					$rsEstado->fields['total'] = $rs->fields['total'];
					
					array_push($datos, $rsEstado->fields);
					$rsEstado->moveNext();
				}
				
				echo json_encode(array("estados" => $datos));
			break;
		}
	break;
}
?>