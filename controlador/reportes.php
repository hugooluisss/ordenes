<?php
global $objModulo;
switch($objModulo->getId()){
	case 'reporteEntregas':
	case 'reporte':
		$db = TBase::conectaDB();
		if (in_array($userSesion->getIdTipo(), array(1, 3, 5)))
			$rs = $db->Execute("select * from sucursal");
		else
			$rs = $db->Execute("select * from sucursal where idSucursal in (select idSucursal from usuariosucursal where idUsuario = ".$userSesion->getId().")");
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
		global $userSesion;
		//$sucursal = $userSesion->sucursal->getId();
		$sucursal = $_POST['sucursal'] == ''?$sucursal:$_POST['sucursal'];
		$estado = $_POST['estado'];
		
		global $ini;
		$dias = $ini["sistema"]["dias"];
		$dias = $dias == ''?0:$dias;
		
		$entrega = isset($_POST['entrega'])?" and e.tipoentrega = ".$_POST['entrega']:"";
			
		
		if ($_POST['antiguas'] == "false"){
			if ($_POST['sucursal'] == '')
				$rs = $db->Execute("select a.*, b.nombre as vendedor, c.nombre as sucursal, d.color as colorEstado, observaciones, descripcion, d.nombre as estado, if(cast(registro as date) < cast(now() as date), 1, 0) as actual, f.nombre as area, e.cantidad from orden a join vendedor b using(idVendedor) join sucursal c on b.idSucursal = c.idSucursal join estado d using(idEstado) join movimiento e using(idOrden) join area f using(idArea) where c.idSucursal in (select idSucursal from usuariosucursal where date_sub(registro, interval -".$dias." day) >= now() and idUsuario = ".$userSesion->getId().")".$entrega." and ".($estado == ''?"":("and idEstado = ".$estado)));
			else
				$rs = $db->Execute("select a.*, b.nombre as vendedor, observaciones, descripcion, c.nombre as sucursal, d.color as colorEstado, d.nombre as estado, if(cast(registro as date) < cast(now() as date), 1, 0) as actual, f.nombre as area, e.cantidad from orden a join vendedor b using(idVendedor) join sucursal c on b.idSucursal = c.idSucursal join estado d using(idEstado) join movimiento e using(idOrden) join area f using(idArea) where date_sub(registro, interval -".$dias." day) >= now() and c.idSucursal = ".$sucursal."".$entrega." ".($estado == ''?"":("and idEstado = ".$estado)));
		}else{
			if ($_POST['sucursal'] == '')
				$rs = $db->Execute("select a.*, b.nombre as vendedor, c.nombre as sucursal, d.color as colorEstado, observaciones, descripcion, d.nombre as estado, if(cast(registro as date) < cast(now() as date), 1, 0) as actual, f.nombre as area, e.cantidad from orden a join vendedor b using(idVendedor) join sucursal c on b.idSucursal = c.idSucursal join estado d using(idEstado) join movimiento e using(idOrden) join area f using(idArea) where idSucursal in (select idSucursal from usuariosucursal where date_sub(registro, interval -".$dias." day) < now()".$entrega." and idUsuario = ".$userSesion->getId().") and ".($estado == ''?"":("and idEstado = ".$estado)));
			else
				$rs = $db->Execute("select a.*, b.nombre as vendedor, observaciones, descripcion, c.nombre as sucursal, d.color as colorEstado, d.nombre as estado, if(cast(registro as date) < cast(now() as date), 1, 0) as actual, f.nombre as area, e.cantidad from orden a join vendedor b using(idVendedor) join sucursal c on b.idSucursal = c.idSucursal join estado d using(idEstado) join movimiento e using(idOrden) join area f using(idArea) where date_sub(registro, interval -".$dias." day) < now()".$entrega." and c.idSucursal = ".$sucursal." ".($estado == ''?"":("and idEstado = ".$estado)));
		}
			
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
				global $ini;
				$dias = $ini["sistema"]["dias"];
				$dias = $dias == ''?0:$dias;
				
				$rsEstado = $db->Execute("select * from estado");
				$datos = array();
				while(!$rsEstado->EOF){
					if ($_POST['antiguas'] == "false")
						$rs = $db->Execute("select count(*) as total from orden where date_sub(registro, interval -".$dias." day) >= now() and idEstado = ".$rsEstado->fields['idEstado']." and idSucursal = ".($_POST['sucursal'] == ''?$pageSesion->sucursal->getId():$_POST['sucursal']));
					else
						$rs = $db->Execute("select count(*) as total from orden where date_sub(registro, interval -".$dias." day) < now() and idEstado = ".$rsEstado->fields['idEstado']." and idSucursal = ".($_POST['sucursal'] == ''?$pageSesion->sucursal->getId():$_POST['sucursal']));
					$rsEstado->fields['total'] = $rs->fields['total'];
					
					array_push($datos, $rsEstado->fields);
					$rsEstado->moveNext();
				}
				
				echo json_encode(array("estados" => $datos));
			break;
			case 'getResumenEntrega':
				$db = TBase::conectaDB();
				global $ini;
				$dias = $ini["sistema"]["dias"];
				$dias = $dias == ''?0:$dias;
				
				$rsEstado = $db->Execute("select * from estado");
				$datos = array();
				while(!$rsEstado->EOF){
					if ($_POST['antiguas'] == "false")
						$rs = $db->Execute("select count(*) as total from orden a join movimiento b using(idOrden) where date_sub(registro, interval -".$dias." day) >= now() and idEstado = ".$rsEstado->fields['idEstado']." and tipoentrega = ".$_POST['entrega']." and idSucursal = ".($_POST['sucursal'] == ''?$pageSesion->sucursal->getId():$_POST['sucursal']));
					else
						$rs = $db->Execute("select count(*) as total from orden a join movimiento b using(idOrden) where date_sub(registro, interval -".$dias." day) < now() and idEstado = ".$rsEstado->fields['idEstado']." and tipoentrega = ".$_POST['entrega']." and idSucursal = ".($_POST['sucursal'] == ''?$pageSesion->sucursal->getId():$_POST['sucursal']));
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