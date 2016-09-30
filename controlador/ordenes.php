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
		$band = true;
		$fi = utf8_encode($data->sheets[0]['cells'][2][1]);
		$ff = utf8_encode($data->sheets[0]['cells'][2][1]);
		
		for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
			$el = array();
			
			$el['codigo'] = utf8_encode($data->sheets[0]['cells'][$i][1]);
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
			
			//$el['json'] = json_encode($el);
			$db = TBase::conectaDB();
			
			$rs = $db->Execute("select idOrden from orden a join sucursal b using(idSucursal) join razonsocial c using(idRazon) where idRazon = ".$_POST['razonSocial']." and codigo = '".$el['codigo']."'");
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
			
			$rs = $db->Execute("select idArea from area where clave = '".$el['area']."'");
			$el['areaExiste'] = !$rs->EOF;
			$band = $rs->EOF?false:$band;
			
			$rs = $db->Execute("select idVendedor from vendedor where clave = '".$el['vendedor']."'");
			$el['vendedorExiste'] = !$rs->EOF;
			$band = $rs->EOF?false:$band;
			
			$rs = $db->Execute("select idSucursal from sucursal where upper(nombre) = upper('".$el['sucursal']."') and idRazon = ".$_POST['razonSocial']);
			$el['sucursalExiste'] = !$rs->EOF;
			$band = $rs->EOF?false:$band;
			
			array_push($datos, $el);
		}
		$smarty->assign("lista", $datos);
		$smarty->assign("listaJson", json_encode($datos));
		$smarty->assign("error", $band);
		$smarty->assign("folios", array("inicio" => $fi, "fin" => $ff));
	break;
	case 'listaOrdenesAdmin':
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
	case 'listaOrdenes':
		$db = TBase::conectaDB();
		$sucursal = $userSesion->sucursal->getId();
		$sucursal = $_POST['sucursal'] == ''?$sucursal:$_POST['sucursal'];

		$rs = $db->Execute("select a.*, b.nombre as vendedor, c.nombre as sucursal, d.color as colorEstado, d.nombre as estado, if(cast(registro as date) < cast(now() as date), 1, 0) as actual from orden a join vendedor b using(idVendedor) join sucursal c using(idSucursal) join estado d using(idEstado) where idSucursal = ".$sucursal);
		$datos = array();
		while(!$rs->EOF){
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
		$rs = $db->Execute("select * from estado");
		$datos = array();
		while(!$rs->EOF){
			array_push($datos, $rs->fields);
			$rs->moveNext();
		}
		
		$smarty->assign("estados", $datos);
	break;
	case 'cordenes':
		switch($objModulo->getAction()){
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
						$rs = $db->Execute("select idOrden from orden where codigo = '".$mov->codigo."'");
						
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