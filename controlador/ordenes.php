<?php
global $objModulo;
switch($objModulo->getId()){
	case 'listaImportar':
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('CP1251');
		$data->read('temporal/'.$_POST['archivo']);
		$datos = array();
		
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
			
			$el['json'] = json_encode($el);
			$db = TBase::conectaDB();
			$rs = $db->Execute("select idArea from area where clave = '".$el['area']."'");
			$el['areaExiste'] = !$rs->EOF;
			
			$rs = $db->Execute("select idVendedor from vendedor where clave = '".$el['vendedor']."'");
			$el['vendedorExiste'] = !$rs->EOF;
			
			array_push($datos, $el);
		 
		}
		$smarty->assign("lista", $datos);
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
				}
				
				echo json_encode(array("band" => true));
			break;
		}
	break;
};
?>