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
	case 'listaOrdenesReportes':
		$db = TBase::conectaDB();
		$sucursal = $userSesion->sucursal->getId();
		$sucursal = $_POST['sucursal'] == ''?$sucursal:$_POST['sucursal'];
		$estado = $_POST['estado'];

		$rs = $db->Execute("select a.*, b.nombre as vendedor, c.nombre as sucursal, d.color as colorEstado, d.nombre as estado, if(cast(registro as date) < cast(now() as date), 1, 0) as actual from orden a join vendedor b using(idVendedor) join sucursal c using(idSucursal) join estado d using(idEstado) where idSucursal = ".$sucursal." ".($estado == ''?"":("and idEstado = ".$estado)));
		$datos = array();
		while(!$rs->EOF){
			$rs->fields['json'] = json_encode($rs->fields);
			
			array_push($datos, $rs->fields);
			$rs->moveNext();
		}
		
		$smarty->assign("lista", $datos);
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