<?php /* Smarty version Smarty-3.1.11, created on 2016-10-02 21:35:55
         compiled from "templates/plantillas/modulos/ordenes/archivos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:40453334257f1acd3d77042-53063986%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '52480e74915999cd0e4fa59272c515c91bb79d06' => 
    array (
      0 => 'templates/plantillas/modulos/ordenes/archivos.tpl',
      1 => 1475462154,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '40453334257f1acd3d77042-53063986',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57f1acd3da9561_87890665',
  'variables' => 
  array (
    'orden' => 0,
    'movimiento' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57f1acd3da9561_87890665')) {function content_57f1acd3da9561_87890665($_smarty_tpl) {?><div class="panel">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-2 text-right">
				<b>Orden: </b>
			</div>
			<div class="col-md-2">
				<?php echo $_smarty_tpl->tpl_vars['orden']->value->getCodigo();?>

			</div>
		</div>
		<div class="row">
			<div class="col-md-2 text-right">
				<b>Producto: </b>
			</div>
			<div class="col-md-2">
				<?php echo $_smarty_tpl->tpl_vars['movimiento']->value->getClave();?>

			</div>
			<div class="col-md-8">
				<?php echo $_smarty_tpl->tpl_vars['movimiento']->value->getDescripcion();?>

			</div>
		</div>
	</div>
</div>

<div class="panel">
	<form id="upload2" method="post" action="?mod=cmovimientos&action=uploadfile" enctype="multipart/form-data">
		<input type="hidden" id="orden" name="orden" value="<?php echo $_smarty_tpl->tpl_vars['orden']->value->getId();?>
">
		<input type="hidden" id="movimiento" name="movimiento" value="<?php echo $_smarty_tpl->tpl_vars['movimiento']->value->getClave();?>
">
		<input type="file" name="upl" multiple />
		<ul class="elementos list-group">
		<!-- The file list will be shown here -->
		</ul>
	</form>
	<div class="progress">
		<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
	</div>
	<div id="listaArchivos">
	</div>
</div><?php }} ?>