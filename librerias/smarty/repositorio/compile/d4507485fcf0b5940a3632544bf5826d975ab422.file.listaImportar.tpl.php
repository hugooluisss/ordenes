<?php /* Smarty version Smarty-3.1.11, created on 2016-09-28 12:17:21
         compiled from "templates/plantillas/modulos/ordenes/listaImportar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:175144345757ebf40f071490-25179971%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd4507485fcf0b5940a3632544bf5826d975ab422' => 
    array (
      0 => 'templates/plantillas/modulos/ordenes/listaImportar.tpl',
      1 => 1475083025,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '175144345757ebf40f071490-25179971',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57ebf40f19b073_65030565',
  'variables' => 
  array (
    'lista' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57ebf40f19b073_65030565')) {function content_57ebf40f19b073_65030565($_smarty_tpl) {?><div class="row">
	<div class="col-md-12">
		<div class="btn-group">
			<button type="button" class="btn btn-success" action="seleccionar">Seleccionar</button>
			<button type="button" class="btn btn-success" action="desseleccionar">Limpiar selección</button>
			<button type="button" class="btn btn-danger"  action="importar">Importar al sistema</button>
		</div>
	</div>
</div>

<table id="tblDatos" class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th>Código</th>
			<th>Cantidad</th>
			<th>Artículo</th>
			<th>Descripción</th>
			<th>Observaciones</th>
			<th>Cliente</th>
			<th>Vendedor</th>
			<th>Elaboró</th>
			<th>Importe</th>
			<th>Sucursal</th>
			<th>Área</th>
		</tr>
	</thead>
	<tbody>
		<?php  $_smarty_tpl->tpl_vars["row"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["row"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['lista']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["row"]->key => $_smarty_tpl->tpl_vars["row"]->value){
$_smarty_tpl->tpl_vars["row"]->_loop = true;
?>
			<tr>
				<td class="text-center" style="<?php if (!($_smarty_tpl->tpl_vars['row']->value['areaExiste']&&$_smarty_tpl->tpl_vars['row']->value['vendedorExiste'])){?>border-left: 1px solid red;<?php }?>">
					<?php if ($_smarty_tpl->tpl_vars['row']->value['areaExiste']&&$_smarty_tpl->tpl_vars['row']->value['vendedorExiste']){?>
						<input type="checkbox" datos='<?php echo $_smarty_tpl->tpl_vars['row']->value['json'];?>
' />
					<?php }?>
				</td>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['codigo'];?>
</td>
				<td class="text-right"><?php echo $_smarty_tpl->tpl_vars['row']->value['cantidad'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['cveart'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['desart'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['obsart'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['cliente'];?>
</td>
				<td style="<?php if (!$_smarty_tpl->tpl_vars['row']->value['vendedorExiste']){?>color: red;<?php }?>"><?php echo $_smarty_tpl->tpl_vars['row']->value['vendedor'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['elaborado'];?>
</td>
				<td class="text-right"><?php echo $_smarty_tpl->tpl_vars['row']->value['importe'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['sucursal'];?>
</td>
				<td style="<?php if (!$_smarty_tpl->tpl_vars['row']->value['areaExiste']){?>color: red;<?php }?>"><?php echo $_smarty_tpl->tpl_vars['row']->value['area'];?>
</td>
			</tr>
		<?php } ?>
	</tbody>
</table><?php }} ?>