<?php /* Smarty version Smarty-3.1.11, created on 2016-09-27 12:39:16
         compiled from "templates/plantillas/modulos/productos/panel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:89850336057ea8549a84898-40998385%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '22ac6a6ed1638fe1ca74aa4bd027db4d0557e87d' => 
    array (
      0 => 'templates/plantillas/modulos/productos/panel.tpl',
      1 => 1474997729,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '89850336057ea8549a84898-40998385',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57ea8549abb4a4_18103495',
  'variables' => 
  array (
    'colores' => 0,
    'row' => 0,
    'tamanos' => 0,
    'texturas' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57ea8549abb4a4_18103495')) {function content_57ea8549abb4a4_18103495($_smarty_tpl) {?><div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Administración de Productos</h1>
	</div>
</div>

<div class="box">
	<div class="box-body">
		<div id="dvLista"></div>
	</div>
</div>

<div class="modal fade" id="winProductos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h1>Productos</h1>
			</div>
			<div class="modal-body">
				<form action="#" onsubmit="javascript: return false;" id="frmProducto">
					<div class="row">
						<label class="col-xs-4" for="txtClave">Clave</label>
						<div class="col-xs-4">
							<input type="text" class="form-control" id="txtClave" name="txtClave">
						</div>
					</div>
					<div class="row">
						<label class="col-xs-4" for="txtNombre">Nombre</label>
						<div class="col-xs-8">
							<input type="text" class="form-control" id="txtNombre" name="txtNombre">
						</div>
					</div>
					<div class="row">
						<label class="col-xs-4" for="txtNombre">Descripción</label>
						<div class="col-xs-8">
							<textarea class="form-control" id="txtDescripcion"  name="txtDescripcion" rows="5"></textarea>
						</div>
					</div>
					<div class="row">
						<label class="col-xs-4" for="txtPrecio">Precio</label>
						<div class="col-xs-3">
							<input type="text" class="form-control" id="txtPrecio" name="txtPrecio">
						</div>
					</div>
					<input type="submit" value="Guardar" class="btn btn-success"/>
					<input type="hidden" id="id" name="id" value="" />
					<input type="hidden" id="padre" name="padre" value="" />
					<input type="hidden" id="hijos" name="hijos" value="" />
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="winUploadImagen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h1>Imágenes</h1>
			</div>
			<div class="modal-body">
				<form method="post" action="?mod=cpedidos&action=uploadfile2" enctype="multipart/form-data">
					<input type="file" name="upl" multiple />
					<input type="hidden" name="producto" id="producto" />
					<ul class="elementos list-group">
					<!-- The file list will be shown here -->
					</ul>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="winMasivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h1>Inserción masiva por caracteristicas</h1>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<div class="alert alert-info">
							<div class="row">
								<div class="col-md-5">
									<label for="txtPrecio">Precio general</label>
								</div>
								<div class="col-md-7">
									<input type="text" value="0.00" id="txtPrecio" name="txtPrecio" class="form-control text-right" />
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-group" id="accordion">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#colores">Colores</a>
							</h4>
						</div>
						<div id="colores" class="panel-collapse collapse in">
							<div class="panel-body">
								<?php  $_smarty_tpl->tpl_vars["row"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["row"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['colores']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["row"]->key => $_smarty_tpl->tpl_vars["row"]->value){
$_smarty_tpl->tpl_vars["row"]->_loop = true;
?>
									<div class="checkbox">
										<label style="color: <?php echo $_smarty_tpl->tpl_vars['row']->value['codigo'];?>
"><input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['idColor'];?>
" class="colores" datos='<?php echo $_smarty_tpl->tpl_vars['row']->value['json'];?>
'><?php echo $_smarty_tpl->tpl_vars['row']->value['nombre'];?>
</label>
									</div>
								<?php } ?>
								<br />
								<div class="row">
									<div class="col-md-12 text-right">
										<button class="btn btn-success" tipo="colores">Agregar seleccionados</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#tamano">Tamaños</a>
							</h4>
						</div>
						<div id="tamano" class="panel-collapse collapse">
							<div class="panel-body">
								<?php  $_smarty_tpl->tpl_vars["row"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["row"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tamanos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["row"]->key => $_smarty_tpl->tpl_vars["row"]->value){
$_smarty_tpl->tpl_vars["row"]->_loop = true;
?>
									<div class="checkbox">
										<label><input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['idSize'];?>
" class="tamanos" datos='<?php echo $_smarty_tpl->tpl_vars['row']->value['json'];?>
'><?php echo $_smarty_tpl->tpl_vars['row']->value['nombre'];?>
</label>
									</div>
								<?php } ?>
								
								<br />
								<div class="row">
									<div class="col-md-12 text-right">
										<button class="btn btn-success" tipo="tamanos">Agregar seleccionados</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#texturas">Texturas</a>
							</h4>
						</div>
						<div id="texturas" class="panel-collapse collapse">
							<div class="panel-body">
								<?php  $_smarty_tpl->tpl_vars["row"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["row"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['texturas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["row"]->key => $_smarty_tpl->tpl_vars["row"]->value){
$_smarty_tpl->tpl_vars["row"]->_loop = true;
?>
									<div class="checkbox">
										<label><input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['idTextura'];?>
" class="texturas" datos='<?php echo $_smarty_tpl->tpl_vars['row']->value['json'];?>
'><?php echo $_smarty_tpl->tpl_vars['row']->value['nombre'];?>
</label>
									</div>
								<?php } ?>
								<br />
								<div class="row">
									<div class="col-md-12 text-right">
										<button class="btn btn-success" tipo="texturas">Agregar seleccionados</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><?php }} ?>