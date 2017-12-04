<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Estados</h1>
	</div>
</div>

<ul id="panelTabs" class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#listas">Lista</a></li>
  <li><a data-toggle="tab" href="#add">Modificar</a></li>
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
						<label for="txtNombre" class="col-lg-2">Nombre</label>
						<div class="col-lg-3">
							<input class="form-control" id="txtNombre" name="txtNombre">
						</div>
					</div>
					<div class="form-group">
						<label for="txtColor" class="col-lg-2">Color</label>
						<div class="col-lg-3">
							<input class="form-control" id="txtColor" name="txtColor">
						</div>
					</div>
					<div class="form-group">
						<label for="txtOrden" class="col-lg-2">Orden</label>
						<div class="col-lg-3">
							<input class="form-control" id="txtOrden" name="txtOrden">
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
</div>

<div class="modal fade" id="winPerfiles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" identificador="">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h1>Perfiles de usuario</h1>
			</div>
			<div class="modal-body">
				<div class="row">
				{foreach from=$perfiles item="row"}
					<div class="col-sm-4">
						<label>
							<input type="checkbox" class="perfil" value="{$row.idTipoUsuario}" /> {$row.nombre}
						</label>
					</div>
				{/foreach}
				</div>
			</div>
		</div>
	</div>
</div>