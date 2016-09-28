<?php /* Smarty version Smarty-3.1.11, created on 2016-09-28 10:19:41
         compiled from "templates/plantillas/modulos/vendedores/panel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:131840690157ebdceb8a0445-65946912%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '96e742644fe378f87c7aed057bb0d1251dfd9e16' => 
    array (
      0 => 'templates/plantillas/modulos/vendedores/panel.tpl',
      1 => 1475075924,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '131840690157ebdceb8a0445-65946912',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57ebdceb8dad29_53696398',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57ebdceb8dad29_53696398')) {function content_57ebdceb8dad29_53696398($_smarty_tpl) {?><div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Vendedores</h1>
	</div>
</div>

<ul id="panelTabs" class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#listas">Lista</a></li>
  <li><a data-toggle="tab" href="#add">Agregar o Modificar</a></li>
</ul>

<div class="tab-content">
	<div id="listas" class="tab-pane fade in active">
		<div id="dvLista">
			
		</div>
	</div>
	
	<div id="add" class="tab-pane fade">
		<form role="form" id="frmAdd" class="form-horizontal" onsubmit="javascript: return false;">
			<div class="box">
				<div class="box-body">
					<div class="form-group">
						<label for="txtClave" class="col-lg-2">Clave</label>
						<div class="col-lg-2">
							<input class="form-control" id="txtClave" name="txtClave" type="text">
						</div>
					</div>
					<div class="form-group">
						<label for="txtNombre" class="col-lg-2">Nombre</label>
						<div class="col-lg-6">
							<input class="form-control" id="txtNombre" name="txtNombre">
						</div>
					</div>
				</div>
				<div class="box-footer">
					<button type="reset" id="btnReset" class="btn btn-default">Cancelar</button>
					<button type="submit" class="btn btn-info pull-right">Guardar</button>
					<input type="hidden" id="id"/>
				</div>
			</div>
		</form>
	</div>
</div><?php }} ?>