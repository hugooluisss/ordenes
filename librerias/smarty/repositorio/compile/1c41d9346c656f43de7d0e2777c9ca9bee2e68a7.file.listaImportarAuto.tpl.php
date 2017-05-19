<?php /* Smarty version Smarty-3.1.11, created on 2017-05-06 14:48:14
         compiled from "templates/plantillas/modulos/ordenes/listaImportarAuto.tpl" */ ?>
<?php /*%%SmartyHeaderCode:139347047058a747c0c1d2e0-72390832%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1c41d9346c656f43de7d0e2777c9ca9bee2e68a7' => 
    array (
      0 => 'templates/plantillas/modulos/ordenes/listaImportarAuto.tpl',
      1 => 1494099634,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '139347047058a747c0c1d2e0-72390832',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_58a747c0d7dab1_40146514',
  'variables' => 
  array (
    'banderaGeneral' => 0,
    'ordenes' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58a747c0d7dab1_40146514')) {function content_58a747c0d7dab1_40146514($_smarty_tpl) {?><div class="row">
	<div class="col-md-12 pull-right">
		<button class="btn btn-warning btn-xs" id="btnTodas">Seleccionar todas</button>
		<button class="btn btn-warning btn-xs" id="btnNinguna">Seleccionar ninguna</button>
	</div>
</div>
<div class="box">
	<div class="box-body">
		<div class="row">
			<div class="col-md-4">
				<div class="btn-group">
					<button type="button" class="btn btn-success" action="importar">Importar al sistema</button>
				</div>
			</div>
			<div class="col-md-8">
				<?php if (!$_smarty_tpl->tpl_vars['banderaGeneral']->value){?>
					<div class="alert alert-danger">
						<strong>Error</strong> Hay elementos que no pueden ser importados, revisa la lista
					</div>
				<?php }?>
			</div>
		</div>
		
		<table id="tblDatos" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Código</th>
					<th>Producto</th>
					<th>Vendedor</th>
					<th>Sucursal</th>
					<th>Área</th>
                    <th>Observaciones</th>
				</tr>
			</thead>
			<tbody>
				<?php  $_smarty_tpl->tpl_vars["row"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["row"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ordenes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["row"]->key => $_smarty_tpl->tpl_vars["row"]->value){
$_smarty_tpl->tpl_vars["row"]->_loop = true;
?>
					<tr>
						<td><?php if ($_smarty_tpl->tpl_vars['row']->value->bandera){?><input type="checkbox" class="orden" json='<?php echo $_smarty_tpl->tpl_vars['row']->value->json;?>
' /><?php }?></td>
						<td <?php if ($_smarty_tpl->tpl_vars['row']->value->existe){?>title="Al parecer esta orden ya fue importada" class="text-danger"<?php }?>><?php echo $_smarty_tpl->tpl_vars['row']->value->CODIGO;?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['row']->value->DESCRIPCION_DEL_ARTICULO;?>
</td>
						<td <?php if ($_smarty_tpl->tpl_vars['row']->value->vendedor['idVendedor']==''){?>title="El vendedor no existe en el sistema" class="text-danger"<?php }?>><?php echo $_smarty_tpl->tpl_vars['row']->value->CLAVE_VENDEDOR;?>
</td>
						<td <?php if ($_smarty_tpl->tpl_vars['row']->value->sucursal['idSucursal']==''){?>title="La sucursal no existe en el sistema o no se pudo determinar" class="text-danger"<?php }?>>
							<?php if ($_smarty_tpl->tpl_vars['row']->value->sucursal['nombre']==''){?>-<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['row']->value->sucursal['nombre'];?>
<?php }?>
						</td>
						<td <?php if ($_smarty_tpl->tpl_vars['row']->value->area['idArea']==''){?>title="El area de producción no existe en el sistema" class="text-danger"<?php }?>>
							<?php echo $_smarty_tpl->tpl_vars['row']->value->AREA_DE_PRODUCCION;?>

						</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['row']->value->OBSERVACIONES;?>
</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div><?php }} ?>