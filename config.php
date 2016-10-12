<?php
define('SISTEMA', 'Ordenes servicio');
define('VERSION', 'v 1.0');
define('ALIAS', '');
define('AUTOR', 'Hugo Luis Santiago Altamirano');
define('EMAIL', 'hugooluisss@gmail.com');
define('EMAILSOPORTE', 'hugooluisss@gmail.com');
define('STATUS', 'En desarrollo');

define('LAYOUT_DEFECTO', 'layout/default.tpl');
define('LAYOUT_AJAX', 'layout/update.tpl');
define('LAYOUT_JSON', 'layout/json.tpl');
define('LAYOUT_TOPNAV', 'layout/topnav.tpl');

#Login y su controlador
$conf['inicio'] = array(
	'descripcion' => '',
	'seguridad' => false,
	'js' => array('usuario.class.js'),
	'jsTemplate' => array('login.js'),
	'capa' => 'layout/login.tpl');

$conf['logout'] = array(
	'controlador' => 'login.php',
	#'vista' => 'usuarios/panel.tpl',
	'descripcion' => 'Salir del sistema',
	'seguridad' => false,
	'js' => array(),
	'capa' => LAYOUT_DEFECTO);
	
$conf['clogin'] = array(
	'controlador' => 'login.php',
	'descripcion' => 'Inicio de sesion',
	'seguridad' => false,
	'capa' => LAYOUT_AJAX);
	
$conf['bienvenida'] = array(
	'controlador' => 'usuarios.php',
	'vista' => 'usuarios/bienvenida.tpl',
	'descripcion' => 'Bienvenida al sistema',
	'seguridad' => true,
	'capa' => LAYOUT_DEFECTO);

$conf['admonUsuarios'] = array(
	'controlador' => 'usuarios.php',
	'vista' => 'usuarios/panel.tpl',
	'descripcion' => 'Administración de usuarios',
	'seguridad' => true,
	'js' => array('usuario.class.js'),
	'jsTemplate' => array('usuarios.js'),
	'perfiles' => array(1),
	'capa' => LAYOUT_DEFECTO);

$conf['listaUsuarios'] = array(
	'controlador' => 'usuarios.php',
	'vista' => 'usuarios/lista.tpl',
	'descripcion' => 'Lista de usuarios',
	'seguridad' => true,
	'capa' => LAYOUT_AJAX);
	
$conf['cusuarios'] = array(
	'controlador' => 'usuarios.php',
	'descripcion' => 'Controlador de usuarios',
	'seguridad' => true,
	'capa' => LAYOUT_AJAX);
	
/*Datos de usuario desde el panel*/
$conf['usuarioDatosPersonales'] = array(
	'controlador' => 'usuarios.php',
	'vista' => 'usuarios/datosPersonales.tpl',
	'descripcion' => 'Cambiar datos personales',
	'seguridad' => true,
	'js' => array('usuario.class.js'),
	'jsTemplate' => array('datosUsuario.js'),
	'capa' => LAYOUT_DEFECTO);
	
$conf['admonUsuarios'] = array(
	'controlador' => 'usuarios.php',
	'vista' => 'usuarios/panel.tpl',
	'descripcion' => 'Administración de usuarios',
	'seguridad' => true,
	'js' => array('usuario.class.js'),
	'jsTemplate' => array('usuarios.js'),
	'capa' => LAYOUT_DEFECTO);
	
$conf['panelPrincipal'] = array(
	#'controlador' => 'index.php',
	'vista' => 'inicio.tpl',
	'descripcion' => 'Vista del panel',
	'seguridad' => true,
	'js' => array(),
	'capa' => LAYOUT_DEFECTO);

#Sucursales
$conf['sucursales'] = array(
	'controlador' => 'sucursales.php',
	'vista' => 'sucursales/panel.tpl',
	'descripcion' => 'Administración de sucursales',
	'seguridad' => true,
	'js' => array('sucursal.class.js'),
	'jsTemplate' => array('sucursales.js'),
	'perfiles' => array(1),
	'capa' => LAYOUT_DEFECTO);

$conf['listaSucursales'] = array(
	'controlador' => 'sucursales.php',
	'vista' => 'sucursales/lista.tpl',
	'descripcion' => 'Lista de sucursales',
	'seguridad' => true,
	'capa' => LAYOUT_AJAX);
	
$conf['csucursales'] = array(
	'controlador' => 'sucursales.php',
	'descripcion' => 'Controlador de sucursales',
	'seguridad' => true,
	'capa' => LAYOUT_AJAX);

#Areas de produccion
$conf['areas'] = array(
	'controlador' => 'areas.php',
	'vista' => 'areas/panel.tpl',
	'descripcion' => 'Administración de areas de produccion',
	'seguridad' => true,
	'js' => array('area.class.js'),
	'jsTemplate' => array('areas.js'),
	'perfiles' => array(1),
	'capa' => LAYOUT_DEFECTO);

$conf['listaAreas'] = array(
	'controlador' => 'areas.php',
	'vista' => 'areas/lista.tpl',
	'descripcion' => 'Lista de areas',
	'seguridad' => true,
	'capa' => LAYOUT_AJAX);
	
$conf['careas'] = array(
	'controlador' => 'areas.php',
	'descripcion' => 'Controlador de areas',
	'seguridad' => true,
	'capa' => LAYOUT_AJAX);
	
