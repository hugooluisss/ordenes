<?php
global $objModulo;
switch($objModulo->getId()){
	case 'cordenes':
		switch($objModulo->getAction()){
			case 'uploadfile':
				if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){
					$ext = explode(".", $_FILES['upl']['name']);
					if (strtolower($ext[count($ext) -1]) == 'cvs'){
						if(move_uploaded_file($_FILES['upl']['tmp_name'], "temporal/".$_FILES['upl']['name'])){
							chmod("temporal/".$_FILES['upl']['name'], 0755);
							echo json_encode(array("status" => "success"));
							exit;
						}
					}
				}
				
				echo json_encode(array("status" => "error"));
			break;
		}
	break;
};
?>