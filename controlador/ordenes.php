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
	case 'importacionAutomatica':
		global $ini;
		$db = TBase::conectaDB();
		$rsRazon = $db->Execute("select * from razonsocial where not numero is null");
		$datos = array();
		while(!$rsRazon->EOF){
			$objEmpresa = new TRazonSocial($rsRazon->fields['idRazon']);
			$url = $ini['sistema']['direccionsae']."?inicio=".$objEmpresa->getConsecutivo()."&empresa=".$objEmpresa->getNumero();
			$ordenes = json_decode(file_get_contents($url, false));
			
			foreach($ordenes as $orden){
				try{
					if ($menor == 0)
						$menor = $orden->CODIGO;
					else
						$menor = $orden->CODIGO < $menor?$orden->CODIGO:$menor;
						
					if ($mayor == 0)
						$mayor = $orden->CODIGO;
					else
						$mayor = $orden->CODIGO > $mayor?$orden->CODIGO:$mayor;
					
					$band = true;
					$orden->CODIGO = sprintf("%d", $orden->CODIGO);
					$mensaje = "";
					$rs = $db->Execute("select idVendedor, nombre, idSucursal from vendedor where clave = '".$orden->CLAVE_VENDEDOR."' and visible = true");
					$orden->vendedor = $rs->fields;
					$mensaje .= $rs->EOF?"El vendedor no existe ":"";
					$band = !$rs->EOF and $band;
					
					$rs = $db->Execute("select idSucursal, nombre from sucursal where idSucursal = '".$orden->vendedor['idSucursal']."' and visible = true");
					$orden->sucursal = $rs->fields;
					$mensaje .= $rs->EOF?"La sucursal no existe no existe ":"";
					$band = !$rs->EOF and $band;
					
					$rs = $db->Execute("select idArea, nombre from area where clave = '".$orden->AREA_DE_PRODUCCION."' and visible = true");
					$orden->area = $rs->fields;
					$mensaje .= $rs->EOF?"El área de producción no existe ":"";
					$band = $rs->EOF?false:$band;
					$cont++;
	
					$el['ordenExiste'] = false;
					$rs2 = $db->Execute("select idCarga from carga where idRazon = ".$rsRazon->fields['idRazon']." and '".$orden->CODIGO."' between inicio and fin");
					if ($rs2->EOF){
						$rs = $db->Execute("select idOrden from orden a join sucursal b using(idSucursal) join razonsocial c using(idRazon) where idRazon = ".$rsRazon->fields['idRazon']." and codigo = '".$orden->CODIGO."' and b.visible = true");
						if ($rs->fields['idOrden'] == ''){
							$el['ordenExiste'] = false;
						}else{
							$rs3 = $db->Execute("select idOrden from movimiento where idOrden = ".$rs->fields['idOrden']." and clave = '".$orden->CLAVE_DEL_ARTICULO."'");
							$el['ordenExiste'] = $rs3->EOF;
						}
					}else
						$el['ordenExiste'] = false;
					
					$band1 = !$el['ordenExiste']?false:$band1;
					$orden->existe = $band1;
					$mensaje .= !$orden-existe?"La orden ya existe ":"";
					
					$orden->original = $orden->CODIGO;
					if (!isset($codigos[$el['codigo']])){
						$codigos[$orden->CODIGO] = array();
						$codigos[$orden->CODIGO]["cont"] = 1;
						$codigos[$orden->CODIGO]["indice"] = $i;
					}else{
						$codigos[$orden->CODIGO]["cont"]++;
						if ($codigos[$orden->CODIGO]["cont"] == 2)
							$datos[$codigos[$orden->CODIGO]["indice"] - 2]["codigo"] .= "_1";
						
						$orden->CODIGO .= "_".$codigos[$orden->CODIGO]["cont"];
					}
						
					$bandGeneral = $band and $bandGeneral;
					$orden->json = json_encode($orden);
					
					$rs = $db->Execute("select idOrden from orden where codigo = '".$orden->CODIGO."'");
					$mensaje .= !$rs->EOF?"Código duplicado ":"";
					if (!$rs->EOF){
						$band = false;
					}
					
					$orden->bandera = $band;
					
					#$rs = $db->Execute("select idOrden from orden a join sucursal b using(idSucursal) join razonsocial c using(idRazon) where codigo = '".$orden->original."' and idRazon = ".$rsRazon->fields['idRazon']);
					if ($band){
						$objOrden = new TOrden;
						if ($rs->EOF){
							$objOrden->setCodigo($orden->CODIGO);
							$objOrden->setCliente($orden->NOMBRE_DEL_CLIENTE);
							$objOrden->vendedor = new TVendedor($orden->vendedor['idVendedor']);
							$objOrden->sucursal = new TSucursal($orden->sucursal['idSucursal']);
							$objOrden->estado = new TEstado(1);
							$objOrden->setElaboracion(date("Y-m-d", $orden->FECHA_ELABORACION));
							
							$objOrden->guardar();
						}else
							$objOrden->setId($rs->fields['idOrden']);
								
						#Aqui ya tenemos a la orden, ahora hay que importar el detalle o movimiento
						$movimiento = new TMovimiento;
						$movimiento->setOrden($objOrden->getId());
						$movimiento->setCantidad($orden->CANTIDAD);
						$movimiento->setClave($orden->CLAVE_DEL_ARTICULO);
						$movimiento->setDescripcion($orden->DESCRIPCION_DEL_ARTICULO);
						$movimiento->setObservaciones($orden->OBSERVACIONES);
						$movimiento->setImporte($orden->TOTAL_DE_PARTIDA);
						$movimiento->area = new TArea();
						$movimiento->area->setByClave($orden->AREA_DE_PRODUCCION);
						
						if ($movimiento->guardar())
							$db->Execute("insert into automatica (idRazon, codigo, json, mensaje, estado) values (".$rsRazon->fields['idRazon'].", '".$orden->CODIGO."', '".json_encode($orden)."', '".$mensaje."', 1)");
						else
							$db->Execute("insert into automatica (idRazon, codigo, json, mensaje, estado) values (".$rsRazon->fields['idRazon'].", '".$orden->CODIGO."', '".json_encode($orden)."', 'No se guardó el detalle', 0)");
						unset($objOrden);
						unset($movimiento);
					}else
						$db->Execute("insert into automatica (idRazon, codigo, json, mensaje, estado) values (".$rsRazon->fields['idRazon'].", '".$orden->CODIGO."', '".json_encode($orden)."', '".$mensaje."', 0)");
				}catch(Exception $e){
					$db->Execute("insert into automatica (idRazon, codigo, json, mensaje) values (".$rsRazon->fields['idRazon'].", '".$orden->CODIGO."', '".json_encode($orden)."', 'Ocurrió un error: ".$e->getMessage()."')");
				}
			}
			
			$rsRazon->moveNext();
		}
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
		global $sesion;
		$usuario = new TUsuario($sesion['usuario']);
		
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
			
			$rs = $db->Execute("select * from orden a join sucursal b using(idSucursal) join razonsocial c using(idRazon) where idRazon = ".$_POST['razonSocial']." and codigo = '".$el['codigo']."' and b.visible = true");
			//$rs2 = $db->Execute("select idCarga from carga where idRazon = ".((integer) $_POST['razonSocial'])." and ".$el['codigo']." between inicio and fin");
			#if ($rs2->EOF or true){
			if ($rs->EOF){
				$el['ordenExiste'] = false;
			}else{
				$rs = $db->Execute("select idOrden from movimiento where idOrden = ".$rs->fields['idOrden']." and clave = '".$el['cveart']."'");
				$el['ordenExiste'] = $rs->EOF;
			}
			#}else
			#	$el['ordenExiste'] = false;
			
			
			//$band = !$el['ordenExiste']?false:$band;
			
			$rs = $db->Execute("select idArea from area where clave = '".$el['area']."' and visible = true");
			$el['areaExiste'] = !$rs->EOF;
			$band = $rs->EOF?false:$band;
			
			$rs = $db->Execute("select idVendedor from vendedor where (clave = '".$el['vendedor']."' or nombre = '".$el['vendedor']."') and visible = true");
			$el['vendedorExiste'] = !$rs->EOF;
			$band = $rs->EOF?false:$band;
			
			$rs = $db->Execute("select idSucursal from sucursal where upper(nombre) = upper('".$el['sucursal']."') and idRazon = ".$_POST['razonSocial']." and visible = true");
			$el['sucursalExiste'] = !$rs->EOF;
			$band = $rs->EOF?false:$band;
			
			if (!isset($codigos[$el['codigo']])){
				$codigos[$el['codigo']] = array();
				$codigos[$el['codigo']]["cont"] = 1;
				$codigos[$el['codigo']]["indice"] = $i;
			}else{
				$codigos[$el['codigo']]["cont"]++;
				if ($codigos[$el['codigo']]["cont"] == 2)
					$datos[$codigos[$el['codigo']]["indice"] - 2]["codigo"] .= "_1";
				
				$el['codigo'] .= "_".$codigos[$el['codigo']]["cont"];
			}
			
			$rs = $db->Execute("select idOrden from orden where codigo = '".$el['codigo']."'");
			$el['codigoDuplicado'] = true;
			if (!$rs->EOF)
				$el['codigoDuplicado'] = false;
					
			$el['json'] = json_encode(array($el));
			
			array_push($datos, $el);
		}
		
		$smarty->assign("lista", $datos);
		$smarty->assign("listaJson", json_encode($datos));
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
				$rs = $db->Execute("select a.*, b.nombre as vendedor, c.nombre as sucursal, d.color as colorEstado, d.nombre as estado, if(cast(registro as date) < cast(now() as date), 1, 0) as actual, e.descripcion, e.observaciones from orden a join vendedor b using(idVendedor) join sucursal c on a.idSucursal = c.idSucursal join estado d using(idEstado) join movimiento e using(idOrden) where a.idSucursal = ".$sucursal." and b.clave = '".$userSesion->getCodigo()."' and (not a.idEstado = 2) and (date_sub(registro, interval -".$dias." day) >= now() and not d.idEstado = 3)");
			break;
			case 3: #produccion
				$rs = $db->Execute("select a.*, b.nombre as vendedor, c.nombre as sucursal, d.color as colorEstado, d.nombre as estado, if(cast(registro as date) < cast(now() as date), 1, 0) as actual, e.observaciones, e.descripcion from orden a join vendedor b using(idVendedor) join sucursal c on a.idSucursal = c.idSucursal join estado d using(idEstado) join movimiento e using(idOrden) where idArea in (select idArea from usuarioarea where idUsuario = ".$userSesion->getId().") and a.idEstado in (1, 2, 6, 7, 8) and date_sub(registro, interval -".$dias." day) >= now()");
			break;
			case 44: #atención a clientes
				$rs = $db->Execute("select a.*, b.nombre as vendedor, c.nombre as sucursal, d.color as colorEstado, d.nombre as estado, if(cast(registro as date) < cast(now() as date), 1, 0) as actual, e.observaciones, e.descripcion from orden a join vendedor b using(idVendedor) join sucursal c on a.idSucursal = c.idSucursal join estado d using(idEstado) join movimiento e using(idOrden) where idArea in (select idArea from usuarioarea where idUsuario = ".$userSesion->getId().") and not a.idEstado in (1) and date_sub(registro, interval -".$dias." day) >= now()");
			break;
			default:
				$rs = $db->Execute("select a.*, b.nombre as vendedor, c.nombre as sucursal, d.color as colorEstado, d.nombre as estado, if(cast(registro as date) < cast(now() as date), 1, 0) as actual, e.descripcion, e.observaciones from orden a join vendedor b using(idVendedor) join sucursal c on a.idSucursal = c.idSucursal join estado d using(idEstado) join movimiento e using(idOrden) where date_sub(registro, interval -".$dias." day) >= now() and a.idSucursal = ".$sucursal);
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
		$db = TBase::conectaDB();
		$smarty->assign("orden", $orden);
		
		$rs = $db->Execute("select * from area where visible = 1");
		$datos = array();
		while(!$rs->EOF){
			array_push($datos, $rs->fields);
			$rs->moveNext();
		}
		
		$smarty->assign("areas", $datos);
		
		global $userSesion;
		
		if ($userSesion->getIdTipo() <> 1) #No es administrador
			$rs = $db->Execute("select estado.* from estado join estadotipousuario using(idEstado) join tipoUsuario on idTipoUsuario = idPerfil where idPerfil = ".$userSesion->getIdTipo()." and estado.orden >= ".$orden->estado->getOrden()." order by estado.orden");
		else
			$rs = $db->Execute("select estado.* from estado join estadotipousuario using(idEstado) join tipoUsuario on idTipoUsuario = idPerfil where idPerfil = ".$userSesion->getIdTipo()." order by estado.orden");
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
	
	/*
	case 'importarRemoto':
		$db = TBase::conectaDB();
		$rs = $db->Execute("select * from razonsocial");
		$datos = array();
		while(!$rs->EOF){
			array_push($datos, $rs->fields);
			$rs->moveNext();
		}
		
		$smarty->assign("lista", $datos);
	break;
	*/
	case 'listaOrdenesImportAuto':
		$db = TBase::conectaDB();
		/*#$db->Execute("update razonsocial set numero = '08' where clave = 'PS'");
		#$rs = $db->Execute("select * from razonsocial where clave = 'PS'");
		
		//print_r($rs->fields);
		$objEmpresa = new TRazonSocial($_POST['razonsocial']);
		
		$datos = file_get_contents("http://lyegdl.ddns.net:8080/enlace.php?inicio=".$objEmpresa->getConsecutivo()."&empresa=".$objEmpresa->getNumero(), false);
		echo "http://lyegdl.ddns.net:8080/enlace.php?inicio=".$objEmpresa->getConsecutivo()."&empresa=".$objEmpresa->getNumero();
		//$datos = file_get_contents_curl("http://lyegdl.ddns.net:8080/enlace.php?inicio=".$objEmpresa->getConsecutivo()."&empresa=".$objEmpresa->getNumero());
		echo $datos;
		
		$datos = json_decode($datos);*/
		$datos = json_decode($_POST['json_datos']);
		
		$ordenes = array();
		$bandGeneral = true;
		$codigos = array();
		$menor = 0;
		$mayor = 0;
		
		foreach($datos as $key => $orden){
			try{
				if ($menor == 0)
					$menor = $orden->CODIGO;
				else
					$menor = $orden->CODIGO < $menor?$orden->CODIGO:$menor;
					
				if ($mayor == 0)
					$mayor = $orden->CODIGO;
				else
					$mayor = $orden->CODIGO > $mayor?$orden->CODIGO:$mayor;
				
				$band = true;
				$orden->CODIGO = sprintf("%d", $orden->CODIGO);
				
				$rs = $db->Execute("select idVendedor, nombre, idSucursal from vendedor where clave = '".$orden->CLAVE_VENDEDOR."' and visible = true");
				#$sucursal = new TSucursal($rs->fields['idSucursal']);
				$orden->vendedor = $rs->fields;
				$band = !$rs->EOF and $band;
				
				$rs = $db->Execute("select idSucursal, nombre from sucursal where idSucursal = '".$orden->vendedor['idSucursal']."' and visible = true");
				$orden->sucursal = $rs->fields;
				$band = !$rs->EOF and $band;
				
				$rs = $db->Execute("select idArea, nombre from area where clave = '".$orden->AREA_DE_PRODUCCION."' and visible = true");
				$orden->area = $rs->fields;
				$band = $rs->EOF?false:$band;
				
				$rs = $db->Execute("select idOrden from orden a join sucursal b using(idSucursal) join razonsocial c using(idRazon) where idRazon = ".$_POST['razonsocial']." and codigo = '".$el['codigo']."' and b.visible = true");

				$el['ordenExiste'] = false;
				$rs2 = $db->Execute("select idCarga from carga where idRazon = ".$_POST['razonsocial']." and ".$orden->CODIGO." between inicio and fin");
				if ($rs2->EOF){
					if ($rs->EOF){
						$el['ordenExiste'] = false;
					}else{
						$rs = $db->Execute("select idOrden from movimiento where idOrden = ".$rs->fields['idOrden']." and clave = '".$orden->CLAVE_DEL_ARTICULO."'");
						$el['ordenExiste'] = $rs->EOF;
					}
				}else
					$el['ordenExiste'] = false;
				
				
				$band1 = !$el['ordenExiste']?false:$band1;
				$orden->existe = $band1;
				/*
				$rs = $db->Execute("select idArea from area where clave = '".$el['area']."' and visible = true");
				$el['areaExiste'] = !$rs->EOF;
				$band = $rs->EOF?false:$band;
				
				$rs = $db->Execute("select idVendedor from vendedor where clave = '".$el['vendedor']."' and visible = true");
				$el['vendedorExiste'] = !$rs->EOF;
				$band = $rs->EOF?false:$band;
				
				$rs = $db->Execute("select idSucursal from sucursal where upper(nombre) = upper('".$el['sucursal']."') and idRazon = ".$_POST['razonSocial']." and visible = true");
				$el['sucursalExiste'] = !$rs->EOF;
				*/
				$orden->original = $orden->CODIGO;
				if (!isset($codigos[$el['codigo']])){
					$codigos[$orden->CODIGO] = array();
					$codigos[$orden->CODIGO]["cont"] = 1;
					$codigos[$orden->CODIGO]["indice"] = $i;
				}else{
					$codigos[$orden->CODIGO]["cont"]++;
					if ($codigos[$orden->CODIGO]["cont"] == 2)
						$datos[$codigos[$orden->CODIGO]["indice"] - 2]["codigo"] .= "_1";
					
					$orden->CODIGO .= "_".$codigos[$orden->CODIGO]["cont"];
				}
					
				$bandGeneral = $band and $bandGeneral;
				$orden->json = json_encode($orden);
				
				$rs = $db->Execute("select idOrden from orden where codigo = '".$el['codigo']."'");
				$el['codigoDuplicado'] = true;
				if (!$rs->EOF){
					$el['codigoDuplicado'] = false;
					$band = false;
				}
				
				$orden->bandera = $band;
				array_push($ordenes, $orden);
			}catch(Exception $e){
				echo $e->getMessage();
			}
		}
		
		$smarty->assign("ordenes", $ordenes);
		$smarty->assign("banderaGeneral", $bandGeneral);
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
			case 'setEstadoMasivo':
				$cont = 0;
				foreach(explode(",", $_POST['identificadores']) as $id){
					$obj = new TOrden($id);
					$obj->estado->setId($_POST['estado']);
					switch($_POST['estado']){
						case 10: #si el estado es en Rack
							foreach($obj->movimientos as $mov){
								$mov->setFechaRecepcion(date("Y-m-d H:i:s"));
								$mov->guardar();
							}
						break;
						case 3: #produccion
							foreach($orden->movimientos as $mov){
								$mov->setNombreImpresor($userSesion->getNombreCompleto());
								$mov->setClaveImpresor($userSesion->getClave());
								
								$mov->guardar();
							}
						break;
					}
					
					$obj->guardar();
					
					$cont++;
				}
				
				echo json_encode(array("band" => true));
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
							$rsVendedor = $db->Execute("select idVendedor from vendedor where (clave = '".$mov->vendedor."' or upper(nombre) = upper('".$mov->vendedor."'))");
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
			case 'importarAuto':
				$db = TBase::conectaDB();
				$elementos = $_POST['items'];
				$cont = 0;
				
				try {
					$objRazon = new TRazonSocial($_POST['razonSocial']);
					$inicio = $objRazon->getConsecutivo();
					$fin = $objRazon->getConsecutivo();
					
					$inicio = $inicio == ''?0:$inicio;
					$fin = $fin == ''?0:$fin;
					
					foreach($elementos as $mov){
						$mov = json_decode($mov);
						$codigoBuf = $mov->CODIGO;
						
						$inicio = $inicio < $codigoBuf?$inicio:($codigoBuf == ''?$inicio:$codigoBuf);
						$fin = $fin > $codigoBuf?$fin:($codigoBuf == ''?$fin:$codigoBuf);
						
						//$mov = json_decode($mov);
						$rs = $db->Execute("select idOrden from orden a join sucursal b using(idSucursal) join razonsocial c using(idRazon) where codigo = '".$mov->CODIGO."' and idRazon = ".$objRazon->getId());
						
						$orden = new TOrden;
						if ($rs->EOF){
							#$rsVendedor = $db->Execute("select idVendedor from vendedor where idVendedor = '".$mov->vendedor['idVendedor']."'");
							#$rsSucursal = $db->Execute("select idSucursal from sucursal where idSucursa = upper('".$mov->sucursal."')");
							#hay que validar que el código no exista
							$rsVal = $db->Execute("select codigo, idOrden from orden where codigo = '".$mov->CODIGO."'");
							$bandVal = true;
							if (!$rsVal->EOF){
								$db->Execute("update orden set codigo = concat(codigo, '_1') where idOrden = ".$rsVal->fields['idOrden']);
							}else{
								for($a = 1 ; $a < 9999999 and $bandVal ; $a++){
									$rsVal = $db->Execute("select codigo from orden where codigo = '".($mov->CODIGO."_".$a)."'");
									if ($rsVal->EOF){
										$mov->CODIGO .= "_".$a;
										$bandVal = false;
									}
								}
								
								$bandVal = true;
							}
							
							$orden->setCodigo($mov->CODIGO);
							$orden->setCliente($mov->NOMBRE_DEL_CLIENTE);
							$orden->vendedor = new TVendedor($mov->vendedor->idVendedor);
							$orden->sucursal = new TSucursal($mov->sucursal->idSucursal);
							$orden->estado = new TEstado(1);
							$orden->setElaboracion(date("Y-m-d", $mov->FECHA_ELABORACION));
							
							$orden->guardar();
						}else
							$orden->setId($rs->fields['idOrden']);
							
						#Aqui ya tenemos a la orden, ahora hay que importar el detalle o movimiento
						$movimiento = new TMovimiento();
						$movimiento->setOrden($orden->getId());
						$movimiento->setCantidad($mov->CANTIDAD);
						$movimiento->setClave($mov->CLAVE_DEL_ARTICULO);
						$movimiento->setDescripcion($mov->DESCRIPCION_DEL_ARTICULO);
						$movimiento->setObservaciones($mov->OBSERVACIONES);
						$movimiento->setImporte($mov->TOTAL_DE_PARTIDA);
						$movimiento->area = new TArea();
						$movimiento->area->setByClave($mov->AREA_DE_PRODUCCION);
						
						$cont += $movimiento->guardar()?1:0;
					}
					
					$objRazon->addCarga($inicio, $fin);
					
					echo json_encode(array("band" => true, "total" => $cont));
				}catch (Exception $e) {
					echo json_encode(array("band" => false, "mensaje" => $e->getMessage()));
				}
			break;
			case 'eliminar':
				$obj = new TOrden;
				$obj->setId($_POST['id']);
				
				echo json_encode(array("band" => $obj->eliminar()));
			break;
			case 'updateSesion':
				echo date("H:i:s");
			break;
		}
	break;
	case 'mantenimientoOrdenes':
		switch($objModulo->getAction()){
			case 'borrarRepositorioOrdenesViejas':
				$db = TBase::conectaDB();
				global $ini;
				$dias = $ini["sistema"]["dias"];
				$dias = $dias == ''?0:$dias;
				
				$rs = $db->Execute("select * from orden where date_sub(registro, interval -".$dias." day) < now() and idEstado = 3");
				
				while(!$rs->EOF){
					$ruta = "repositorio/ordenes/orden_".$rs->fields['idOrden'];
					eliminarDir($ruta);
					echo $ruta;
					$rs->moveNext();
				}
			break;
		}
	break;
};


function file_get_contents_curl($url) {
  if (strpos($url,'http://') !== FALSE) {
    $fc = curl_init();
    curl_setopt($fc, CURLOPT_URL,$url);
    curl_setopt($fc, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($fc, CURLOPT_HEADER,0);
    curl_setopt($fc, CURLOPT_VERBOSE,0);
    curl_setopt($fc, CURLOPT_SSL_VERIFYPEER,FALSE);
    curl_setopt($fc, CURLOPT_TIMEOUT,30);
    $res = curl_exec($fc);
    curl_close($fc);
  }
  else $res = file_get_contents($url);
  return $res;
}
?>