<?php /* Smarty version Smarty-3.1.11, created on 2017-12-04 11:59:21
         compiled from "templates/plantillas/modulos/ordenes/panelAdmin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4625681385a258cf9c4ef00-19911033%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5248780a73b35d23d34a462209e831448f738c46' => 
    array (
      0 => 'templates/plantillas/modulos/ordenes/panelAdmin.tpl',
      1 => 1495211403,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4625681385a258cf9c4ef00-19911033',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'PAGE' => 0,
    'sucursales' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5a258cf9cf9b40_77259107',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a258cf9cf9b40_77259107')) {function content_5a258cf9cf9b40_77259107($_smarty_tpl) {?><div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Ordenes</h1>
	</div>
</div>
<?php if ($_smarty_tpl->tpl_vars['PAGE']->value['usuario']->getIdTipo()!=3){?>
<div class="panel panel-default">
	<div class="panel-body">
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
"><?php echo $_smarty_tpl->tpl_vars['item']->value['nombre'];?>
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
	</div>
</div>
<?php }?>
<div id="dvLista"></div>

<div class="modal fade" id="winOrden" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-body">
				
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="winHistorialEstados" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Historial de cambios de estado</h4>
			</div>
			<div class="modal-body">
				
			</div>
		</div>
	</div>
</div><?php }} ?>