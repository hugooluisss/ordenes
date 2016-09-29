<?php /* Smarty version Smarty-3.1.11, created on 2016-09-29 13:44:28
         compiled from "templates/plantillas/modulos/ordenes/orden.tpl" */ ?>
<?php /*%%SmartyHeaderCode:37653668957ed5428b69e99-41372028%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4ad22c36e315fd478176ee260b73945a2f61c17e' => 
    array (
      0 => 'templates/plantillas/modulos/ordenes/orden.tpl',
      1 => 1475174666,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '37653668957ed5428b69e99-41372028',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57ed5428b8a3f6_58135594',
  'variables' => 
  array (
    'orden' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57ed5428b8a3f6_58135594')) {function content_57ed5428b8a3f6_58135594($_smarty_tpl) {?><div class="row" style="margin-left: 10px;"> <!--style="border: 1px solid #3c8dbc; margin: 5px auto;" -->
	<div class="col-xs-2 text-center" style="color: <?php echo $_smarty_tpl->tpl_vars['orden']->value->sucursal->getColor();?>
; background: #ecf0f5;">
		<i class="fa fa-tag fa-5x" aria-hidden="true"></i>
		<br />
		<?php echo $_smarty_tpl->tpl_vars['orden']->value->sucursal->getnombre();?>

	</div>
	<div class="col-xs-10">
		<h1 style="color: #3c8dbc">Orden de servicio</h1>
	</div>
</div>
<hr />
<div class="row">
	<div class="col-md-2">
		<b>Código</b>
	</div>
	<div class="col-md-2">
		<input class="form-control text-right" value="<?php echo $_smarty_tpl->tpl_vars['orden']->value->getCodigo();?>
" readonly disabled />
	</div>
	<div class="col-md-2">
		<b>Id Vendedor</b>
	</div>
	<div class="col-md-2">
		<input class="form-control text-right" value="<?php echo $_smarty_tpl->tpl_vars['orden']->value->vendedor->getClave();?>
" readonly disabled />
	</div>
	<div class="col-md-2">
		<b>Fecha y hora</b>
	</div>
	<div class="col-md-2">
		<input class="form-control text-right" value="<?php echo $_smarty_tpl->tpl_vars['orden']->value->getRegistro();?>
" readonly disabled />
	</div>
</div>
<br />
<div class="row">
	<div class="col-md-2">
		<b>Cliente</b>
	</div>
	<div class="col-md-10">
		<input class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['orden']->value->getCliente();?>
" readonly disabled />
	</div>
</div>
<br />
<div class="row">
	<div class="col-md-12">
		<table id="tblDatos" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>Clave</th>
					<th>Descripción</th>
					<th>Importe</th>
					<th>Área</th>
				</tr>
			</thead>
			<tbody>
				<?php  $_smarty_tpl->tpl_vars["row"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["row"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['orden']->value->movimientos; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["row"]->key => $_smarty_tpl->tpl_vars["row"]->value){
$_smarty_tpl->tpl_vars["row"]->_loop = true;
?>
				<tr
					clave="<?php echo $_smarty_tpl->tpl_vars['row']->value->getClave();?>
"
					descripcion="<?php echo $_smarty_tpl->tpl_vars['row']->value->getDescripcion();?>
"
					importe="<?php echo $_smarty_tpl->tpl_vars['row']->value->getImporte();?>
"
					area="<?php echo $_smarty_tpl->tpl_vars['row']->value->area->getNombre();?>
"
					cantidad="<?php echo $_smarty_tpl->tpl_vars['row']->value->getCantidad();?>
"
					elaboracion="<?php echo $_smarty_tpl->tpl_vars['orden']->value->getElaboracion();?>
"
					observaciones="<?php echo $_smarty_tpl->tpl_vars['row']->value->getObservaciones();?>
"
				>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value->getClave();?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value->getDescripcion();?>
</td>
					<td class="text-right"><?php echo $_smarty_tpl->tpl_vars['row']->value->getImporte();?>
</td>
					<td class="text-center"><?php echo $_smarty_tpl->tpl_vars['row']->value->area->getNombre();?>
</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<br />

<div class="row">
	<div class="col-md-2">
		<b>Área de producción</b>
	</div>
	<div class="col-md-2">
		<input class="form-control text-right" value="" readonly disabled campo="area"/>
	</div>
	<div class="col-md-2">
		<b>Clave del artículo</b>
	</div>
	<div class="col-md-2">
		<input class="form-control text-right" value="" readonly disabled campo="clave"/>
	</div>
	<div class="col-md-2">
		<b>Fecha elaboración
	</div>
	<div class="col-md-2">
		<input class="form-control text-right" value="" readonly disabled campo="elaboracion"/>
	</div>
</div>
<br />
<div class="row">
	<div class="col-md-2">
		<b>Cantidad</b>
	</div>
	<div class="col-md-2">
		<input class="form-control text-right" value="" readonly disabled campo="cantidad"/>
	</div>
	<div class="col-md-2">
		<b>Descripción</b>
	</div>
	<div class="col-md-6">
		<input class="form-control" value="" readonly disabled campo="descripcion"/>
	</div>
</div>
<br />
<div class="row">
	<div class="col-md-2">
		<b>Observaciones</b>
	</div>
	<div class="col-md-4">
		<input class="form-control" value="" readonly disabled campo="observaciones"/>
	</div>
</div><?php }} ?>