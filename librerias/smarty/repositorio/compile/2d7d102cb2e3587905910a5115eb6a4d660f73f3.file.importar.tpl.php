<?php /* Smarty version Smarty-3.1.11, created on 2016-09-29 09:08:20
         compiled from "templates/plantillas/modulos/ordenes/importar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:203124540257ebd0d524efb4-19654486%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2d7d102cb2e3587905910a5115eb6a4d660f73f3' => 
    array (
      0 => 'templates/plantillas/modulos/ordenes/importar.tpl',
      1 => 1475158098,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '203124540257ebd0d524efb4-19654486',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57ebd0d5267b40_02057334',
  'variables' => 
  array (
    'razonesSociales' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57ebd0d5267b40_02057334')) {function content_57ebd0d5267b40_02057334($_smarty_tpl) {?><div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Importación de ordenes</h1>
	</div>
</div>
<div class="panel">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12 text-center">
				<table id="tblRazones" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>Clave</th>
							<th>Ultimo importado</th>
							<th>Rango ODTs</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						<?php  $_smarty_tpl->tpl_vars["row"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["row"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['razonesSociales']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["row"]->key => $_smarty_tpl->tpl_vars["row"]->value){
$_smarty_tpl->tpl_vars["row"]->_loop = true;
?>
							<tr>
								<td><?php echo $_smarty_tpl->tpl_vars['row']->value['clave'];?>
</td>
								<td><?php if ($_smarty_tpl->tpl_vars['row']->value['ultimaImportacion']['momento']==''){?>Nunca<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['row']->value['ultimaImportacion']['momento'];?>
<?php }?></td>
								<td><?php echo $_smarty_tpl->tpl_vars['row']->value['ultimaImportacion']['inicio'];?>
 - <?php echo $_smarty_tpl->tpl_vars['row']->value['ultimaImportacion']['fin'];?>
</td>
								<td>
									<button class="btn btn-danger btnUpload" razonSocial="<?php echo $_smarty_tpl->tpl_vars['row']->value['idRazon'];?>
"><i class="fa fa-upload" aria-hidden="true"></i> Subir archivo</button>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="winUpload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h1>Archivo de importación</h1>
			</div>
			<div class="modal-body">
				<div class="alert alert-info">
					<strong>Importando!</strong> Se está analizando el archivo, por favor espera.
				</div>
				<form id="upload" method="post" action="index.php?mod=cordenes&action=uploadfile" enctype="multipart/form-data">
					<input type="file" name="upl" multiple />
				</form>
				<div class="row">
					<div class="col-md-12" id="datos">
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div><?php }} ?>