<?php /* Smarty version Smarty-3.1.11, created on 2017-02-17 13:07:47
         compiled from "templates/plantillas/modulos/ordenes/listaImportarAuto.tpl" */ ?>
<?php /*%%SmartyHeaderCode:139347047058a747c0c1d2e0-72390832%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1c41d9346c656f43de7d0e2777c9ca9bee2e68a7' => 
    array (
      0 => 'templates/plantillas/modulos/ordenes/listaImportarAuto.tpl',
      1 => 1487358420,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '139347047058a747c0c1d2e0-72390832',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_58a747c0d7dab1_40146514',
  'variables' => 
  array (
    'listaJson' => 0,
    'error' => 0,
    'folios' => 0,
    'PAGE' => 0,
    'ordenes' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58a747c0d7dab1_40146514')) {function content_58a747c0d7dab1_40146514($_smarty_tpl) {?><hr />
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
			<?php if ($_smarty_tpl->tpl_vars['PAGE']->value['usuario']->getIdTipo()==1){?>
				<th>&nbsp;</th>
			<?php }?>
		</tr>
	</thead>
	<tbody>
		<?php  $_smarty_tpl->tpl_vars["row"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["row"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ordenes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["row"]->key => $_smarty_tpl->tpl_vars["row"]->value){
$_smarty_tpl->tpl_vars["row"]->_loop = true;
?>
			<tr>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value->CVE_DOC;?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value->CODIGO;?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value->NOMBRE_DEL_CLIENTE;?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value->CLAVE_VENDEDOR;?>
</td>
				<td></td>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value->AREA_DE_PRODUCCION;?>
</td>
				<td></td>
			</tr>
		<?php } ?>
	</tbody>
</table><?php }} ?>