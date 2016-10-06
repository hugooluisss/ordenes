<?php /* Smarty version Smarty-3.1.11, created on 2016-10-06 11:10:49
         compiled from "templates/plantillas/modulos/ordenes/listaImportar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13987328157f67789e39e05-34475827%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd4507485fcf0b5940a3632544bf5826d975ab422' => 
    array (
      0 => 'templates/plantillas/modulos/ordenes/listaImportar.tpl',
      1 => 1475160063,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13987328157f67789e39e05-34475827',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'listaJson' => 0,
    'error' => 0,
    'folios' => 0,
    'lista' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57f67789ea7071_53001417',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57f67789ea7071_53001417')) {function content_57f67789ea7071_53001417($_smarty_tpl) {?><hr />
<div class="row">
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
		</tr>
	</thead>
	<tbody>
		<?php  $_smarty_tpl->tpl_vars["row"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["row"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['lista']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["row"]->key => $_smarty_tpl->tpl_vars["row"]->value){
$_smarty_tpl->tpl_vars["row"]->_loop = true;
?>
			<tr>
				<td class="text-center" style="<?php if (!($_smarty_tpl->tpl_vars['row']->value['areaExiste']&&$_smarty_tpl->tpl_vars['row']->value['vendedorExiste']&&$_smarty_tpl->tpl_vars['row']->value['sucursalExiste']&&$_smarty_tpl->tpl_vars['row']->value['ordenExiste'])){?>border-left: 1px solid red; color: red;<?php }else{ ?>color: green;<?php }?>">
					<?php if ($_smarty_tpl->tpl_vars['row']->value['areaExiste']&&$_smarty_tpl->tpl_vars['row']->value['vendedorExiste']&&$_smarty_tpl->tpl_vars['row']->value['sucursalExiste']&&$_smarty_tpl->tpl_vars['row']->value['ordenExiste']){?>
						<i class="fa fa-check" aria-hidden="true"></i>
					<?php }else{ ?>
						<i class="fa fa-times" aria-hidden="true"></i>
					<?php }?>
				</td>
				<td style="<?php if (!$_smarty_tpl->tpl_vars['row']->value['ordenExiste']){?>color: red;<?php }?>" <?php if (!$_smarty_tpl->tpl_vars['row']->value['ordenExiste']){?>title="La orden ya está registrada o se encuentra dentro de un rango ya importado en esta razón social"<?php }?>><?php echo $_smarty_tpl->tpl_vars['row']->value['codigo'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['cliente'];?>
</td>
				<td style="<?php if (!$_smarty_tpl->tpl_vars['row']->value['vendedorExiste']){?>color: red;<?php }?>" <?php if (!$_smarty_tpl->tpl_vars['row']->value['vendedorExiste']){?>title="El vendedor no está registrado en el sistema"<?php }?>><?php echo $_smarty_tpl->tpl_vars['row']->value['vendedor'];?>
</td>
				<td style="<?php if (!$_smarty_tpl->tpl_vars['row']->value['sucursalExiste']){?>color: red;<?php }?>" <?php if (!$_smarty_tpl->tpl_vars['row']->value['sucursalExiste']){?>title="La sucursal no existe o no pertenece a la razón social seleccionada para importar"<?php }?>><?php echo $_smarty_tpl->tpl_vars['row']->value['sucursal'];?>
</td>
				<td style="<?php if (!$_smarty_tpl->tpl_vars['row']->value['areaExiste']){?>color: red;<?php }?>" <?php if (!$_smarty_tpl->tpl_vars['row']->value['areaExiste']){?>title="Esta área no se encuentra registrada en el sistema"<?php }?>><?php echo $_smarty_tpl->tpl_vars['row']->value['area'];?>
</td>
			</tr>
		<?php } ?>
	</tbody>
</table><?php }} ?>