<?php /* Smarty version Smarty-3.1.11, created on 2017-02-09 21:07:53
         compiled from "templates/plantillas/modulos/reportes/entrega/panel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2128307714589d2b80d0cbe4-64437177%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0144dc62e26f07089d7ee3d943692124979281a6' => 
    array (
      0 => 'templates/plantillas/modulos/reportes/entrega/panel.tpl',
      1 => 1486696072,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2128307714589d2b80d0cbe4-64437177',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_589d2b80d62f50_10095654',
  'variables' => 
  array (
    'sucursales' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_589d2b80d62f50_10095654')) {function content_589d2b80d62f50_10095654($_smarty_tpl) {?><div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Ordenes</h1>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-body">
		<form role="form" id="frmBuscar" class="form-horizontal" onsubmit="javascript: return false;">
			<div class="form-group">
				<label for="selSucursal" class="col-lg-2">Sucursal</label>
				<div class="col-lg-3">
					<select class="form-control" id="selSucursal" name="selSucursal">
						<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sucursales']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
							<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['idSucursal'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['nombre'];?>
</option>
						<?php } ?>
					</select>
				</div>
				<label for="chkAntiguas" class="col-lg-2">Ordenes viejas</label>
				<input type="checkbox" id="chkAntiguas"/>
			</div>
			<div class="form-group">
				<label for="selSucursal" class="col-lg-2">Estado entrega</label>
				<div class="col-lg-3">
					<select class="form-control" id="selEntrega" name="selEntrega">
						<option value="0">Sin entregar</option>
						<option value="1">Entrega completa y en tiempo</option>
						<option value="2">Entrega incompleta y fuera de tiempo</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-info pull-right">Buscar</button>
				<input type="hidden" id="id"/>
			</div>
		</form>
	</div>
</div>

<div id="piechart" style="width: 100%; height: 500px;"></div>

<br />
<div class="well well-lg" id="listaOrdenes">
</div><?php }} ?>