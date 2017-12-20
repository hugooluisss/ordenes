<?php /* Smarty version Smarty-3.1.11, created on 2017-12-09 15:15:51
         compiled from "templates/plantillas/modulos/ordenes/listaImportar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19863880055a258ca6728cc4-10889341%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd4507485fcf0b5940a3632544bf5826d975ab422' => 
    array (
      0 => 'templates/plantillas/modulos/ordenes/listaImportar.tpl',
      1 => 1512854144,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19863880055a258ca6728cc4-10889341',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5a258ca6887cc1_13742372',
  'variables' => 
  array (
    'listaJson' => 0,
    'error' => 0,
    'folios' => 0,
    'PAGE' => 0,
    'lista' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a258ca6887cc1_13742372')) {function content_5a258ca6887cc1_13742372($_smarty_tpl) {?><div class="row">
	<div class="col-md-4">
		<div class="btn-group">
			<button type="button" class="btn btn-success" action="importar" datos='<?php echo $_smarty_tpl->tpl_vars['listaJson']->value;?>
' <?php if (!$_smarty_tpl->tpl_vars['error']->value){?>disabled=true<?php }?> inicio="<?php echo $_smarty_tpl->tpl_vars['folios']->value['inicio'];?>
" fin="<?php echo $_smarty_tpl->tpl_vars['folios']->value['fin'];?>
">Importar al sistema</button>
		</div>
	</div>
	<div class="col-md-8">
		<?php if (!$_smarty_tpl->tpl_vars['error']->value){?>
			<div class="alert alert-danger">
				<strong>Error</strong> Hay elementos que no pueden ser importados, revisa la lista
			</div>
		<?php }else{ ?>
			<div class="alert alert-warning">
				<strong>Listo...</strong> ODT's del <b><?php echo $_smarty_tpl->tpl_vars['folios']->value['inicio'];?>
</b> al <b><?php echo $_smarty_tpl->tpl_vars['folios']->value['fin'];?>
</b>
			</div>
		<?php }?>
	</div>
</div>

<table id="tblDatos" class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th>Código</th>
			<th>Cliente</th>
			<th>Vendedor</th>
			<th>Sucursal</th>
			<th>Área</th>
			<?php if ($_smarty_tpl->tpl_vars['PAGE']->value['usuario']->getIdTipo()==1){?>
				<th>&nbsp;</th>
			<?php }?>
		</tr>
	</thead>
	<tbody>
		<?php  $_smarty_tpl->tpl_vars["row"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["row"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['lista']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["row"]->key => $_smarty_tpl->tpl_vars["row"]->value){
$_smarty_tpl->tpl_vars["row"]->_loop = true;
?>
			<tr>
				<td class="text-center" style="<?php if (!($_smarty_tpl->tpl_vars['row']->value['areaExiste']&&$_smarty_tpl->tpl_vars['row']->value['vendedorExiste']&&$_smarty_tpl->tpl_vars['row']->value['sucursalExiste']&&!$_smarty_tpl->tpl_vars['row']->value['ordenExiste'])){?>border-left: 1px solid red; color: red;<?php }else{ ?>color: green;<?php }?>">
					<?php if ($_smarty_tpl->tpl_vars['row']->value['areaExiste']&&$_smarty_tpl->tpl_vars['row']->value['vendedorExiste']&&$_smarty_tpl->tpl_vars['row']->value['sucursalExiste']&&!$_smarty_tpl->tpl_vars['row']->value['ordenExiste']){?>
						<i class="fa fa-check" aria-hidden="true"></i>
					<?php }else{ ?>
						<i class="fa fa-times" aria-hidden="true"></i>
					<?php }?>
				</td>
				<td style="<?php if ($_smarty_tpl->tpl_vars['row']->value['ordenExiste']||!$_smarty_tpl->tpl_vars['row']->value['codigoDuplicado']){?>color: red;<?php }?>" <?php if ($_smarty_tpl->tpl_vars['row']->value['ordenExiste']){?>title="La orden ya está registrada o se encuentra dentro de un rango ya importado en esta razón social"<?php }?> <?php if (!$_smarty_tpl->tpl_vars['row']->value['codigoDuplicado']){?>title="Esta ya fue importada con el mismo código, no se puede importar"<?php }?>><?php echo $_smarty_tpl->tpl_vars['row']->value['codigo'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['cliente'];?>
</td>
				<td style="<?php if (!$_smarty_tpl->tpl_vars['row']->value['vendedorExiste']){?>color: red;<?php }?>" <?php if (!$_smarty_tpl->tpl_vars['row']->value['vendedorExiste']){?>title="El vendedor no está registrado en el sistema"<?php }?>><?php echo $_smarty_tpl->tpl_vars['row']->value['vendedor'];?>
</td>
				<td style="<?php if (!$_smarty_tpl->tpl_vars['row']->value['sucursalExiste']){?>color: red;<?php }?>" <?php if (!$_smarty_tpl->tpl_vars['row']->value['sucursalExiste']){?>title="La sucursal no existe o no pertenece a la razón social seleccionada para importar"<?php }?>><?php echo $_smarty_tpl->tpl_vars['row']->value['sucursal'];?>
</td>
				<td style="<?php if (!$_smarty_tpl->tpl_vars['row']->value['areaExiste']){?>color: red;<?php }?>" <?php if (!$_smarty_tpl->tpl_vars['row']->value['areaExiste']){?>title="Esta área no se encuentra registrada en el sistema"<?php }?>><?php echo $_smarty_tpl->tpl_vars['row']->value['area'];?>
</td>
				<?php if ($_smarty_tpl->tpl_vars['PAGE']->value['usuario']->getIdTipo()==1){?>
				<td>
					<?php if ($_smarty_tpl->tpl_vars['row']->value['codigoDuplicado']){?>
					<button class="btn btn-warning" data='<?php echo $_smarty_tpl->tpl_vars['row']->value['json'];?>
' inicio="<?php echo $_smarty_tpl->tpl_vars['folios']->value['inicio'];?>
" fin="<?php echo $_smarty_tpl->tpl_vars['folios']->value['fin'];?>
">Importar</button>
					<?php }?>
				</td>
				<?php }?>
			</tr>
		<?php } ?>
	</tbody>
</table><?php }} ?>