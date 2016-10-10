<?php /* Smarty version Smarty-3.1.11, created on 2016-10-09 20:32:25
         compiled from "templates/plantillas/modulos/ordenes/panelAdmin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:37068833057f2628db2a8b0-03114787%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5248780a73b35d23d34a462209e831448f738c46' => 
    array (
      0 => 'templates/plantillas/modulos/ordenes/panelAdmin.tpl',
      1 => 1475688613,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '37068833057f2628db2a8b0-03114787',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57f2628db7dc00_77604862',
  'variables' => 
  array (
    'PAGE' => 0,
    'sucursales' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57f2628db7dc00_77604862')) {function content_57f2628db7dc00_77604862($_smarty_tpl) {?><div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Ordenes</h1>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-body">
		<?php if (in_array($_smarty_tpl->tpl_vars['PAGE']->value['usuario']->getIdTipo(),array(1,3,5))){?>
			<form role="form" id="frmBuscar" class="form-horizontal" onsubmit="javascript: return false;">
				<div class="form-group">
					<label for="selSucursal" class="col-lg-2">Sucursal</label>
					<div class="col-lg-3">
						<select class="form-control" id="selSucursal" name="selSucursal">
							<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sucursales']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['idSucursal'];?>
" <?php if ($_smarty_tpl->tpl_vars['PAGE']->value['usuario']->sucursal->getId()==$_smarty_tpl->tpl_vars['item']->value['idSucursal']){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['nombre'];?>
</option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-info pull-right">Buscar</button>
					<input type="hidden" id="id"/>
				</div>
			</form>
		<?php }else{ ?>
			<div class="row" style="margin-left: 10px;"> <!--style="border: 1px solid #3c8dbc; margin: 5px auto;" -->
				<div class="col-md-2 text-center" style="color: <?php echo $_smarty_tpl->tpl_vars['PAGE']->value['usuario']->sucursal->getColor();?>
; background: #ecf0f5;">
					<i class="fa fa-tag fa-5x" aria-hidden="true"></i>
					<br />
					<?php echo $_smarty_tpl->tpl_vars['PAGE']->value['usuario']->sucursal->getnombre();?>

				</div>
				<div class="col-md-6">
					<h1 style="color: #3c8dbc">Orden de servicio</h1>
				</div>
			</div>
		<?php }?>
	</div>
</div>
<div id="dvLista"></div>

<div class="modal fade" id="winOrden" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-body">
				
			</div>
		</div>
	</div>
</div><?php }} ?>