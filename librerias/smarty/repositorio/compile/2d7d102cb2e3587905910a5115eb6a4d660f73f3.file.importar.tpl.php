<?php /* Smarty version Smarty-3.1.11, created on 2016-09-27 23:47:39
         compiled from "templates/plantillas/modulos/ordenes/importar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:203195638657eb4618f2aec5-79156183%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2d7d102cb2e3587905910a5115eb6a4d660f73f3' => 
    array (
      0 => 'templates/plantillas/modulos/ordenes/importar.tpl',
      1 => 1475038004,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '203195638657eb4618f2aec5-79156183',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57eb4619019615_60841706',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57eb4619019615_60841706')) {function content_57eb4619019615_60841706($_smarty_tpl) {?><div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Importación de ordenes</h1>
	</div>
</div>
<div class="panel">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12 text-center">
				<button class="btn btn-danger" id="btnUpload"><i class="fa fa-upload" aria-hidden="true"></i> Subir archivo</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="winUpload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h1>Archivo de importación</h1>
			</div>
			<div class="modal-body">
				<input id="fileupload" type="file" name="files[]" data-url="index.php?mod=cordenes&action=uploadfile" multiple>
			</div>
		</div>
	</div>
</div><?php }} ?>