/* Estados */
$conf['estados'] = array(
	'controlador' => 'estados.php',
	'vista' => 'estados/panel.tpl',
	'descripcion' => 'Estado de los pedidos',
	'seguridad' => true,
	'js' => array('estado.class.js'),
	'jsTemplate' => array('estados.js'),
	'perfiles' => array(1),
	'capa' => LAYOUT_DEFECTO);
	
$conf['listadoEstados'] = array(
	'controlador' => 'estados.php',
	'vista' => 'estados/lista.tpl',
	'descripcion' => 'Lista de estados para los pedidos',
	'seguridad' => true,
	'capa' => LAYOUT_AJAX);

$conf['cestados'] = array(
	'controlador' => 'estados.php',
	'descripcion' => 'Controlador de estados',
	'seguridad' => true,
	'capa' => LAYOUT_AJAX);
	
/* Vendedor */
$conf['vendedores'] = array(
	'controlador' => 'vendedores.php',
	'vista' => 'vendedores/panel.tpl',
	'descripcion' => 'Vendedores',
	'seguridad' => true,
	'js' => array('vendedor.class.js'),
	'jsTemplate' => array('vendedores.js'),
	'perfiles' => array(1),
	'capa' => LAYOUT_DEFECTO);
	
$conf['listaVendedores'] = array(
	'controlador' => 'vendedores.php',
	'vista' => 'vendedores/lista.tpl',
	'descripcion' => 'Lista de vendedores',
	'seguridad' => true,
	'capa' => LAYOUT_AJAX);

$conf['cvendedores'] = array(
	'controlador' => 'vendedores.php',
	'descripcion' => 'Controlador de vendedores',
	'seguridad' => true,
	'capa' => LAYOUT_AJAX);
	
/* Ordenes */
$conf['importar'] = array(
	'controlador' => 'ordenes.php',
	'vista' => 'ordenes/importar.tpl',
	'descripcion' => 'panel de importación de datos',
	'seguridad' => true,
	'js' => array('orden.class.js'),
	'jsTemplate' => array('importar.js'),
	'perfiles' => array(1),
	'capa' => LAYOUT_DEFECTO);
	
$conf['cordenes'] = array(
	'controlador' => 'ordenes.php',
	'descripcion' => 'Controlador de ordenes de servicio',
	'seguridad' => true,
	'capa' => LAYOUT_AJAX);
	
$conf['listaImportar'] = array(
	'controlador' => 'ordenes.php',
	'vista' => 'ordenes/listaImportar.tpl',
	'descripcion' => 'Lista de vendedores',
	'seguridad' => true,
	'capa' => LAYOUT_AJAX);
	
/* Lista ordenes admin */
$conf['listaOrdenesAdmin'] = array(
	'controlador' => 'ordenes.php',
	'vista' => 'ordenes/panelAdmin.tpl',
	'descripcion' => 'Ordenes',
	'seguridad' => true,
	'js' => array('orden.class.js', "movimiento.class.js"),
	'jsTemplate' => array('ordenesAdmin.js'),
	'capa' => LAYOUT_DEFECTO);
	
$conf['listaOrdenes'] = array(
	'controlador' => 'ordenes.php',
	'vista' => 'ordenes/lista.tpl',
	'descripcion' => 'Lista de ordenes',
	'seguridad' => true,
	'capa' => LAYOUT_AJAX);

$conf['cordenes'] = array(
	'controlador' => 'ordenes.php',
	'descripcion' => 'Controlador de ordenes',
	'seguridad' => true,
	'capa' => LAYOUT_AJAX);
	
$conf['detalleOrden'] = array(
	'controlador' => 'ordenes.php',
	'vista' => 'ordenes/orden.tpl',
	'descripcion' => 'Detalle de la orden',
	'seguridad' => true,
	'capa' => LAYOUT_AJAX);
	
$conf['cmovimientos'] = array(
	'controlador' => 'movimientos.php',
	'descripcion' => 'Controlador de movimientos',
	'seguridad' => true,
	'capa' => LAYOUT_AJAX);
	
$conf['archivosorden'] = array(
	'controlador' => 'ordenes.php',
	'vista' => 'ordenes/archivos.tpl',
	'descripcion' => 'Ordenes',
	'seguridad' => true,
	#'js' => array('orden.class.js', "movimiento.class.js"),
	'jsTemplate' => array('archivos.js'),
	'capa' => LAYOUT_TOPNAV);
	
$conf['listaArchivos'] = array(
	'controlador' => 'movimientos.php',
	'vista' => 'ordenes/listaArchivos.tpl',
	'descripcion' => 'Lista de archivos',
	'seguridad' => true,
	'capa' => LAYOUT_AJAX);

//Reportes
$conf['reporte'] = array(
	'controlador' => 'reportes.php',
	'vista' => 'reportes/panel.tpl',
	'descripcion' => 'Ordenes',
	'seguridad' => true,
	#'js' => array('orden.class.js', "movimiento.class.js"),
	'jsTemplate' => array('reportes.js'),
	'capa' => LAYOUT_DEFECTO);
	
$conf['creportes'] = array(
	'controlador' => 'reportes.php',
	'descripcion' => 'Controlador de reportes',
	'seguridad' => true,
	'capa' => LAYOUT_AJAX);
	
$conf['listaOrdenesReportes'] = array(
	'controlador' => 'reportes.php',
	'vista' => 'reportes/lista.tpl',
	'descripcion' => 'Lista de ordenes en reportes',
	'seguridad' => true,
	'capa' => LAYOUT_AJAX);