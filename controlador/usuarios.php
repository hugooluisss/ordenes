<?php
global $objModulo;
switch($objModulo->getId()){
	case 'admonUsuarios':
		$db = TBase::conectaDB();
		global $sesion;
		$usuario = new TUsuario($sesion['usuario']);

		$rs = $db->Execute("select * from tipoUsuario");
		
		$datos = array();
		while(!$rs->EOF){
			$datos[$rs->fields['idTipoUsuario']] = $rs->fields['nombre'];
			$rs->moveNext();
		}
		
		$smarty->assign("tipos", $datos);
		
		$rs = $db->Execute("select * from sucursal");
		
		$datos = array();
		while(!$rs->EOF){
			$datos[$rs->fields['idSucursal']] = $rs->fields['nombre'];
			$rs->moveNext();
		}
		
		$smarty->assign("sucursales", $datos);
		
		$rs = $db->Execute("select * from area");
		$datos = array();
		while(!$rs->EOF){
			array_push($datos, $rs->fields);
			$rs->moveNext();
		}
		
		$smarty->assign("areas", $datos);
	break;
	case 'listaUsuarios':
		$db = TBase::conectaDB();
		global $sesion;
		$usuario = new TUsuario($sesion['usuario']);
		$rs = $db->Execute("select * from usuario where visible = true");
		$datos = array();
		while(!$rs->EOF){
			$obj = new TUsuario($rs->fields['idUsuario']);
			
			$rs->fields['tipo'] = $obj->getTipo();
			$rs->fields['areas'] = $obj->areas;
			$rs->fields['sucursales'] = $obj->sucursales;
			$rs->fields['perfiles'] = $obj->perfiles;
			$rs->fields['json'] = json_encode($rs->fields);
			array_push($datos, $rs->fields);
			$rs->moveNext();
		}
		$smarty->assign("lista", $datos);
		
		$rs = $db->Execute("select * from tipoUsuario");
		$datos = array();
		while(!$rs->EOF){
			array_push($datos, $rs->fields);
			$rs->moveNext();
		}
		
		$smarty->assign("tipoUsuario", $datos);
	break;
	case 'usuarioDatosPersonales':
		global $sesion;
		$usuario = new TUsuario($sesion['usuario']);
		$smarty->assign("nombre", $usuario->getNombre());
		$smarty->assign("app", $usuario->getApp());
		$smarty->assign("apm", $usuario->getApm());
	break;
	case 'cusuarios':
		switch($objModulo->getAction()){
			case 'add':
				$db = TBase::conectaDB();
				$obj = new TUsuario();
				
				$rs = $db->Execute("select idUsuario from usuario where email = '".$_POST['email']."'");
				
				if (!$rs->EOF){ #si es que encontr� el email
					if ($rs->fields["idUsuario"] <> $_POST['id']){
						$obj->setId($rs->fields['idUsuario']);
						echo json_encode(array("band" => false, "mensaje" => "El email ya se encuentra registrado con el usuario ".$obj->getNombreCompleto()));
						exit(1);
					}
				}

				$obj = new TUsuario();
				
				$obj->setId($_POST['id']);
				$obj->setNombre($_POST['nombre']);
				$obj->setClave($_POST['clave']);
				$obj->setEmail($_POST['email']);
				$obj->setPass($_POST['pass']);
				#$obj->setTipo($_POST['tipo']);
				$obj->setPuesto($_POST['puesto']);
				$obj->setCodigo($_POST['codigo']);
				$obj->delAllSucursales();
				
				
				echo json_encode(array("band" => $obj->guardar()));
				foreach($_POST['sucursal'] as $sucursal)
					$obj->addSucursal($sucursal);
					
				$obj->delAllPerfiles();	
				foreach($_POST['perfiles'] as $perfil)
					$obj->addPerfil($perfil);
			break;
			case 'del':
				$obj = new TUsuario($_POST['usuario']);
				echo json_encode(array("band" => $obj->eliminar()));
			break;
			case 'saveDatosPersonales':
				global $sesion;
				
				$obj = new TUsuario();
				$obj->setId($sesion['usuario']);
				$obj->setNombre($_POST['nombre']);
				
				echo json_encode(array("band" => $obj->guardar()));
			break;
			case 'savePassword':
				global $sesion;
				
				$obj = new TUsuario();
				$obj->setId($sesion['usuario']);
				$obj->setPass($_POST['pass']);
				
				echo json_encode(array("band" => $obj->guardar()));
			break;
			case 'addArea':
				$obj = new TUsuario($_POST['usuario']);
				echo json_encode(array("band" => $obj->addArea($_POST['area'])));
			break;
			case 'delArea':
				$obj = new TUsuario($_POST['usuario']);
				echo json_encode(array("band" => $obj->delArea($_POST['area'])));
			break;
			case 'changePerfil':
				global $sesion;
				$obj = new TUsuario($sesion['usuario']);
				$obj->setTipo($_POST['perfil']);
				echo json_encode(array("band" => $obj->guardar()));
			break;
		}
	break;
}
?>