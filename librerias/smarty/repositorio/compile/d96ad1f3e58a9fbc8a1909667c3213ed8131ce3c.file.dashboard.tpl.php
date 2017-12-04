<?php /* Smarty version Smarty-3.1.11, created on 2017-12-04 13:46:26
         compiled from "templates/plantillas/modulos/ordenes/dashboard.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1000290995591f20d0a989d5-65142044%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd96ad1f3e58a9fbc8a1909667c3213ed8131ce3c' => 
    array (
      0 => 'templates/plantillas/modulos/ordenes/dashboard.tpl',
      1 => 1512416782,
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
    'direccionsae' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_591f20d0a99c54_38032813')) {function content_591f20d0a99c54_38032813($_smarty_tpl) {?><div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Dashboard importación</h1>
	</div>
</div>

<div class="panel">
	<div class="panel-body">
		<div class="row">
			<div class="col-xs-6 col-sm-4 text-center">
				<button class="btn btn-success btn-block" id="btnSAE">Consultar SAE</button>
			</div>
			<div class="col-xs-6 col-sm-4 text-center">
				<button class="btn btn-default btn-block" id="btnActualizar">Actualizar</button>
			</div>
			<div class="col-xs-6 col-sm-4 text-center">
				<button class="btn btn-default btn-block" data-toggle="modal" data-target="#winEmpresas">Empresas</button>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="winEmpresas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Empresas</h4>
			</div>
			<div class="modal-body">
				<?php  $_smarty_tpl->tpl_vars["row"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["row"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['empresas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["row"]->key => $_smarty_tpl->tpl_vars["row"]->value){
$_smarty_tpl->tpl_vars["row"]->_loop = true;
?>
					<div class="checkbox">
						<label><input type="checkbox" value="idRazon" <?php if ($_smarty_tpl->tpl_vars['row']->value['automatico']==1){?>checked<?php }?>><?php echo $_smarty_tpl->tpl_vars['row']->value['clave'];?>
</label>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<input type="hidden" id="direccionSAE" value="<?php echo $_smarty_tpl->tpl_vars['direccionsae']->value;?>
" /><?php }} ?>