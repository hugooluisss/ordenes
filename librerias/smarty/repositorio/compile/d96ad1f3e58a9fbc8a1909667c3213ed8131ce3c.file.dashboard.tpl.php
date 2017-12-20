<?php /* Smarty version Smarty-3.1.11, created on 2017-12-20 13:00:46
         compiled from "templates/plantillas/modulos/ordenes/dashboard.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1000290995591f20d0a989d5-65142044%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd96ad1f3e58a9fbc8a1909667c3213ed8131ce3c' => 
    array (
      0 => 'templates/plantillas/modulos/ordenes/dashboard.tpl',
      1 => 1513796445,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1000290995591f20d0a989d5-65142044',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_591f20d0a99c54_38032813',
  'variables' => 
  array (
    'empresas' => 0,
    'row' => 0,
    'imp' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_591f20d0a99c54_38032813')) {function content_591f20d0a99c54_38032813($_smarty_tpl) {?><div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Dashboard importación</h1>
	</div>
</div>


<ul id="panelTabs" class="nav nav-tabs">
	<?php  $_smarty_tpl->tpl_vars["row"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["row"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['empresas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["row"]->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars["row"]->key => $_smarty_tpl->tpl_vars["row"]->value){
$_smarty_tpl->tpl_vars["row"]->_loop = true;
 $_smarty_tpl->tpl_vars["row"]->index++;
 $_smarty_tpl->tpl_vars["row"]->first = $_smarty_tpl->tpl_vars["row"]->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["empresas"]['first'] = $_smarty_tpl->tpl_vars["row"]->first;
?>
	<li <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['empresas']['first']){?>class="active"<?php }?>><a data-toggle="tab" href="#empresa<?php echo $_smarty_tpl->tpl_vars['row']->value['idRazon'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['clave'];?>
</a></li>
	<?php } ?>
</ul>

<div class="tab-content">
	<?php  $_smarty_tpl->tpl_vars["row"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["row"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['empresas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["row"]->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars["row"]->key => $_smarty_tpl->tpl_vars["row"]->value){
$_smarty_tpl->tpl_vars["row"]->_loop = true;
 $_smarty_tpl->tpl_vars["row"]->index++;
 $_smarty_tpl->tpl_vars["row"]->first = $_smarty_tpl->tpl_vars["row"]->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["empresas"]['first'] = $_smarty_tpl->tpl_vars["row"]->first;
?>
	<div id="empresa<?php echo $_smarty_tpl->tpl_vars['row']->value['idRazon'];?>
" class="tab-pane fade <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['empresas']['first']){?>in active<?php }?>">
		<div class="box">
			<div class="box-body">
				<table id="tblEmpresa<?php echo $_smarty_tpl->tpl_vars['row']->value['idRazon'];?>
" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>Orden</th>
							<th>Fecha</th>
							<th>Mensaje</th>
						</tr>
					</thead>
					<tbody>
						<?php  $_smarty_tpl->tpl_vars["imp"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["imp"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['row']->value['importacion']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["imp"]->key => $_smarty_tpl->tpl_vars["imp"]->value){
$_smarty_tpl->tpl_vars["imp"]->_loop = true;
?>
						
							<tr>
								<td style="border-left: 4px solid <?php if ($_smarty_tpl->tpl_vars['imp']->value['estado']==0){?>red<?php }else{ ?>blue<?php }?>"><?php echo $_smarty_tpl->tpl_vars['imp']->value['codigo'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['imp']->value['fecha'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['imp']->value['mensaje'];?>
</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php } ?>
</div><?php }} ?>