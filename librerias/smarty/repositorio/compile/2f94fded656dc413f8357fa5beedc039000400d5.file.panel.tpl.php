<?php /* Smarty version Smarty-3.1.11, created on 2016-09-27 09:42:10
         compiled from "templates/plantillas/modulos/pedidos/panel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:174423460757ea85425a0600-35661533%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2f94fded656dc413f8357fa5beedc039000400d5' => 
    array (
      0 => 'templates/plantillas/modulos/pedidos/panel.tpl',
      1 => 1473964715,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '174423460757ea85425a0600-35661533',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'PAGE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57ea8542662ff5_20871330',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57ea8542662ff5_20871330')) {function content_57ea8542662ff5_20871330($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/Library/WebServer/Documents/gorillasglass/librerias/smarty/plugins/modifier.date_format.php';
?><div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Ventas</h1>
	</div>
</div>

<ul class="nav nav-tabs">
	<li class="active"><a data-toggle="tab" href="#lista">Lista</a></li>
	<li><a data-toggle="tab" href="#add">Agregar o modificar</a></li>
</ul>




<div class="tab-content">
	<div id="lista" class="tab-pane fade in active">
		<div id="dvLista"></div>
	</div>
	<div id="add" class="tab-pane fade" style="background: white">
		<form role="form" id="frmAdd" class="form-horizontal" onsubmit="javascript: return false;">
			<div class="form-group">
				<label for="txtFecha" class="col-sm-2 control-label">Fecha *</label>
				<div class="col-sm-2">
					<input type="text" id="txtFecha" name="txtFecha" autofocus="true" class="form-control" autocomplete="false" value="<?php echo smarty_modifier_date_format(time(),"Y-m-d");?>
" placeholder="Y-m-d"/>
					<div id="datepicker"></div>
				</div>
			</div>
			<div class="form-group">
				<label for="txtCliente" class="col-sm-2 control-label">Cliente *</label>
				<div class="col-sm-6">
					<input type="text" id="txtCliente" name="txtCliente" autofocus="true" class="form-control" autocomplete="false" disabled="true" />
				</div>
				<div class="col-sm-2">
					<button type="button" class="btn btn-default btn-block" id="btnBuscarClientes"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
				</div>
			</div>
			<button type="submit" class="btn btn-info pull-right">Guardar</button>
			<input type="hidden" id="id"/>
		</form>
		<br/><br/>
		<hr />
		<br/>
		<form role="form" id="frmAddProductos" class="form-horizontal" onsubmit="javascript: return false;">
			<div class="form-group">
				<label for="txtClave" class="col-sm-2 control-label">Producto</label>
				<div class="col-sm-2">
					<input type="text" id="txtClave" name="txtClave" autofocus="true" class="form-control" autocomplete="false" placeholder="clave"/>
				</div>
				<div class="col-sm-5">
					<input type="text" id="txtDescripcion" name="txtDescripcion" autofocus="true" class="form-control" autocomplete="false" placeholder="Descripción"/>
				</div>
				<div class="col-sm-3">
					<button type="button" class="btn btn-default btn-block" id="btnBuscarProductos"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
				</div>
			</div>
			<div class="form-group">
				<label for="txtCantidad" class="col-sm-2 control-label">Cantidad</label>
				<div class="col-sm-2">
					<input type="text" id="txtCantidad" name="txtCantidad" autofocus="true" class="form-control" autocomplete="false" placeholder="Cantidad"/>
				</div>
				<label for="txtCantidad" class="col-sm-offset-2 col-sm-2 control-label">Precio Unitario</label>
				<div class="col-sm-2">
					<input type="text" id="txtPrecio" name="txtPrecio" autofocus="true" class="form-control text-right" autocomplete="false" placeholder="Precio"/>
				</div>
				<div class="col-sm-1 text-right">
					<button type="submit" id="btnReset" class="btn btn-default"><i class="fa fa-plus" aria-hidden="true"></i></button>
				</div>
			</div>
		</form>
		<br/><br/>
		<hr />
		<br/>
		<div id="lstMovimiento"></div>
	</div>
</div>


<?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['PAGE']->value['rutaModulos']).("modulos/pedidos/winClientes.tpl"), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['PAGE']->value['rutaModulos']).("modulos/pedidos/winProductos.tpl"), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>