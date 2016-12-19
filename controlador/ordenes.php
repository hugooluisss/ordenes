<?php
global $objModulo;
switch($objModulo->getId()){
	case 'importar':
		$db = TBase::conectaDB();
		$rs = $db->Execute("select * from razonsocial");
		$datos = array();
		while(!$rs->EOF){
			$razon = new TRazonSocial($rs->fields['idRazon']);
			$rs->fields['ultimaImportacion'] = $razon->getUltimaCarga();
			$rs->fields['json'] = json_encode($rs->fields);
			
			array_push($datos, $rs->fields);
			$rs->moveNext();
		}
		
		$smarty->assign("razonesSociales", $datos);
	break;
	case 'listaImportar':
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('CP1251');
		$data->read('temporal/'.$_POST['archivo']);
		$datos = array();
		$codigos = array();
		$band = true;
		$fi = utf8_encode($data->sheets[0]['cells'][2][1]);
		$ff = utf8_encode($data->sheets[0]['cells'][2][1]);
		
		for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
			$el = array();
			
			$el['codigo'] = utf8_encode($data->sheets[0]['cells'][$i][1]);
			$el['original'] = utf8_encode($data->sheets[0]['cells'][$i][1]);
			$el['cantidad'] = utf8_encode($data->sheets[0]['cells'][$i][2]);
			$el['cveart'] = utf8_encode($data->sheets[0]['cells'][$i][3]);
			$el['desart'] = utf8_encode($data->sheets[0]['cells'][$i][4]);
			$el['obsart'] = utf8_encode($data->sheets[0]['cells'][$i][5]);
			$el['cliente'] = utf8_encode($data->sheets[0]['cells'][$i][6]);
			$el['vendedor'] = utf8_encode($data->sheets[0]['cells'][$i][7]);
			$el['elaborado'] = utf8_encode($data->sheets[0]['cells'][$i][8]);
			$el['importe'] = utf8_encode($data->sheets[0]['cells'][$i][9]);
			$el['sucursal'] = utf8_encode($data->sheets[0]['cells'][$i][10]);
			$el['area'] = utf8_encode($data->sheets[0]['cells'][$i][11]);
			
			$fi = $el['codigo'] < $fi?$el['codigo']:$fi;
			$ff = $el['codigo'] > $ff?$el['codigo']:$ff;
			
			$db = TBase::conectaDB();
			
			$rs = $db->Execute("select idOrden from orden a join sucursal b using(idSucursal) join razonsocial c using(idRazon) where idRazon = ".$_POST['razonSocial']." and codigo = '".$el['codigo']."' and b.visible = true");
			$rs2 = $db->Execute("select idCarga from carga where idRazon = ".$_POST['razonSocial']." and ".$el['codigo']." between inicio and fin");
			if ($rs2->EOF){
				if ($rs->EOF){
					$el['ordenExiste'] = true;
				}else{
					$rs = $db->Execute("select idOrden from movimiento where idOrden = ".$rs->fields['idOrden']." and clave = '".$el['cveart']."'");
					$el['ordenExiste'] = $rs->EOF;
				}
			}else
				$el['ordenExiste'] = false;
			
			
			$band = !$el['ordenExiste']?false:$band;
			
			$rs = $db->Execute("select idArea from area where clave = '".$el['area']."' and visible = true");
			$el['areaExiste'] = !$rs->EOF;
			$band = $rs->EOF?false:$band;
			
			$rs = $db->Execute("select idVendedor from vendedor where clave = '".$el['vendedor']."' and visible = true");
			$el['vendedorExiste'] = !$rs->EOF;
			$band = $rs->EOF?false:$band;
			
			$rs = $db->Execute("select idSucursal from sucursal where upper(nombre) = upper('".$el['sucursal']."') and idRazon = ".$_POST['razonSocial']." and visible = true");
			$el['sucursalExiste'] = !$rs->EOF;
			$band = $rs->EOF?false:$band;
			
			if (!isset($codigos[$el['codigo']])){
				$codigos[$el['codigo']] = array();
				$codigos[$el['codigo']]["cont"] = "a";
				$codigos[$el['codigo']]["indice"] = $i;
			}else{
				$codigos[$el['codigo']]["cont"]++;
				if ($codigos[$el['codigo']]["cont"] == 'b')
					$datos[$codigos[$el['codigo']]["indice"] - 2]["codigo"] .= "_a";
				
				$el['codigo'] .= "_".$codigos[$el['codigo']]["cont"];
			}
			
			array_push($datos, $el);
		}

		$smarty->assign("lista", $datos);
		$smarty->assign("listaJson", json_encode($datos));
		
		global $sesion;
		$usuario = new TUsuario($sesion['usuario']);
		
		if ($usuario->getIdTipo() == 1)		
			$smarty->assign("error", true);
		else
			$smarty->assign("error", $band);
		
		$smarty->assign("folios", array("inicio" => $fi, "fin" => $ff));
	break;
	case 'listaOrdenesAdmin':
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
	case 'listaOrdenes':
		$db = TBase::conectaDB();
		global $ini;
		$dias = $ini["sistema"]["dias"];
		$dias = $dias == ''?0:$dias;
		$sucursal = $_POST['sucursal'] == ''?$sucursal:$_POST['sucursal'];

		switch($userSesion->getIdTipo()){
			case 2: #diseñador
				$rs = $db->Execute("select a.*, b.nombre as vendedor, c.nombre as sucursal, d.color as colorEstado, d.nombre as estado, if(cast(registro as date) < cast(now() as date), 1, 0) as actual, e.descripcion, e.observaciones from orden a join vendedor b using(idVendedor) join sucursal c using(idSucursal) join estado d using(idEstado) join movimiento e using(idOrden) where idSucursal = ".$sucursal." and b.clave = '".$userSesion->getCodigo()."' and not a.idEstado = 2 and date_sub(registro, interval -".$dias." day) >= now()");
			break;
			case 3: #produccion
				$rs = $db->Execute("select a.*, b.nombre as vendedor, c.nombre as sucursal, d.color as colorEstado, d.nombre as estado, if(cast(registro as date) < cast(now() as date), 1, 0) as actual, e.observaciones, e.descripcion from orden a join vendedor b using(idVendedor) join sucursal c using(idSucursal) join estado d using(idEstado) join movimiento e using(idOrden) where idArea in (select idArea from usuarioarea where idUsuario = ".$userSesion->getId().") and a.idEstado in (1, 2, 6, 7, 8) and date_sub(registro, interval -".$dias." day) >= now()");
			break;
			case 44: #atención a clientes
				$rs = $db->Execute("select a.*, b.nombre as vendedor, c.nombre as sucursal, d.color as colorEstado, d.nombre as estado, if(cast(registro as date) < cast(now() as date), 1, 0) as actual, e.observaciones, e.descripcion from orden a join vendedor b using(idVendedor) join sucursal c using(idSucursal) join estado d using(idEstado) join movimiento e using(idOrden) where idArea in (select idArea from usuarioarea where idUsuario = ".$userSesion->getId().") and not a.idEstado in (1) and date_sub(registro, interval -".$dias." day) >= now()");
			break;
			default:
				$rs = $db->Execute("select a.*, b.nombre as vendedor, c.nombre as sucursal, d.color as colorEstado, d.nombre as estado, if(cast(registro as date) < cast(now() as date), 1, 0) as actual, e.descripcion, e.observaciones from orden a join vendedor b using(idVendedor) join sucursal c using(idSucursal) join estado d using(idEstado) join movimiento e using(idOrden) where date_sub(registro, interval -".$dias." day) >= now() and idSucursal = ".$sucursal);
			break;
		}
		
		$datos = array();
		while(!$rs->EOF){
			switch($userSesion->getIdTipo()){
				case 3:
					$orden = new TOrden($rs->fields['idOrden']);
					$rs->fields['archivo'] = $orden->movimientos[0]->getRutaArchivoUltimo();
				break;
			}
			
			$rs->fields['json'] = json_encode($rs->fields);
			array_push($datos, $rs->fields);
			$rs->moveNext();
		}
		
		$smarty->assign("lista", $datos);
	break;
	case 'detalleOrden':
		$orden = new TOrden($_POST['orden']);
		$smarty->assign("orden", $orden);
		
		$db = TBase::conectaDB();
		$rs = $db->Execute("select estado.* from estado join estadotipousuario using(idEstado) join tipoUsuario on idTipoUsuario = idPerfil where idPerfil = ".$userSesion->getIdTipo());
		$datos = array();
		while(!$rs->EOF){
			array_push($datos, $rs->fields);
			$rs->moveNext();
		}
		
		$smarty->assign("estados", $datos);
		
		$smarty->assign("perfil", $userSesion->getIdTipo());
	break;
	case 'archivosorden':
		$orden = new TOrden($_GET['orden']);
		$smarty->assign("orden", $orden);
		$movimiento = new TMovimiento($_GET['orden'], $_GET['clave']);
		$smarty->assign("movimiento", $movimiento);
	break;
	case 'historialEstados':
		$db = TBase::conectaDB();
		$rs = $db->Execute("select a.*, b.nombre as estado, b.color, c.nombre as usuario from evento a join estado b using(idEstado) join usuario c using(idUsuario) where idOrden = ".$_GET['orden']." order by a.fecha desc");
		$datos = array();
		$terminada = new DateTime();
		while(!$rs->EOF){
			array_push($datos, $rs->fields);
			if ($rs->fields['idEstado'] == 3)
				$terminada = new DateTime($rs->fields['fecha']);
			$rs->moveNext();
		}
		
		$smarty->assign("lista", $datos);
		$orden = new TOrden($_GET['orden']);
		$smarty->assign("orden", $orden);
		$registro = new DateTime($orden->getRegistro());
		
		
		$interval = $registro->diff($terminada);

		$smarty->assign("tiempo", $interval->format('%a días'));
	break;
	case 'cordenes':
		switch($objModulo->getAction()){
			case 'guardar':
				$obj = new TOrden($_POST['id']);
				$obj->estado->setId($_POST['estado']);
				if ($_POST['estado'] == 10){ #si el estado es en Rack
					foreach($obj->movimientos as $mov){
						$mov->setFechaRecepcion(date("Y-m-d H:i:s"));
						$mov->guardar();
					}
				}
				
				if ($userSesion->getIdTipo() == 3){ #produccion
					foreach($orden->movimientos as $mov){
						$mov->setNombreImpresor($userSesion->getNombreCompleto());
						$mov->setClaveImpresor($userSesion->getClave());
						
						$mov->guardar();
					}
				}
				
				echo json_encode(array("band" => $obj->guardar()));
			break;
			case 'uploadfile':
				if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){
					$ext = explode(".", $_FILES['upl']['name']);
					if (strtolower($ext[count($ext) -1]) == 'xls'){
						if(move_uploaded_file($_FILES['upl']['tmp_name'], "temporal/".$_FILES['upl']['name'])){
							chmod("temporal/".$_FILES['upl']['name'], 0755);
							echo json_encode(array("status" => "success"));
							exit;
						}
					}
				}
				
				echo json_encode(array("status" => "error"));
			break;
			case 'importar':
				$db = TBase::conectaDB();
				$elementos = json_decode($_POST['items']);
				$cont = 0;
				
				try {
					foreach($elementos as $mov){
						$rs = $db->Execute("select idOrden from orden a join sucursal b using(idSucursal) join razonsocial c using(idRazon) where codigo = '".$mov->original."' and idRazon = ".$_POST['razonSocial']);
						
						$orden = new TOrden;
						if ($rs->EOF){
							$rsVendedor = $db->Execute("select idVendedor from vendedor where clave = '".$mov->vendedor."'");
							$rsSucursal = $db->Execute("select idSucursal from sucursal where upper(nombre) = upper('".$mov->sucursal."')");
						
							$orden->setCodigo($mov->codigo);
							$orden->setCliente($mov->cliente);
							$orden->vendedor = new TVendedor($rsVendedor->fields['idVendedor']);
							$orden->sucursal = new TSucursal($rsSucursal->fields['idSucursal']);
							$orden->estado = new TEstado(1);
							$orden->setElaboracion(date("Y-m-d", $mov->elaborado));
							
							$orden->guardar();
						}else
							$orden->setId($rs->fields['idOrden']);
							
						#Aqui ya tenemos a la orden, ahora hay que importar el detalle o movimiento
						$movimiento = new TMovimiento();
						$movimiento->setOrden($orden->getId());
						$movimiento->setCantidad($mov->cantidad);
						$movimiento->setClave($mov->cveart);
						$movimiento->setDescripcion($mov->desart);
						$movimiento->setObservaciones($mov->obsart);
						$movimiento->setImporte($mov->importe);
						$movimiento->area = new TArea();
						$movimiento->area->setByClave($mov->area);
						
						$cont += $movimiento->guardar()?1:0;
					}
					
					$objRazon = new TRazonSocial($_POST['razonSocial']);
					$objRazon->addCarga($_POST['inicio'], $_POST['fin']);
					
					echo json_encode(array("band" => true, "total" => $cont));
				}catch (Exception $e) {
					echo json_encode(array("band" => false, "mensaje" => $e->getMessage()));
				}
			break;
		}
	break;
};
?>