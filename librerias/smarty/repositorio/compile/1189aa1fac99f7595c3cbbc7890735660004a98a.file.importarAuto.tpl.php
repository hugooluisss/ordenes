<?php /* Smarty version Smarty-3.1.11, created on 2017-11-21 13:35:03
         compiled from "templates/plantillas/modulos/ordenes/importarAuto.tpl" */ ?>
<?php /*%%SmartyHeaderCode:154773525458a73a080602e2-61307898%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1189aa1fac99f7595c3cbbc7890735660004a98a' => 
    array (
      0 => 'templates/plantillas/modulos/ordenes/importarAuto.tpl',
      1 => 1511292808,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '154773525458a73a080602e2-61307898',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_58a73a080b83b9_54853567',
  'variables' => 
  array (
    'lista' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58a73a080b83b9_54853567')) {function content_58a73a080b83b9_54853567($_smarty_tpl) {?><div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Importación remota</h1>
	</div>
</div>

<div class="panel">
	<div class="panel-body">
		<div class="row">
			<div class="col-xs-2 text-right">
				<label for="selRazon">Razón social</label>
			</div>
			<div class="col-xs-6">
				<select id="selRazon" name="selRazon" class="form-control">
					<?php  $_smarty_tpl->tpl_vars["row"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["row"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['lista']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["row"]->key => $_smarty_tpl->tpl_vars["row"]->value){
$_smarty_tpl->tpl_vars["row"]->_loop = true;
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['idRazon'];?>
" empresa="<?php echo $_smarty_tpl->tpl_vars['row']->value['numero'];?>
" consecutivo="<?php echo $_smarty_tpl->tpl_vars['row']->value['consecutivo'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['clave'];?>
</option>
					<?php } ?>
				</select>
			</div>
			<div class="col-xs-4">
				<button id="btnEnviar" class="btn btn-success">Enviar</button>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				Última orden importada: <span campo="ultimaOrden"></span>
			</div>
		</div>
	</div>
</div>

<div id="dvLista"></div><?php }} ?>