<?php /* Smarty version Smarty-3.1.11, created on 2016-10-12 11:46:39
         compiled from "templates/plantillas/modulos/ordenes/listaArchivos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:33207867457f273279ef684-21095439%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'de303f0b8a2335d85f2d4d63a583504d10598431' => 
    array (
      0 => 'templates/plantillas/modulos/ordenes/listaArchivos.tpl',
      1 => 1476290791,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '33207867457f273279ef684-21095439',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57f27327a80c06_17668884',
  'variables' => 
  array (
    'lista' => 0,
    'row' => 0,
    'PAGE' => 0,
    'orden' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57f27327a80c06_17668884')) {function content_57f27327a80c06_17668884($_smarty_tpl) {?><table id="tblDatos" class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Tamaño</th>
			<th>Fecha FTP</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php  $_smarty_tpl->tpl_vars["row"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["row"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['lista']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["row"]->key => $_smarty_tpl->tpl_vars["row"]->value){
$_smarty_tpl->tpl_vars["row"]->_loop = true;
?>
			<tr>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['nombre'];?>
</td>
				<td class="text-right"><?php echo $_smarty_tpl->tpl_vars['row']->value['tamano'];?>
</td>
				<td class="text-right"><?php echo $_smarty_tpl->tpl_vars['row']->value['creacion'];?>
</td>
				<td class="text-right">
					<a class="btn btn-default" href="<?php echo $_smarty_tpl->tpl_vars['row']->value['ruta'];?>
" download="<?php echo $_smarty_tpl->tpl_vars['row']->value['nombre'];?>
"> <i class="fa fa-search"></i></a>
					<?php if ($_smarty_tpl->tpl_vars['PAGE']->value['usuario']->getIdTipo()==2&&$_smarty_tpl->tpl_vars['orden']->value->estado->getId()!=2){?>
						<button type="button" class="btn btn-danger" action="borrar" title="Eliminar" datos='<?php echo $_smarty_tpl->tpl_vars['row']->value['json'];?>
'><i class="fa fa-times"></i></button>
					<?php }?>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table><?php }} ?>