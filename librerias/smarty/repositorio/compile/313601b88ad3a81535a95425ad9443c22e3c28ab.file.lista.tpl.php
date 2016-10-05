<?php /* Smarty version Smarty-3.1.11, created on 2016-10-05 11:14:11
         compiled from "templates/plantillas/modulos/reportes/lista.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28298202657f52482aee672-89143731%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '313601b88ad3a81535a95425ad9443c22e3c28ab' => 
    array (
      0 => 'templates/plantillas/modulos/reportes/lista.tpl',
      1 => 1475684044,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28298202657f52482aee672-89143731',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57f52482b1f291_71523281',
  'variables' => 
  array (
    'lista' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57f52482b1f291_71523281')) {function content_57f52482b1f291_71523281($_smarty_tpl) {?><div class="box">
	<div class="box-body">
		<table id="tblDatos" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>Código</th>
					<th>Cliente</th>
					<th>Vendedor</th>
					<th>Sucursal</th>
					<th>Fecha</th>
					<th>Estado</th>
				</tr>
			</thead>
			<tbody>
				<?php  $_smarty_tpl->tpl_vars["row"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["row"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['lista']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["row"]->key => $_smarty_tpl->tpl_vars["row"]->value){
$_smarty_tpl->tpl_vars["row"]->_loop = true;
?>
					<tr>
						<td style="border-left: 3px solid <?php echo $_smarty_tpl->tpl_vars['row']->value['colorEstado'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['codigo'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['row']->value['cliente'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['row']->value['vendedor'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['row']->value['sucursal'];?>
</td>
						<td <?php if ($_smarty_tpl->tpl_vars['row']->value['actual']==1){?>class="text-danger"<?php }?>><?php echo $_smarty_tpl->tpl_vars['row']->value['registro'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['row']->value['estado'];?>
</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div><?php }} ?>