<?php /* Smarty version Smarty-3.1.11, created on 2016-09-30 10:55:45
         compiled from "templates/plantillas/modulos/ordenes/orden.tpl" */ ?>
<?php /*%%SmartyHeaderCode:37653668957ed5428b69e99-41372028%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4ad22c36e315fd478176ee260b73945a2f61c17e' => 
    array (
      0 => 'templates/plantillas/modulos/ordenes/orden.tpl',
      1 => 1475250862,
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
    'estados' => 0,
    'item' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57ed5428b8a3f6_58135594')) {function content_57ed5428b8a3f6_58135594($_smarty_tpl) {?><div class="row" style="margin-left: 10px;"> <!--style="border: 1px solid #3c8dbc; margin: 5px auto;" -->
	<div class="col-md-2 text-center" style="color: <?php echo $_smarty_tpl->tpl_vars['orden']->value->sucursal->getColor();?>
; background: #ecf0f5;">
		<i class="fa fa-tag fa-5x" aria-hidden="true"></i>
		<br />
		<?php echo $_smarty_tpl->tpl_vars['orden']->value->sucursal->getnombre();?>

	</div>
	<div class="col-md-6">
		<h1 style="color: #3c8dbc">Orden de servicio</h1>
	</div>
	<div class="col-md-4">
		<b>Estado</b><br /><br />
		<select id="selEstadoOrden" name="selEstadoOrden" class="form-control">
			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['estados']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
				<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['idEstado'];?>
" <?php if ($_smarty_tpl->tpl_vars['orden']->value->estado->getId()==$_smarty_tpl->tpl_vars['item']->value['idEstado']){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['nombre'];?>
</option>
			<?php } ?>
		</select>
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
	<div class="col-md-2 col-md-offset-3">
		<b>Fecha y hora</b>
	</div>
	<div class="col-md-3">
		<input class="form-control text-right" value="<?php echo $_smarty_tpl->tpl_vars['orden']->value->getRegistro();?>
" readonly disabled />
	</div>
</div>
<br />
<div class="row">
	<div class="col-md-2">
		<b>Id Vendedor</b>
	</div>
	<div class="col-md-2">
		<input class="form-control text-right" value="<?php echo $_smarty_tpl->tpl_vars['orden']->value->vendedor->getClave();?>
" readonly disabled />
	</div>
	<div class="col-md-2">
		<b>Nombre</b>
	</div>
	<div class="col-md-6">
		<input class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['orden']->value->vendedor->getNombre();?>
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
					<th>Fecha</th>
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
					<td><?php echo $_smarty_tpl->tpl_vars['row']->value->getFecha();?>
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
	<!--
	<div class="col-md-2">
		<b>Fecha elaboración
	</div>
	<div class="col-md-2">
		<input class="form-control text-right" value="" readonly disabled campo="elaboracion"/>
	</div>
	-->
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
	<div class="col-md-6">
		<input class="form-control" value="" readonly disabled campo="observaciones"/>
	</div>
</div>

<hr />
<div class="row">
	<div class="col-md-2">
		<b>Notas sucursales</b>
	</div>
	<div class="col-md-10">
		<textarea campo="notasSucursales" class="form-control" id="txtNotasSucursales"></textarea>
	</div>
</div>
<hr />
<div class="row">
	<div class="col-md-8">
		<div class="row">
			<div class="col-md-3">
				<b>Observaciones</b>
			</div>
			<div class="col-md-4">
				<input class="form-control text-right" value="" campo="notas" id="txtNotas"/>
			</div>
			<div class="col-md-2">
				<b>Impresion</b>
			</div>
			<div class="col-md-3">
				<input class="form-control" value="" campo="fechaImpresion" id="txtFechaImpresion"/>
			</div>
		</div>
		<br />
		<div class="row">
			<div class="col-md-4 col-md-offset-2">
						<input type="checkbox" id="envio"> <b>Envio</b>
			</div>
			<div class="col-md-3">
				<b>Fecha y hora</b>
			</div>
			<div class="col-md-3">
				<input class="form-control" value="" readonly disabled campo="fechaHora" id="txtFechaHora"/>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<b>Notas de produccion</b>
		<textarea campo="notasProduccion" class="form-control" rows="4"></textarea>
	</div>
</div>
<hr /><?php }} ?>