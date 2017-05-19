<?php /* Smarty version Smarty-3.1.11, created on 2017-04-10 09:36:06
         compiled from "templates/plantillas/modulos/ordenes/archivos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14280127558eb985687eb15-24120773%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '52480e74915999cd0e4fa59272c515c91bb79d06' => 
    array (
      0 => 'templates/plantillas/modulos/ordenes/archivos.tpl',
      1 => 1476298970,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14280127558eb985687eb15-24120773',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'orden' => 0,
    'movimiento' => 0,
    'PAGE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_58eb98568d02b1_01610674',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58eb98568d02b1_01610674')) {function content_58eb98568d02b1_01610674($_smarty_tpl) {?><div class="panel">
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
	<div class="alert alert-danger">
		<b>No cierres la ventana</b>
		<p>En este momento el sistema está subiendo el o los archivos que indicaste, no cierres la ventana para no interrumpir el proceso</p>
	</div>
	<br />
	<div class="progress">
		<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
	</div>
	
	<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#listaArchivos">Lista de archivos</a></li>
		<li><a data-toggle="tab" href="#log" <?php if (in_array($_smarty_tpl->tpl_vars['PAGE']->value['usuario']->getIdTipo(),array(3))||$_smarty_tpl->tpl_vars['orden']->value->estado->getId()==2){?>class="hide"<?php }?>>Subir</a></li>
	</ul>
	
	<div class="tab-content">
		<div id="listaArchivos" class="tab-pane fade in active">
			
		</div>
		<div id="log" class="tab-pane fade">
			<br />
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
			<div id="historial"></div>
		</div>
	</div>
</div><?php }} ?>